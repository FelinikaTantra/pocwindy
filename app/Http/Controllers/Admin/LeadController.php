<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::with('product')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('whatsapp', 'like', '%' . $request->search . '%')
                  ->orWhere('product_name', 'like', '%' . $request->search . '%');
            });
        }

        $leads = $query->paginate(20)->withQueryString();

        $counts = [];
        foreach (array_keys(Lead::STATUSES) as $s) {
            $counts[$s] = Lead::where('status', $s)->count();
        }

        return view('admin.leads.index', compact('leads', 'counts'));
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Lead::STATUSES)),
        ]);

        $data = ['status' => $request->status];

        if ($request->status === 'contacted' && !$lead->contacted_at) {
            $data['contacted_at'] = now();
        }

        $lead->update($data);

        if ($request->expectsJson()) {
            return response()->json(['ok' => true, 'status' => $request->status]);
        }

        return redirect()->back()->with('success', 'Status lead diperbarui.');
    }

    public function updateNotes(Request $request, Lead $lead)
    {
        $request->validate(['notes' => 'nullable|string|max:2000']);
        $lead->update(['notes' => $request->notes]);
        return redirect()->back()->with('success', 'Catatan disimpan.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead dihapus.');
    }
}
