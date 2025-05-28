<?php


namespace App\Http\Controllers\Back\BlockedIps;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlockedIp;

class BlockedIpController extends Controller
{
    public function index()
    {
        $ips = BlockedIp::latest()->paginate(10);
        return view('back.blocked_ips.index', compact('ips'));
    }

    public function create()
    {
        return view('back.blocked_ips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip' => 'required|ip|unique:blocked_ips',
            'reason' => 'nullable|string'
        ]);

        BlockedIp::create($request->all());
        return redirect()->route('blocked-ips.index')->with('success', 'IP blocked successfully.');
    }

    public function edit(BlockedIp $blockedIp)
    {
        return view('back.blocked_ips.edit', compact('blockedIp'));
    }

    public function update(Request $request, BlockedIp $blockedIp)
    {
        $request->validate([
            'ip' => 'required|ip|unique:blocked_ips,ip,' . $blockedIp->id,
            'reason' => 'nullable|string'
        ]);



        $blockedIp->update($request->all());
        return redirect()->route('blocked-ips.index')->with('success', 'IP updated.');
    }

    public function destroy(BlockedIp $blockedIp)
    {
        $blockedIp->delete();
        return redirect()->route('blocked-ips.index')->with('success', 'IP unblocked.');
    }
}

