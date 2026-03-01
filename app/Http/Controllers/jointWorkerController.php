<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JointWorker;
use App\Models\User;

class jointWorkerController extends Controller
{
    public function index(){
        $joint_workers= JointWorker::paginate(10);
        return redirect()->route('jointWorker.index', compact('joint_workers'));
    }

    public function create(){
        return view('jointWorker.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'project_id' => 'required|exists:Project,id',
            'PM_id' => 'required|exist:User,id',
            'worker_id' => 'required|exists:User,id'
        ]);

        $jointWorkers= JointWorker::create([
            'project_id' => $validated['project_id'],
            'PM_id' => $validated['PM_id'],
            'worker_id' => $validated['worker_id']
        ]);

        return redirect()->route('jointWorker.index')->with('success', 'Worker that joint project added successfully!');
    }

    public function edit(JointWorker $jointWorker){
        return view('jointWorker.edit', compact('jointWorker'));
    }

    public function update(Request $request,JointWorker $jointWorker){
        $validated = $request->validate([
            'project_id' => 'required|exists:Project,id',
            'PM_id' => 'required|exist:User,id',
            'worker_id' => 'required|exists:User,id'
        ]);

        $jointWorker->project_id = $validated['project_id'];
        $jointWorker->PM_id = $validated['PM_id'];
        $jointWorker->worker_id = $validated['worker_id'];

        $jointWorker->save();
        return redirect()->route('jointWorker.index')->with('success', 'Worker that joint into project changed successfully!');
    }

    public function destroy(JointWorker $jointWorker){
        $jointWorker->delete();
        return redirect()->route('jointWorker.index')->with('success', 'Worker that joint to the project deleted successfully!');
    }
}
