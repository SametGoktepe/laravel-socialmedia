<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PostUserResource extends JsonResource
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
            'name' => $this->name,
            'avatar' => $this->avatar,
            'created_at' => $this->created_at(),
        ];
    }

    public function created_at()
    {
        $date = Carbon::parse($this->created_at);
        $now = Carbon::now();

        if ($date->diffInDays($now) > 0) {
            return $date->format('d.m.Y');
        } else {
            return $date->diffForHumans();
        }
    }
}
