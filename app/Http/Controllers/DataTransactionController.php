<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataTransactionController extends Controller
{
    //
    public function index()
    {
        return view('admin.data-transaction.index');
    }
}
