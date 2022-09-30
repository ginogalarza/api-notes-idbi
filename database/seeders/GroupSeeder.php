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
                'name'        => $group['name']
            ]);
        }
    }

    public function listGroups()
    {
        return [
            ['name' => 'Musica'],
            ['name' => 'Videos'],
            ['name' => 'Gatos'],
            ['name' => 'Webs Recomendadas'],
            ['name' => 'Tecnologia',]
        ];
    }
}
