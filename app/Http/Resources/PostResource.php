<?php

namespace App\Http\Resources;

use Carbon\Carbon;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' =>new UserResource($this->user),
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'content' => $this->content,
            'tags' => CategoryResource::collection($this->tags),
            // 'name' => $this->name,
            // 'description' => $this->description,
            'created_at' => Carbon::createFromFormat("Y-m-d H:i:s", $this->created_at)
                ->format('d-m-Y')

        ];
    }
}
