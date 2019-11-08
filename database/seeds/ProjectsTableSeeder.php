<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert(
            [
                'name' => 'Camaleon Web',
                'institution_id' => 4
            ]           
        );

        DB::table('projects')->insert(
            [
                'name' => 'Camaleon App',
                'institution_id' => 4
            ]           
        );

        DB::table('projects')->insert(
            [
                'name' => 'Avance',
                'institution_id' => 3
            ]           
        );
		
		DB::table('projects')->insert(
            [
                'name' => 'Parceria',
                'institution_id' => 2
            ]           
        );
    }
}
