<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Judson Melo Bandeira',
                'email' => 'judson@linkn.com.br',
                'type' => 'administrador',
                'institution_id' => '1',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Armando Barbosa Sobrinho',
                'email' => 'armando@linkn.com.br',
                'type' => 'administrador',
                'institution_id' => '1',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Denys Fellipe Souza Rocha',
                'email' => 'denys@linkn.com.br',
                'type' => 'administrador',
                'institution_id' => '1',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Williams Lourenço de Alcantara',
                'email' => 'williams@linkn.com.br',
                'type' => 'administrador',
                'institution_id' => '1',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Andre Vinicius Teixeira Lima',
                'email' => 'andre.lima@eyeduc.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Alan Pedro da Silva',
                'email' => 'alan@eyeduc.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Geiser Chalco',
                'email' => 'geiser@eyeduc.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Edmilson Fialho',
                'email' => 'edmilson.fialho@eyeduc.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Ig Ibert Bittencourt',
                'email' => 'ig.ibert@eyeduc.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Seiji Isotani',
                'email' => 'sisotani@eyeduc.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Laiza Ribeiro Silva',
                'email' => 'laizaribeiro@usp.br',
                'type' => 'solicitante',
                'institution_id' => '3',
            ]
        );
    }
}
