<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        return view('admin.profile', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(UpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validated();

        $user->fill($validated);

        $user->save();

        return redirect()->route('admin.profile')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('passwordUpdate', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => $validated['password'],
        ]);

        return redirect()->route('admin.profile')->with('status', 'password-updated');
    }
}
