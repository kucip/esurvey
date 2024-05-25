<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return [
        //     'compId' => $this->compId,
        //     'compNama' => $this->compNama,
        //     'compPemilik' => $this->compPemilik,
        // ];
        return parent::toArray($request);
    }
}
