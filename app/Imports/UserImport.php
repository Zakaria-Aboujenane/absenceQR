<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class UserImport implements WithMultipleSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Etudiants' => new SecondSheetImport(),
            'Profs' => new SecondSheetImport(),
            'Filieres' => new ThirdSheetImport(),
        ];
    }
}
