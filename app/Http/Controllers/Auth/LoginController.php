<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // جلب المستخدم بناءً على البريد الإلكتروني
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'بيانات تسجيل الدخول غير صحيحة.');
        }

        // التحقق من حالة الحساب
        if ($user->status !== 1) { // Check if status is not '1' (active)
            return back()->with('error', 'حسابك غير مفعل، الرجاء التواصل مع الإدارة.');
        }

        // تسجيل الدخول يدوياً
        Auth::login($user, $request->filled('remember'));

        return redirect()->intended($this->redirectTo);
    }

    protected function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
