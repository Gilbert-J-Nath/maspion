<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ForgotPassword extends Model
{
    use HasFactory;

    public static function updateResetToken($email, $token, $expiry)
    {
        return DB::update("UPDATE accounts SET RESETTOKEN = ?, TOKENEXPIRATION = ? WHERE EMAIL = ?", [$token, $expiry, $email]);
    }

    public static function findAccountByToken($token)
    {
        return DB::selectOne("SELECT * FROM accounts WHERE RESETTOKEN = ? AND TOKENEXPIRATION > ?", [$token, Carbon::now()]);
    }

    public static function findAccountByEmail($email)
    {
        return DB::selectOne("SELECT * FROM accounts WHERE EMAIL = ?", [$email]);
    }

    public static function updatePasswordAndClearToken($token, $newPassword)
    {
        return DB::update("UPDATE accounts SET PASSWORD = ?, RESETTOKEN = NULL, TOKENEXPIRATION = NULL WHERE RESETTOKEN = ?", [$newPassword, $token]);
    }
}
