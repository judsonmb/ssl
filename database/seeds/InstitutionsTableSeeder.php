<?php

use Illuminate\Database\Seeder;

class InstitutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert(
            [
                'initials' => 'LINKN',
                'name' => 'Linked Knowledge',
            ]           
        );

        DB::table('institutions')->insert(
            [
                'initials' => 'EYEDUC',
                'name' => 'Eyeduc Inteligência Educacional',
            ]         
        );

        DB::table('institutions')->insert(
            [
                'initials' => 'ICMC USP',
                'name' => 'Instituto de Ciências Matemáticas e de Computação',
            ]         
        );

        DB::table('institutions')->insert(
            [
                'initials' => 'SEB',
                'name' => 'Sistema Educacional Brasileiro',
            ]         
        );

        DB::table('institutions')->insert(
            [
                'initials' => 'PEARSON',
                'name' => 'PEARSON PLC',
            ]         
        );
    }
}
