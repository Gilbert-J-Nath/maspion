<?php

namespace App\Http\Controllers;

use App\Http\Mail\MailSender;
use App\Models\Accounts;
use App\Models\ForgotPassword;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotController extends Controller
{
    public function index_forgot()
    {
        return view('welcome.forgot');
    }

    public function send_token(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:accounts,EMAIL'
        ], [
            'email.exists' => 'Email anda tidak terdaftar.',
        ]);

        $token = Str::random(64);
        $expiry = Carbon::now()->addMinutes(15);

        ForgotPassword::updateResetToken($request->email, $token, $expiry);

        $link = route('email-token', ['token' => $token]);

        Mail::to($request->email)->send(new MailSender($link));

        return redirect()->back()->with('message', 'Link untuk mengganti password sudah dikirimkan ke email anda.');
    }

    public function email_token($token)
    {
        $accountExist = ForgotPassword::findAccountByToken($token);

        if (!$accountExist) {
            return redirect()->route('show-forgot')->with(['error' => 'Token tidak valid atau sudah kedaluwarsa']);
        }

        return view('welcome.forgot-confirm', ['token' => $token]);
    }

    public function reset_password(Request $request)
    {
        $validateData = $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $token = $validateData['token'];
        $password = $validateData['password'];

        $account = ForgotPassword::findAccountByToken($token);
        if (!$account) {
            return redirect()->route('email-token')->with(['error' => 'Token tidak valid atau sudah kedaluwarsa']);
        }

        $hashedPassword = Accounts::hash_password($password);

        if ($hashedPassword == $account->PASSWORD) {
            return redirect()->back()->with(['error' => 'Password baru tidak boleh sama dengan password lama']);
        }

        ForgotPassword::updatePasswordAndClearToken($token, $hashedPassword);
        return redirect()->route('show-login')->with('message', 'Password berhasil diperbarui. Silakan login.');
    }
}
