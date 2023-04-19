<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return StatusResource::collection(Status::all());
    }


    public function show(Status $status) {
        return new StatusResource($status);
    }

    public function store(StatusRequest $request)
    {
        Status::create($request->validated());
        return response()->json(["msg" => 'new status added']);
    }


    public function update(StatusRequest $request, Status $status)
    {
        $status->update($request->validated());
        return response()->json(["msg" => 'Status updated']);
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return response()->json(['msg' => 'status deleted']);
    }
}
