<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'fields' => $this->fields->map(function ($field) {
                return [
                    'name' => $field->field_name,
                    'type' => $field->field_type,
                    'content' => $field->contents->first()->content ?? null,
                ];
            }),
        ];
    }
}
