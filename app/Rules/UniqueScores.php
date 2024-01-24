<?php

namespace App\Rules;

use App\Models\DataKlasemen;
use Illuminate\Contracts\Validation\Rule;

class UniqueScores implements Rule
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function passes($attribute, $value)
    {
        $uniqueCheck = DataKlasemen::where('main', request('main_single_club'))
            ->where('menang', request('menang_single_club'))
            ->where('seri', request('seri_single_club'))
            ->where('kalah', request('kalah_single_club'))
            ->where('goal_menang', request('goal_menang_single_club'))
            ->where('goal_kalah', request('goal_kalah_single_club'));

        // Ignore the current record if updating
        if ($this->id) {
            $uniqueCheck->where('id_klasemen', '!=', $this->id);
        }

        // Check if the combination is unique
        return $uniqueCheck->doesntExist();
    }

    public function message()
    {
        $columns = ['main', 'menang', 'seri', 'kalah', 'goal_menang', 'goal_kalah'];

        $duplicateColumns = [];
        foreach ($columns as $column) {
            if (request($column) && DataKlasemen::where($column, request($column))->where('id_klasemen', '!=', $this->id)->exists()) {
                $duplicateColumns[] = $column;
            }
        }

        $duplicateColumnsNames = implode(', ', $duplicateColumns);

        return "Maaf!! Data Kolom $duplicateColumnsNames Sudah Ada Dalam Database.";
    }
}
