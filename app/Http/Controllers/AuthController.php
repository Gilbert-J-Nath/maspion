<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    //
    public function index_login()
    {
        return view('welcome.login');
    }

    public function signUp(Request $req)
    {
        $username = $req->input('username');
        $email = $req->input('email');
        $password = $req->input('password');
        $checkPassword = $req->input('checkPassword');

        $accountModel = new Accounts();
        $status = $accountModel->save_account($username, $email, $password, $checkPassword);

        if ($status) {
            dd("Berhasil daftar");
        } else {
            dd("gagal daftar");
        }
    }

    public function logIn(Request $req)
    {
        $email = $req->input('email');
        $password = $req->input('password');
        $rememberMe = $req->has("remember_me");

        $accountModel = new Accounts();

        $accountExist = $accountModel->get_account($email, $password);

        if ($accountExist) {
            if ($rememberMe) {
                Cookie::queue('auth_email', $email, 43200);
            } else {
                Cookie::queue(Cookie::forget('auth_email'));
            }

            dd("Berhasil Masuk");
        } else {
            dd("Gagal Masuk");
        }
    }
}
