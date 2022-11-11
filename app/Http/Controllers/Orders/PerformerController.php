<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PerformerController extends Controller
{
    public function index()
    {
        return Inertia::render('Orders/PerformerView');
    }
}
