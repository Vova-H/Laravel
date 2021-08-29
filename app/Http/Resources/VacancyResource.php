<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'amount_workes' => $this->amount_workers,
            'organization' => OrganizationResource::make($this->organization),
            'workers_book' => UserResource::collection($this->users),
        ];
    }
}
