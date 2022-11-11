<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->get();
        $userResource = ProfileResource::collection($user);
        return Inertia::render('Profile', compact('userResource'));
    }
}
