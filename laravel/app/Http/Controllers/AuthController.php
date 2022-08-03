<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

//        $token = $user->createToken('main')->plainTextToken;

        return redirect()
            ->route('login')
            ->with('message', 'Tạo tài khoản thành công. Cần đợi admin kích hoạt!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => [
                'required',
            ],
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return redirect()->route('login')->with('error', 'Tài khoản hoặc mật khẩu không đúng.');
        }

        $user = Auth::user();
        if (!self::isActive($user['is_active'])) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Tài khoản chưa được kích hoạt.');
        }

//        $token = $user->createToken('main')->plainTextToken; vuejs
        //        return response([
//            'user' => $user,
//            'token' => $token
//        ]);
        $view = 'user.index';

        if (self::isAdmin($user['role'])) {
            $view = 'admin.index';
        }

        return redirect()->route($view)->with('status', 'Welcome back. ADMIN '.Auth::user()->name);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

//        $user->currentAccessToken()->delete();

//        Session::flush();
        Auth::logout();
        return redirect('login');
//        return response([ vuejs
//            'success' => true
//        ]);
    }

    private static function isAdmin($user)
    {
        if ($user) { return True; }

        return False;
    }

    private static function isActive($user)
    {
        if ($user) { return True; }

        return False;
    }

    public function viewLogin()
    {
        return view('auth.login');
    }

    public function viewRegister()
    {
        return view('auth.register');
    }
}
