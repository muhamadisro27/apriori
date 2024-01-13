<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AprioriController extends Controller
{
    //

    public function index()
    {
        return view('admin.apriori.index');
    }
}
