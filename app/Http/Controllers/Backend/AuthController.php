<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\PendingUser;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('auth.login');
    }


    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status == 1) {
                toastr()->success('Đăng nhập thành công!');
                return redirect()->route('dashboard.index');
            } else {
                Auth::logout();
                toastr()->error('Tài khoản không hoạt động!');
                return redirect()->route('auth.login');
            }
        }
        toastr()->error('Tài khoản hoặc mật khẩu sai!');
        return redirect()->route('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }


    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token = Str::random(60);
        $pendingUser = new PendingUser();
        $pendingUser->name = $request->input('name');
        $pendingUser->email = $request->input('email');
        $pendingUser->password = bcrypt($request->input('password'));
        $pendingUser->token = $token;
        $pendingUser->save();

        // Gửi email xác nhận
        $pendingUser->notify(new VerifyEmailNotification($token));

        toastr()->success('Đăng ký tài khoản thành công! Vui lòng kiểm tra email của bạn để xác nhận đăng ký.');
        return redirect()->route('auth.login');
    }

    /**
     * Display the specified resource.
     */

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $this->loginOrRegisterUser($googleUser);
            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập bằng Google thành công!');
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('auth.login')->with('error', 'Đăng nhập bằng Google thất bại');
        }
    }

    private function loginOrRegisterUser($googleUser)
    {
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            Auth::loginUsingId($user->id);
        } else {
            // Tạo mới tài khoản người dùng nếu chưa tồn tại
            $newUser = new User();
            $newUser->name = $googleUser->name;
            $newUser->email = $googleUser->email;
            // Không cần mật khẩu khi đăng nhập bằng Google
            $newUser->save();
            Auth::login($newUser);
        }
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
