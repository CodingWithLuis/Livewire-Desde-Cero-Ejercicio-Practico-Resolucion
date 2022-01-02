<?php

namespace Database\Seeders;

use App\Models\EmployeeStatus;
use Illuminate\Database\Seeder;

class EmployeeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $statuses = [
            [
                'name' => 'Permiso Médico'
            ],
            [
                'name' => 'De vacaciones'
            ],
            [
                'name' => 'Activo'
            ],
            [
                'name' => 'Despedido'
            ],
        ];

        foreach ($statuses as $status) {
            EmployeeStatus::create($status);
        }
    }
}
