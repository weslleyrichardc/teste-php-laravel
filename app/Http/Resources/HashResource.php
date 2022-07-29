<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HashResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "Batch" => $this->batch,
            "Bloco" => $this->block,
            "String" => $this->string,
            "Chave" => $this->key,
        ];
    }
}
