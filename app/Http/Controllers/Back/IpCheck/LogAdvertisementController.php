<?php


namespace App\Http\Controllers\Back\IpCheck;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogAdvertisement;

class LogAdvertisementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'advertisement' => 'required|string|max:255',
            'created_at' => 'nullable|date',
        ]);

        LogAdvertisement::create([
            'advertisement' => $request->advertisement,
            'created_at' => $request->created_at ?? now(),
        ]);

         return redirect('/back/log-advertisement')->with('success', 'Advertisement log saved successfully.');
    }

    public function index()
    {
        $logs = LogAdvertisement::latest()->get();
        return view('back.log_advertisement.index', compact('logs'));
    }

    public function destroy($id)
    {
        $log = LogAdvertisement::findOrFail($id);
        $log->delete();

        return redirect()->route('log_advertisement.index')->with('success', 'Log berhasil dihapus.');
    }
}
