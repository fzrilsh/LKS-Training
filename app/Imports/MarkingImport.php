<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class MarkingImport implements ToArray
{
    public function array(array $rows)
    {
        return $rows;
    }
}
