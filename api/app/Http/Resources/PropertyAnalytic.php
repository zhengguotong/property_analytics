<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyAnalytic extends JsonResource
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
            'analytic_name' => $this->analyticType->name,
            'analytic_unit' => $this->analyticType->units,
            'value' => $this->value,
        ];
    }
}
