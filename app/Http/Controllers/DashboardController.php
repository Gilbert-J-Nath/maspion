<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\FileUpload;
use App\Models\Tenants;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = "Dashboard Admin";

        return
            view('admin.header', $data) .
            view('admin.master_data.setting') .
            view('admin.footer');
    }

    public function index_tenant()
    {
        $title['title'] = "Dashboard Tenant";

        $data['tenant'] = DB::select(
            "SELECT 
                t.*
            FROM 
                tenant t"
        );

        return
            view('admin.header', $title) .
            view('admin.master_data.tenant', $data) .
            view('admin.footer');
    }

    public function store_tenant(Request $req)
    {
        $req->validate([
            'tenant_logo' => 'required|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = [
            'name_tenant'  => $req->input('tenant_name') ,
            'desc_tenant' => $req->input('tenant_desc') ,
            'owner_name' => $req->input('owner_name'),
            'created_at' => now(),  
            'updated_at' => now()   
        ];

        if($req->hasFile('tenant_logo')) {
            // Store the image on S3
            $data['logo_tenant'] = FileUpload::S3($req->file('tenant_logo'), 'Image', 'Tenant-logo-' . strtotime(now()));
        }

        Tenants::create($data);

        return redirect('dashboard-admin/tenant')->with(['msg' => 'Berhasil Menambahkan Data Tenant', 'location' => 'tenant']);
    }

    public function update_tenant(Request $req)
    {
        $req->validate([
            'up_tenant_logo' => 'nullable|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = [
            'name_tenant'  => $req->input('up_tenant_name'),
            'desc_tenant' => $req->input('up_tenant_desc'),
            'owner_name' => $req->input('up_owner_name'),
            'updated_at' => now()   
        ];

        if (!empty($req->file('up_tenant_logo'))) {
            $data['logo_tenant'] = FileUpload::S3($req->file('up_tenant_logo'), 'Image', 'Tenant-logo-' . strtotime(now()));
        }

        Tenants::where('id_tenant', $req->input('up_id_tenant'))->update($data);

        return redirect('dashboard-admin/tenant')->with(['msg' => 'Berhasil Mengubah Data Tenant', 'location' => 'tenant']);
    }

    public function delete_tenant(Request $req)
    {
        DB::table('tenant')->WHERE(['id_tenant' => $req->input('del_id_tenant')])->delete();

        return redirect('dashboard-admin/tenant')->with(['msg' => 'Berhasil Menghapus Tenant', 'location' => 'tenant']);
    }
}
