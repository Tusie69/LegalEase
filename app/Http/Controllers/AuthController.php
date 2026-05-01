<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name'    => 'required|string|min:2|max:20',
                'last_name'     => 'required|string|min:2|max:20',
                'email'         => 'required|string|email|max:255|unique:users,email',
                'phone'         => ['required', 'string', 'min:9', 'max:15', 'regex:/^[\d\+\s\-\(\)]+$/'],
                'date_of_birth' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->toDateString()],
                'gender'        => 'required|string|in:female,male,other,undisclosed',
                'password'      => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
                'agreed_terms'  => 'required|accepted',
            ],
            [
                'phone.regex'                    => 'Phone number can only contain digits, spaces, dashes, parentheses, and a leading +.',
                'date_of_birth.before_or_equal'  => 'You must be at least 18 to create an account.',
                'agreed_terms.accepted'          => 'You must agree to the Terms of Service and Privacy Policy.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'     => trim($request->first_name . ' ' . $request->last_name),
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 3,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        if (session('booking')) {
            if (!session('booking_details')) {
                session(['booking_details' => [
                    'meeting_language'   => 'en',
                    'contact_preference' => 'email',
                    'agreed_terms'       => '1',
                ]]);
            }
            return redirect()->route('book.review');
        }

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make(
            $credentials,
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            if ((int) auth()->user()->role_id === 2) {
                return redirect()->route('lawyer.dashboard');
            }

            if (session('booking')) {
                if (!session('booking_details')) {
                    session(['booking_details' => [
                        'meeting_language'   => 'en',
                        'contact_preference' => 'email',
                        'agreed_terms'       => '1',
                    ]]);
                }
                return redirect()->route('book.review');
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $validator = Validator::make(
            $request->only('email'),
            ['email' => 'required|email'],
            [
                'email.required' => 'Please enter your email address.',
                'email.email'    => 'Please enter a valid email address.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        return redirect()->route('password.request')->with('reset_link_sent', $request->email);
    }

    public function showResetPasswordForm(Request $request, string $token)
    {
        return view('reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'token'    => 'required|string',
                'email'    => 'required|email',
                'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        return redirect()->route('login')->with('status', 'Your password has been reset. Log in with your new password.');
    }

    public function lawyerRegister(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name'      => 'required|string|min:2|max:20',
                'last_name'       => 'required|string|min:2|max:20',
                'email'           => 'required|string|email|max:255|unique:users,email',
                'phone'           => ['required', 'string', 'min:9', 'max:15', 'regex:/^[\d\+\s\-\(\)]+$/'],
                'bar_association' => 'required|in:Hanoi Bar Association,Ho Chi Minh City Bar Association',
                'bar_card_number' => 'required|string|max:100',
                'password'        => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
                'agreed_terms'    => 'required|accepted',
            ],
            [
                'phone.regex'           => 'Phone number can only contain digits, spaces, dashes, parentheses, and a leading +.',
                'bar_association.in'    => 'Please select your bar association.',
                'agreed_terms.accepted' => 'You must agree to the Terms of Service and Privacy Policy.',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'     => trim($request->first_name . ' ' . $request->last_name),
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 2,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('lawyer.dashboard');
    }

    public function lawyerLogin(Request $request)
    {
        $validator = Validator::make(
            $request->only('email', 'password'),
            [
                'email'    => 'required|email',
                'password' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('lawyer.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput($request->only('email'));
    }
}
