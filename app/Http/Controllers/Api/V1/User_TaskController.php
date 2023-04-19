<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User_tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserTaskRequest;
use App\Http\Resources\UserTasksResource;

class User_TaskController extends Controller
{
    public function index() {

        return UserTasksResource::collection( DB::table('user_tasks')
        ->select( 'user_tasks.id', 'user_tasks.user_id', 'tasks.name', 'user_tasks.due_date', 'user_tasks.start_time', 'user_tasks.end_time',
          'user_tasks.remarks', 'statuses.status_name')
         ->leftJoin('tasks', 'tasks.id', '=', 'user_tasks.tasks_id')
         ->leftJoin('statuses', 'statuses.id', '=', 'user_tasks.status_id')
        ->get() );

    }



    public function show($id)
    {
        try {

        // return UserTasksResource::collection(User_tasks::where('id',$id)->get());
        return UserTasksResource::collection( DB::table('user_tasks')
        ->select( 'user_tasks.id', 'user_tasks.user_id', 'tasks.name', 'user_tasks.due_date', 'user_tasks.start_time', 'user_tasks.end_time',
          'user_tasks.remarks', 'statuses.status_name')
         ->leftJoin('tasks', 'tasks.id', '=', 'user_tasks.tasks_id')
         ->leftJoin('statuses', 'statuses.id', '=', 'user_tasks.status_id')
         ->where('user_tasks.id', '=', $id)
         ->get() );

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }



    public function store(UserTaskRequest $request)
    {
        try {
           User_tasks::create($request->validated());
            return response()->json(["msg" => 'new user task added successfully']);

          } catch (\Exception  $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'message' => 'something went wrong'
                ]);
        }
    }



    public function update(Request $request, $id)  {
        try {
            $updates = User_tasks::findOrFail($id);

            $validatedData = $request->validate([
                'user_id'=> 'required|exists:users,id',
                'tasks_id' => 'required|exists:tasks,id',
                'due_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'remarks' => 'required|string|max:255',
                'status_id'=> 'required|exists:statuses,id'
            ]);

               $updates->fill($validatedData)->save();
            return response()->json(["msg" => 'user Task updated']);

             } catch (\Exception  $e) {

            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'something went wrong'
            ]);
        }
    }


    public function destroy($id)
    {
        $utask = User_tasks::findOrFail($id);

        $utask->delete();

        return response()->json(['msg' => 'task deleted']);


    }




}
