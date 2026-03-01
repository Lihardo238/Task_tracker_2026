<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalTask;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PersonalTaskController extends Controller
{
    // public function index()
    // {
    //     $tasks = auth()->user()
    //         ->personalTasks()
    //         ->latest()
    //         ->paginate(10);

    //     if ($request->ajax()) {
    //         return response()->json($tasks);
    //     }

    //     return view('pTask.index', compact('tasks'));
    // }

    public function create()
    {
        return view(pTask.create);
    }

    // public function store(Request $request)
    // {
    //     $create_user= auth()->user();
    //     $validated = $request->validate([
    //         'title'=> 'required|string|max:50',
    //         'deskripsi' => 'nullable|string',
    //         'dueDate' => 'required|date',
    //         'status' => 'required|in:on-going,completed,pending,cancelled',
    //     ]);

    //     $task= PersonalTask::create([
    //         'user_id' => $create_user->id,
    //         'title' => $validated['title'],
    //         'deskripsi' => $validated['deskripsi'],
    //         'dueDate' => $validated['dueDate'],
    //         'status' => $validated['status']
    //     ]);

    //     return redirect()->route('pTask.list')
    //         ->with('success', 'Personal task created successfully.');
    // }

    public function edit(PersonalTask $task){
        return view('pTask.editForm',compact('task'));
    }

    public function update(Request $request, PersonalTask $task)
    {
        $validated = $request->validate([
            'title'=> 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'dueDate' => 'required|date',
            'status' => 'required|in:on-going,completed,pending,cancelled',
        ]);

        $task->title = $validated['title'];
        $task->deskripsi = $validated['deskripsi'];
        $task->dueDate = $validated['dueDate'];
        $task->status = $validated['status'];

        $task->save();
        return redirect()->route('pTask.index')->with('success', 'Personal task updated successfully!');
    }

    public function destroy(PersonalTask $task){
        $task->delete();
        return redirect()->route('pTask.index')->with('success', 'Personal task deleted successfully!');
    }

    public function index()
    {
        return view('personal_tasks.index');
    }

    public function list()
    {
        $tasks = PersonalTask::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'dueDate' => 'required|date',
        ]);

        $task = PersonalTask::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'dueDate' => $request->dueDate,
            'status' => 'pending'
        ]);

        return response()->json($task);

    //     return response()->json([
    //     'message' => 'Route working'
    // ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $task = PersonalTask::findOrFail($id);

        $task->status = $request->status;
        $task->save();

        return response()->json(['success' => true]);
    }

}
