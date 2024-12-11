<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // $data['title'] = "Dashboard Admin";
        $data['tenants'] = DB::select(
            "SELECT 
                t.*
            FROM 
                tenant t"
        );

        return
            view('welcome.template.header').
            view('welcome.landing_page', $data).
            view('welcome.template.footer');
    }
}
