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
		DB::table('users')->insert(
            [
                'name' => 'Romero Tori',
                'email' => 'romero.tori@gmail.com',
                'type' => 'solicitante',
                'institution_id' => '3',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Especialização ICMC',
                'email' => 'especializacao@icmc.usp.br',
                'type' => 'solicitante',
                'institution_id' => '3',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Carlos Jardim',
                'email' => 'carlos.jardim@conexia.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Leonardo Pontes',
                'email' => 'leonardo.pontes@conexia.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Diego Volpe Vieira',
                'email' => 'diego.volpe@conexia.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Reginaldo Aparecido Gotardo',
                'email' => 'reginaldo.gotardo@conexia.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Guilherme Oliveira',
                'email' => 'guilherme.oliveira@conexia.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
    }
}
