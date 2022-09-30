<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class JSONAPICollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */


    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'included' => $this->mergeIncludedRelations($request),
        ];
    }


    private function mergeIncludedRelations($request)
    {
        $includes = $this->collection->flatMap
        ->included($request)
        ->unique()->values();
        return $includes->isNotEmpty() ? $includes : new MissingValue();
    }
}
