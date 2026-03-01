<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class projectController extends Controller
{
    public function index(){
        $projects = Project::paginate(10);
        return view('project.index', compact('projects'));
    }

    public function create(){
        return view('project.create');
    }

    public function store(Request $request){
        $created_user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'status' => 'required|in:on-going,completed,pending,cancelled',
            'partner_id' => 'required|exists:partnership,id',
            'PM_id' => 'required|exists:user,id',
            'dueDate' => 'required|date'
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'deskripsi' => $validated['deskripsi'],
            'status' => $validated['status'],
            'partner_id' => $validated['partner_id'],
            'created_user_id' => $created_user->id,
            'PM_id' => $validated['PM_id'],
            'dueDate' => $validated['dueDate']
        ]);

        return redirect()->route('project.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project){
        return view('project.editForm', compact('project'));
    }

    public function update (Request $request, Project $project){
        $created_user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'status' => 'required|in:on-going,completed,pending,cancelled',
            'partner_id' => 'required|exists:partnership,id',
            'PM_id' => 'required|exists:user,id',
            'dueDate' => 'required|date'
        ]);

        $project->name = $validated['name'];
        $project->deskripsi = $validated['deskripsi'];
        $project->status = $validated['status'];
        $project->partner_id = $validated['partner_id'];
        $project->PM_id = $validated['PM_id'];
        $project->dueDate = $validated['dueDate'];

        $project->save();
        return redirect()->route('project.index')->with('success', 'Project created Successfully!');
    }

    public function destroy(Project $project){
        $project->delete();
        return redirect()->route('project.index')->with('success', 'Project deleted successfully!');
    }
}
