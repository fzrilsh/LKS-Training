<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class MarkingImport implements ToArray
{
    /**
    * @param Array $rows
    */
    public function array(array $rows)
    {
        $filtered = collect($rows)->filter(function ($row) {
            return isset($row[3]) && $row[3] === 'M';
        });

        $results = $filtered->map(function ($row) {
            return [
                'description' => $row[4] ?? null,
                'total_point' => $row[10] ?? null,
                'point' => 0
            ];
        });

        return $results->toArray();
    }
}
