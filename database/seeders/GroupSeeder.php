<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->listGroups() as $group) {
            Group::create([
                'name'        => $group['name'],
                'description' => $group['description'],
            ]);
        }
    }

    public function listGroups()
    {
        return [
            [
                'name' => 'Musica', 
                'description' => 'Comparte tus gustos musicales.'
            ],
            [
                'name' => 'Videos', 
                'description' => 'Comparte lista de videos.'
            ],
            [
                'name' => 'Gatos', 
                'description' => 'Gatos kawai para toda la familia.'
            ],
            [
                'name' => 'Webs Recomendadas', 
                'description' => 'Lista de paginas Recomendadas.'
            ],
            [
                'name' => 'Tecnologia', 
                'description' => 'Nuevas novedades en aparatos electronicos.'
            ]
        ];
    }
}
