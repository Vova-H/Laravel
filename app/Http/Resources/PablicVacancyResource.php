<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PablicVacancyResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'amount_workers' => $this->amount_workers,
            'organization' => OrganizationResource::make($this->organization),
        ];
    }
}
