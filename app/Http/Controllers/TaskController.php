<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\TaskStoreRequest;
use App\Models\Option;
use App\Models\Task;
use App\Models\TaskOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {

        return Inertia::render('Tasks/ListView');
    }

    public function myTask()
    {
        $tasks = Task::query()
            ->where('customer_id', Auth::id())
            ->with('options')
            ->get();
        return Inertia::render('Tasks/MyView', compact('tasks'));
    }

    public function createTask()
    {
        $optionsParent = Option::query()
            ->where('parent_id', null)
            ->with('children')
            ->get();
//        $parentOption = Option::whereNotNull('parent_id')->get();
        return Inertia::render('Tasks/CreateView', compact('optionsParent'));
    }

    public function storeTask(TaskStoreRequest $request)
    {
        $data = $request->validated();
        $options = $data['selectedOptions'];

        $task = Task::create([
            'customer_id' => Auth::id(),
            'status' => 1,
            'amount' => $data['amount'],
            'delivery_date' => $data['deliveryDate'],
            'link' => $data['link'],
            'description' => $data['description'],
            'report' => $data['report'],
        ]);

        foreach ($options as $option) {
            TaskOption::create([
                'task_id' => $task->id,
                'option_id' => $option
            ]);
        }

    }
}
