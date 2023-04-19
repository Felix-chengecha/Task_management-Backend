<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'user_id'=> $this->user_id,
            'task'=> $this->name,
            'due_date'=> $this->due_date,
            'start_time'=> $this->start_time,
            'end_time'=> $this->end_time,
            'remarks' => $this->remarks,
            'status' => $this->status_name

        ];
    }
}
