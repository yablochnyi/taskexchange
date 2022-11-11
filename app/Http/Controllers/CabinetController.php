<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CabinetController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $quantityTasks = $user->offers->count();

        return Inertia::render('CabinetView', compact('quantityTasks'));
    }
}
