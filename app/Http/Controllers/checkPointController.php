<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckPoint;
use App\Models\Project;
use App\Models\User;

class checkPointController extends Controller
{
    public function listPage(){
        return view('checkPoint.index');
    }

    public function index(Project $project){
        $checkPoints = $project->checkPoints()->paginate(10);
        return view('checkPoint.index', compact('checkPoints', 'project'));
    }

    public function create(){
        return view('checkPoint.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'project_id' => 'required|exists:Project,id',
            'pm_id' => 'required|exists:User,id',
            'title' => 'required|string|max:50',
            'dueDate' => 'required|date'
        ]);

        $checkPoint = CheckPoint::create([
            'project_id' => $validated['project_id'],
            'pm_id' => $validated['pm_id'],
            'title' => $validated['title'],
            'dueDate' => $validated['dueDate']
        ]);

        return redirect()->route('checkPoint.index')->with('success', 'checkPoint created successfully!');       
    }

    public function edit(CheckPoint $checkPoint){
        return view('checkPoint.edit', compact('checkPoint'));
    }

    public function update(Request $request, CheckPoint $checkPoint){
        $validated = $request->validate([
            'project_id' => 'required|exists:Project,id',
            'pm_id' => 'required|exists:User,id',
            'title' => 'required|string|max:50',
            'dueDate' => 'required|date'
        ]);

        $checkPoint->project_id = $validated['project_id'];
        $checkPoint->pm_id = $validated['pm_id'];
        $checkPoint->title = $validated['title'];
        $checkPoint->dueDate = $validated['dueDate'];

        $checkPoint->save();
        return redirect()->route('checkPoint.index')->with('success', 'Check Point updated successfully!');
    }

    public function destroy(CheckPoint $checkPoint){
        $checkPoint->delete();
        return redirect()->route('checkPoint.index')->with('success', 'Checkpoint has removed successfully!');
    }
}
