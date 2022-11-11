<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\IndexResource;
use App\Models\Order;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        $user = User::all();
//        $users = IndexResource::collection($user);
        $info = [];
        $info['users'] = $user->count();
        $info['performer'] = $user->where('role_id', 1)->count();
        $info['customer'] = $user->where('role_id', 2)->count();

        $info['userAllBalance'] = $user->sum("balance");
// Tasks
        $info['tasks'] = Task::where('status', 1)->count();
        $info['orders'] = Order::where('status', 0)->count();
        $info['ordersWin'] = Order::where('status', 2)->count();


// Orders
//        $info['ordersWinBalance'] = Order::where('status', 2)->sum("balance");

        return Inertia::render('Admin/Index', compact('info'));
    }
}
