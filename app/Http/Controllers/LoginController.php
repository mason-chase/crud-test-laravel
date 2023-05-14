<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Example API",
 *     version="1.0.0",
 *     description="API for the Example application",
 * )
 */
class LoginController extends Controller
{

    /**
     * @OA\Get(
     *     path="/login",
     *     tags={"Auth"},
     *     summary="Show login form",
     *     description="Displays the login form for the user",
     *     @OA\Response(response="200", description="Login form displayed")
     * )
     */
    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/');
        }
        return view('auth.login');
    }
    /**
     * Handle an authentication attempt.
     */
    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Auth"},
     *     summary="Login",
     *     description="Logs in a user",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Redirect response",
     *         @OA\Header(
     *             header="Location",
     *             description="Redirect URL",
     *             @OA\Schema(type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object"),
     *         )
     *     ),
     * )
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('customers/create');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    /**
     * @OA\Get(
     *     path="/logout",
     *     tags={"Auth"},
     *     summary="Logout",
     *     description="Logs out the currently authenticated user",
     *     @OA\Response(response="200", description="Logout successful")
     * )
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}