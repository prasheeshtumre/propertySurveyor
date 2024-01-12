<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Budget;

class BudgetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $budgets = [
            ['amount' => 5,  'unit' => 5, 'type' => 1],
            ['amount' => 10, 'unit' => 5, 'type' => 1],
            ['amount' => 15, 'unit' => 5, 'type' => 1],
            ['amount' => 20, 'unit' => 5, 'type' => 1],
            ['amount' => 25, 'unit' => 5, 'type' => 1],
            ['amount' => 30, 'unit' => 5, 'type' => 1],
            ['amount' => 40, 'unit' => 5, 'type' => 1],
            ['amount' => 50, 'unit' => 5, 'type' => 1],
            ['amount' => 60, 'unit' => 5, 'type' => 1],
            ['amount' => 75, 'unit' => 5, 'type' => 1],
            ['amount' => 90, 'unit' => 5, 'type' => 1],
            ['amount' => 1,  'unit' => 6, 'type' => 1],
            ['amount' => 1.25, 'unit' => 6, 'type' => 1],
            ['amount' => 1.5, 'unit' => 6, 'type' => 1],
            ['amount' => 1.75, 'unit' => 6, 'type' => 1],
            ['amount' => 2, 'unit' => 6, 'type' => 1],
            ['amount' => 3, 'unit' => 6, 'type' => 1],
            ['amount' => 4, 'unit' => 6, 'type' => 1],
            ['amount' => 5, 'unit' => 6, 'type' => 1],
            ['amount' => 10, 'unit' => 6, 'type' => 1],
            ['amount' => 20, 'unit' => 6, 'type' => 1],
            ['amount' => 30, 'unit' => 6, 'type' => 1],
            ['amount' => 50, 'unit' => 6, 'type' => 1],
            ['amount' => 60, 'unit' => 6, 'type' => 1],
            ['amount' => 70, 'unit' => 6, 'type' => 1],
            ['amount' => 1, 'unit' => 7, 'type' => 2],
            ['amount' => 2, 'unit' => 7, 'type' => 2],
            ['amount' => 3, 'unit' => 7, 'type' => 2],
            ['amount' => 4, 'unit' => 7, 'type' => 2],
            ['amount' => 5, 'unit' => 7, 'type' => 2],
            ['amount' => 6, 'unit' => 7, 'type' => 2],
            ['amount' => 7, 'unit' => 7, 'type' => 2],
            ['amount' => 8, 'unit' => 7, 'type' => 2],
            ['amount' => 9, 'unit' => 7, 'type' => 2],
            ['amount' => 10, 'unit' => 7, 'type' => 2],
            ['amount' => 11, 'unit' => 7, 'type' => 2],
            ['amount' => 12, 'unit' => 7, 'type' => 2],
            ['amount' => 13, 'unit' => 7, 'type' => 2],
            ['amount' => 14, 'unit' => 7, 'type' => 2],
            ['amount' => 15, 'unit' => 7, 'type' => 2],
            ['amount' => 16, 'unit' => 7, 'type' => 2],
            ['amount' => 17, 'unit' => 7, 'type' => 2],
            ['amount' => 18, 'unit' => 7, 'type' => 2],
            ['amount' => 19, 'unit' => 7, 'type' => 2],
            ['amount' => 20, 'unit' => 7, 'type' => 2],
            ['amount' => 21, 'unit' => 7, 'type' => 2],
            ['amount' => 22, 'unit' => 7, 'type' => 2],
            ['amount' => 23, 'unit' => 7, 'type' => 2],
            ['amount' => 24, 'unit' => 7, 'type' => 2],
            ['amount' => 25, 'unit' => 7, 'type' => 2],
            ['amount' => 26, 'unit' => 7, 'type' => 2],
            ['amount' => 27, 'unit' => 7, 'type' => 2],
            ['amount' => 28, 'unit' => 7, 'type' => 2],
            ['amount' => 29, 'unit' => 7, 'type' => 2],
            ['amount' => 30, 'unit' => 7, 'type' => 2],
            ['amount' => 35, 'unit' => 7, 'type' => 2],
            ['amount' => 40, 'unit' => 7, 'type' => 2],
            ['amount' => 45, 'unit' => 7, 'type' => 2],
            ['amount' => 50, 'unit' => 7, 'type' => 2],
            ['amount' => 55, 'unit' => 7, 'type' => 2],
            ['amount' => 60, 'unit' => 7, 'type' => 2],
            ['amount' => 65, 'unit' => 7, 'type' => 2],
            ['amount' => 70, 'unit' => 7, 'type' => 2],
            ['amount' => 75, 'unit' => 7, 'type' => 2],
            ['amount' => 80, 'unit' => 7, 'type' => 2],
            ['amount' => 85, 'unit' => 7, 'type' => 2],
            ['amount' => 90, 'unit' => 7, 'type' => 2],
            ['amount' => 95, 'unit' => 7, 'type' => 2],
            ['amount' => 1, 'unit' => 5, 'type' => 2],
            ['amount' => 1.1, 'unit' => 5, 'type' => 2],
            ['amount' => 1.2, 'unit' => 5, 'type' => 2],
            ['amount' => 1.3, 'unit' => 5, 'type' => 2],
            ['amount' => 1.4, 'unit' => 5, 'type' => 2],
            ['amount' => 1.5, 'unit' => 5, 'type' => 2],
            ['amount' => 1.6, 'unit' => 5, 'type' => 2],
            ['amount' => 1.7, 'unit' => 5, 'type' => 2],
            ['amount' => 1.8, 'unit' => 5, 'type' => 2],
            ['amount' => 1.9, 'unit' => 5, 'type' => 2],
            ['amount' => 2, 'unit' => 5, 'type' => 2],
            ['amount' => 2.25, 'unit' => 5, 'type' => 2],
            ['amount' => 2.5, 'unit' => 5, 'type' => 2],
            ['amount' => 2.75, 'unit' => 5, 'type' => 2],
            ['amount' => 3, 'unit' => 5, 'type' => 2],
            ['amount' => 3.25, 'unit' => 5, 'type' => 2],
            ['amount' => 3.5, 'unit' => 5, 'type' => 2],
            ['amount' => 3.75, 'unit' => 5, 'type' => 2],
            ['amount' => 4, 'unit' => 5, 'type' => 2],
            ['amount' => 4.25, 'unit' => 5, 'type' => 2],
            ['amount' => 4.5, 'unit' => 5, 'type' => 2],
            ['amount' => 4.75, 'unit' => 5, 'type' => 2],
            ['amount' => 5, 'unit' => 5, 'type' => 2],
            ['amount' => 6, 'unit' => 5, 'type' => 2],
            ['amount' => 7, 'unit' => 5, 'type' => 2],
            ['amount' => 8, 'unit' => 5, 'type' => 2],
            ['amount' => 9, 'unit' => 5, 'type' => 2],
            ['amount' => 10, 'unit' => 5, 'type' => 2],
        ];

        foreach ($budgets as $budget) {
            Budget::create($budget);
        }
    }
}
