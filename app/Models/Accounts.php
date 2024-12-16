<?php

namespace App\Models;

use AWS\CRT\HTTP\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Accounts extends Model
{
    use HasFactory;

    public static function hash_password($password)
    {
        return hash('sha256', md5($password));
    }

    public function save_account($username, $email, $password, $checkPassword)
    {
        if ($password != $checkPassword) {
            return false;
        } else {
            $hashPassword = self::hash_password($password);
            return DB::insert("INSERT INTO accounts (USERNAME, EMAIL, PASSWORD, created_at, updated_at) VALUES (?,?,?, NOW(), NOW())", [$username, $email, $hashPassword]);
        }
    }

    public function get_account($email, $password)
    {
        $hashPassword = self::hash_password($password);
        return DB::selectOne("SELECT * FROM accounts WHERE email = ? AND password = ?", [$email, $hashPassword]);
    }
}
