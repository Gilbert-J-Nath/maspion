<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function showDashboard()
    {
        $data['title'] = "Dashboard Admin";

        return
            view('admin.header', $data) .
            view('admin.master_data.tenant') .
            view('admin.footer');
    }

    
}
