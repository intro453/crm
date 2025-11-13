<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
