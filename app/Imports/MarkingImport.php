<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MarkingImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $filtered = $rows->filter(function ($row) {
            return isset($row[3]) && $row[3] === 'M';
        });

        $results = $filtered->map(function ($row) {
            return [
                'description' => $row[4] ?? null,
                'total_point' => $row[10] ?? null,
                'point' => 0
            ];
        });

        return $results;
    }
}
