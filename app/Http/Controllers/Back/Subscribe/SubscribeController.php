<?php

namespace App\Http\Controllers\Back\Subscribe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Models\User;

class SubscribeController extends Controller
{
    public function index()
    {
        $subscribes = Subscribe::with('user')->latest()->paginate(10);
        return view('back.subscribe.index', compact('subscribes'));
    }

    public function create()
    {
        $users = User::all();
        return view('back.subscribe.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan' => 'required|string|max:255',
            'status' => 'required|in:active,expired,canceled',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // dump($request->user_id);
        // dump($request->stripe_subscription_id);
        // dump($request->plan);
        // dump($request->amount);
        // dump($request->status);
        // dump($request->start_date);
        // dd($request->end_date);

        Subscribe::create($request->all());

        return redirect()->route('subscribe.index')->with('success', 'Subscription added successfully.');
    }

    public function edit(Subscribe $subscribe)
    {
        $users = User::all();
        return view('back.subscribe.edit', compact('subscribe', 'users'));
    }

    public function update(Request $request, Subscribe $subscribe)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan' => 'required|string|max:255',
            'status' => 'required|in:active,expired,canceled',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $subscribe->update($request->all());

        return redirect()->route('subscribe.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();

        return redirect()->route('subscribe.index')->with('success', 'Subscription deleted successfully.');
    }
}
