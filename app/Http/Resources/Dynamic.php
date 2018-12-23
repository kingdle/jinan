<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Dynamic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'area_id' => $this->area_id,
            'title' => $this->title,
            'abstract'=>str_limit($this->abstract, $limit = 300, $end = '...'),
            'content' => $this->content,
            'pic' => $this->pic,
            'published_at' => $this->published_at,
            'is_hidden' => $this->is_hidden,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
