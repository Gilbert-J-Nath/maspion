<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view
//     ('welcome.template.header').
//     ('welcome.landing_page').
//     ('admin.footer');
// });

Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard-admin/tenant', [DashboardController::class, 'index_tenant']);
Route::post('/dashboard-admin/tenant/store', [DashboardController::class, 'store_tenant']);
Route::post('/dashboard-admin/tenant/update', [DashboardController::class, 'update_tenant']);
Route::post('/dashboard-admin/tenant/delete', [DashboardController::class, 'delete_tenant']);

Route::get('home', [HomeController::class, 'index']);