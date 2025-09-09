<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Dashboard';
        return view('alza_admin.alza_modul.alza_dashboard',compact('title'));
    }
}
