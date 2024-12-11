<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    protected $table = 'tenant'; 
    protected $primaryKey = 'id_tenant'; 
    public $timestamps = true;

    protected $fillable = ['name_tenant', 'logo_tenant', 'desc_tenant', 'owner_name'];
}
