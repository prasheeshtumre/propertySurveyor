<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueCombination implements Rule
{
    protected $table;
    protected $columns;
    protected $values;

    public function __construct($table, $columns, $values)
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->values = $values;
    }

    public function passes($attribute, $value)
    {
        // dd($attribute);
        // Query the database to check if the combination of values is unique
        $result = DB::table($this->table)
            ->where(function ($query) {
                foreach ($this->columns as $key => $column) {
                    $query->where($column, $this->values[$key]);
                }
            })
            ->count();

        return $result === 0;
    }

    public function message()
    {
        return 'The combination of values in the specified columns is not unique.';
    }
}
