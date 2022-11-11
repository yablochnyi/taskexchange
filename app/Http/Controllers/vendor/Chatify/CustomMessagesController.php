<?php

namespace App\Http\Controllers\vendor\Chatify;

use App\Events\MessageSend;
use App\Http\Requests\MessageRequest;
use App\Models\ChMessage;
use App\Models\ChtaMessage;
use App\Models\User;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomMessagesController extends Controller
{
    public function index(): \Inertia\Response
    {
        $messages = ChtaMessage::query()
            ->with('user')
            ->get();
        return Inertia::render('Messages/Test', compact('messages'));
    }

    public function messages(): \Inertia\Response
    {
        $messages = ChtaMessage::query()
            ->with('user')
            ->get();
        return Inertia::render('Messages/Test', compact('messages'));
    }

    public function create(MessageRequest $request)
    {
        $message = $request->user()
            ->messages()
            ->create($request->validated());

        broadcast(new MessageSend($request->user(), $message));

    }
}
