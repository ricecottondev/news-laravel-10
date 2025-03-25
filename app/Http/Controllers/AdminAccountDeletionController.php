<?php

namespace App\Http\Controllers;

use App\Models\AccountDeletionRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAccountDeletionController extends Controller {
    public function index() {
        $requests = AccountDeletionRequest::where('status', 'pending')->get();
        return view('admin.deletion_requests', compact('requests'));
    }

    public function approve($id) {
        $request = AccountDeletionRequest::findOrFail($id);
        $user = User::find($request->user_id);

        if ($user) {
            $user->delete();
            $request->update(['status' => 'approved']);
        }

        return back()->with('success', 'User account deleted.');
    }

    public function reject($id) {
        $request = AccountDeletionRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Deletion request rejected.');
    }
}
