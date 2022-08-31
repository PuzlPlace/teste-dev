<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllBooksResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'author' => $this->author,
            'category' => $this->category->name,
            'file_type' => $this->getFileType(),
            'size_or_weight' => $this->size_or_weight,
            'registration_date' => $this->registration_date
        ];
    }
}
