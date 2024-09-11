<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            "image"=>asset('uploads/'.$this->image),
            "create_date"=>$this->create_date,
            "deleted_at"=>$this->deleted_at,
            "slug"=>$this->slug,
            "creator"=>new CreatorResource($this->creator)

        ];
    }
}
