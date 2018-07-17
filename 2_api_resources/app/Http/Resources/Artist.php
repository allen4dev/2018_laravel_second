<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Artist extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $songs = $request->has('withSongs')
            ? $songs = Song::collection($this->whenLoaded('songs'))
            : $this->songs->pluck('id');

        return [
            'id'          => $this->id,
            'user_id'     => $this->user_id,
            'firstname'   => $this->firstname,
            'lastname'    => $this->lastname,
            'nickname'    => $this->nickname,
            'photo_url'   => $this->photo_url,
            'age'         => $this->age,
            'description' => $this->description,
            'created_at'  => (string) $this->created_at,
            'updated_at'  => (string) $this->updated_at,
            'songs'       => $songs,
        ];
    }
}
