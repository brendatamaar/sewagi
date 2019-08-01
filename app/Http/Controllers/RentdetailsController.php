<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class RentdetailsController extends Controller
{
    function index() {
        return view('rent_details');
    }
}
