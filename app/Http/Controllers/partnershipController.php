<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partnership;

class partnershipController extends Controller
{
    public function listPartnership(Request $request)
    {
        $partnership = User::paginate(10);

        if ($request->ajax()) {
            return response()->json($partnership);
        }

        return view('admin.partnership.partnershipList', compact('partnership'));
    }

    public function create(){
        return view('partnership.create');
    }

    public function store(Request $request){
        $validated= $request->validate([
            'name' => 'required|string|max:50',
            'contact_identity' => 'required|string|max:50',
            'contact_number' => 'required|string|max:20',
            'fax_email' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

        $partnership = Partnership::create([
            'name' => $validated['name'],
            'contact_identity' => $validated['contact_identity'],
            'contact_number' => $validated['contact_number'],
            'fax_email' => $validated['fax_email'],
            'description' => $validated['description']
        ]);

        return redirect()->route('partnership.index')->with('success', 'partnership created successfully!');
    }

    public function edit(Partnership $partnership){
        return view('partnership.edit', compact('partnership'));
    }

    public function update(Request $request, Partnership $partnership){
        $validated= $request->validate([
            'name' => 'required|string|max:50',
            'contact_identity' => 'required|string|max:50',
            'contact_number' => 'required|string|max:20',
            'fax_email' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

        $partnership->name = $validated['name'];
        $partnership->contact_identity = $validated['contact_identity'];
        $partnership->contact_number = $validated['contact_number'];
        $partnership->fax_email = $validated['fax_email'];
        $partnership->description = $validated['description'];

        $partnership->save();
        return redirect()->route('partnership.index')->with('success', 'partnership updated successfully!');
    }

    public function destroy(Partnership $partnership){
        $partnership->delete();
        return redirect()->route('partnership.index')->with('success', 'Partnership deleted successfully!');
    }
}
