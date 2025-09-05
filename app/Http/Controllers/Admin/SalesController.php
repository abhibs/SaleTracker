<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(){
        $datas = Sale::latest()->get();
        return view('admin.sales.index', compact('datas'));
    }
}
