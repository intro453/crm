<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the post-login redirect path based on the authenticated user's role.
     */
    public function redirectTo(): string
    {
        $user = Auth::user();

        if ($user->is_admin) {
            return route('admin.profile');
        }

        if ($user->is_manager) {
            return route('manager.profile');
        }

        if ($user->is_lawyer) {
            return route('lawyer.profile');
        }

        return route('main');
    }

    public function username(): string
    {
        return 'login';
    }

    /**
     * Get the needed authorization credentials from the request.
     */
    protected function credentials(Request $request): array
    {
        return array_merge($request->only($this->username(), 'password'), [
            'is_active' => true,
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where($this->username(), $request->input($this->username()))->first();

        if ($user && !$user->is_active) {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.blocked')],
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
