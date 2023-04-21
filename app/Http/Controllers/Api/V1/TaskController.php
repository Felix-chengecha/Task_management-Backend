<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Tasks;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class TaskController extends Controller
{

    public function index()  {
        // return TaskResource::collection(Tasks::all());

        return TaskResource::collection( DB::table('tasks')
        ->select( 'tasks.id', 'tasks.name', 'tasks.description', 'tasks.due_date',
        'tasks.status_id','statuses.status_name')
         ->leftJoin('statuses', 'statuses.id', '=', 'tasks.status_id')
        ->get() );
    }


    public function show($id)  {

        // return   DB::table('tasks')

        //        ->select( 'tasks.id', 'tasks.name', 'tasks.description', 'tasks.due_date',
        //        'tasks.status_id','statuses.status_name')
        //         ->leftJoin('statuses', 'statuses.id', '=', 'tasks.status_id')
        //        ->where('tasks.id', '=', $id)
        //        ->get() ;

        return Tasks::select('tasks.id', 'tasks.name', 'tasks.description', 'tasks.due_date', 'tasks.status_id', 'statuses.status_name')
            ->leftJoin('statuses', 'statuses.id', '=', 'tasks.status_id')
            ->where('tasks.id', $id)
            ->get()
            ->toArray();


    }


    public function store(TaskRequest $request) {
        try {
            Tasks::create($request->validated());
            return response()->json(["msg" => 'new task added successfully']);
        } catch (\Exception  $e) {

            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'something went wrong'
            ]);
        }
    }


    public function update(Request $request, $id) {

      $updates = Tasks::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'due_date' => 'required',
            'status_id'=> 'required|exists:statuses,id'
        ]);

           $updates->fill($validatedData)->save();
        return response()->json(["msg" => 'Task updated']);
    }



    public function destroy(Tasks $task)
    {
        $task->delete();
        return response()->json(['msg' => 'task deleted']);
    }
}
