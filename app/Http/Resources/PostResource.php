<?php

namespace App\Http\Resources;

use App\Models\Repost;
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
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'repost_user' => PostUserResource::collection($this->repost_user),
            'content' => $this->content,
            'images' => PostImageResource::collection($this->images),
            'user' => new PostUserResource($this->user),
        ];
    }
}
