<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserVisitedUserList;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        /*try {
            DB::beginTransaction();
            User::create([
                'login' => Str::random(10),
                'password' => '12345678',
                'email' => Str::random(10) . '@crm.local',
            ]);
            throw new \Exception();
            User::create([
                'login' => Str::random(10),
                'password' => '12345678',
                'email' => Str::random(10) . '@crm.local',
            ]);
            DB::commit();
        }catch (\Throwable $e){
            DB::rollBack();
            throw $e;
        }


       // DB::transaction(function () {

      //  });*/




        $sessionKey = 'admin.users.filters';

        if ($request->boolean('reset')) {
            $request->session()->forget($sessionKey);

            return redirect()->route('admin.users.index');
        }

        $defaultFilters = [
            'search' => null,
            'role' => null,
            'sort' => 'created_at_desc',
            'status' => null,
        ];

        $filterValues = array_merge($defaultFilters, $request->session()->get($sessionKey, []));

        foreach (array_keys($defaultFilters) as $filterKey) {
            if ($request->query->has($filterKey)) {
                $value = $request->query($filterKey);
                $filterValues[$filterKey] = $value !== '' ? $value : null;
            }
        }

        $request->session()->put($sessionKey, $filterValues);

        $existingFilterQuery = [];
        foreach (array_keys($defaultFilters) as $filterKey) {
            if ($request->query->has($filterKey)) {
                $existingFilterQuery[$filterKey] = $request->query($filterKey);
            }
        }

        $normalizedFilterQuery = [];
        foreach ($filterValues as $filterKey => $value) {
            if ($value === null) {
                continue;
            }

            if ($filterKey === 'sort' && $value === $defaultFilters[$filterKey]) {
                continue;
            }

            $normalizedFilterQuery[$filterKey] = $value;
        }

        if ($existingFilterQuery !== $normalizedFilterQuery) {
            $redirectQuery = array_merge(
                $request->except(array_keys($defaultFilters)),
                $normalizedFilterQuery
            );

            return redirect()->route('admin.users.index', $redirectQuery);
        }

        $sortOptions = [
            'created_at_desc' => [
                'label' => 'По дате регистрации (новые)',
                'column' => 'created_at',
                'direction' => 'desc',
            ],
            'created_at_asc' => [
                'label' => 'По дате регистрации (старые)',
                'column' => 'created_at',
                'direction' => 'asc',
            ],
            'id_desc' => [
                'label' => 'По ID (убывание)',
                'column' => 'id',
                'direction' => 'desc',
            ],
            'id_asc' => [
                'label' => 'По ID (возрастание)',
                'column' => 'id',
                'direction' => 'asc',
            ],
        ];

        $roles = User::getRoleLabels();
        $statusOptions = [
            'active' => 'Активен',
            'inactive' => 'Заблокирован',
        ];

        $sort = $filterValues['sort'] ?? $defaultFilters['sort'];
        if (! isset($sortOptions[$sort])) {
            $sort = $defaultFilters['sort'];
            $filterValues['sort'] = $sort;
            $request->session()->put($sessionKey, $filterValues);
        }

        $usersQuery = User::query();

        if (! empty($filterValues['search'])) {
            $search = trim($filterValues['search']);
            $usersQuery->where(function ($query) use ($search) {
                $query
                    ->where('login', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE ?", ["%{$search}%"]);
            });
        }

        if (! empty($filterValues['role']) && array_key_exists($filterValues['role'], $roles)) {
            $usersQuery->where('role', $filterValues['role']);
        }

        if (! empty($filterValues['status']) && array_key_exists($filterValues['status'], $statusOptions)) {
            $usersQuery->where('is_active', $filterValues['status'] === 'active');
        }

        $sortOption = $sortOptions[$sort];
        $users = $usersQuery
            ->orderBy($sortOption['column'], $sortOption['direction'])
            ->paginate(10)
            ->withQueryString();

        $filters = [
            'values' => $filterValues,
            'options' => [
                'roles' => $roles,
                'status' => $statusOptions,
                'sort' => $sortOptions,
            ],
        ];


        $user = auth()->user();

        if ($user) {
            UserVisitedUserList::dispatch($user);
        }

        return view('admin.users.index', compact('users', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = User::getRoleLabels();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        User::create([
            'role' => $validated['role'],
            'is_active' => (bool) $validated['is_active'],
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'login' => $validated['login'],
            'password' => $validated['password'],
            'email' => $validated['login'] . '@crm.local',
        ]);
        /*$user = new User();
        $user->fill([
            'role' => $validated['role'],
            'is_active' => (bool) $validated['is_active'],
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'login' => $validated['login'],
            'password' => $validated['password'],
            'email' => $validated['login'] . '@crm.local',
        ]);
        $user->saveQuietly(); //без observe
        */

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $roles = User::getRoleLabels();

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        if ($request->has('password_form')) {
            $validated = $request->validateWithBag('passwordUpdate', [
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $user->update([
                'password' => $validated['password'],
            ]);

            return redirect()
                ->route('admin.users.edit', $user)
                ->with('status', 'password-updated');
        }

        $roleKeys = array_keys(User::getRoleLabels());

        $validated = $request->validate([
            'role' => ['required', Rule::in($roleKeys)],
            'is_active' => ['required', 'boolean'],
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', Rule::unique('users', 'login')->ignore($user->id)],
        ]);

        $middleName = $validated['middle_name'] ?? null;
        if ($middleName === '') {
            $middleName = null;
        }

        $user->update([
            'role' => $validated['role'],
            'is_active' => (bool) $validated['is_active'],
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $middleName,
            'login' => $validated['login'],
            'email' => $validated['login'] . '@crm.local',
        ]);

        return redirect()
            ->route('admin.users.edit', $user)
            ->with('status', 'user-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
