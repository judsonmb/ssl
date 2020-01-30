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
                'email' => 'judson@email.com.br',
                'type' => 'administrador',
                'institution_id' => '1',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Armando Barbosa Sobrinho',
                'email' => 'armando@email.com.br',
                'type' => 'administrador',
                'institution_id' => '1',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Denys Fellipe Souza Rocha',
                'email' => 'denys@email.com.br',
                'type' => 'administrador',
                'institution_id' => '1',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Williams Lourenço de Alcantara',
                'email' => 'williams@email.com.br',
                'type' => 'administrador',
                'institution_id' => '1',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Andre Vinicius Teixeira Lima',
                'email' => 'andre.lima@email.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Alan Pedro da Silva',
                'email' => 'alan@email.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Geiser Chalco',
                'email' => 'geiser@email.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Edmilson Fialho',
                'email' => 'edmilson.fialho@email.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Ig Ibert Bittencourt',
                'email' => 'ig.ibert@email.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Seiji Isotani',
                'email' => 'sisotani@email.com.br',
                'type' => 'parceiro',
                'institution_id' => '2',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Laiza Ribeiro Silva',
                'email' => 'laizaribeiro@email.br',
                'type' => 'solicitante',
                'institution_id' => '3',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Romero Tori',
                'email' => 'romero.tori@email.com',
                'type' => 'solicitante',
                'institution_id' => '3',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Especialização ICMC',
                'email' => 'especializacao@email.usp.br',
                'type' => 'solicitante',
                'institution_id' => '3',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Carlos Jardim',
                'email' => 'carlos.jardim@email.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Leonardo Pontes',
                'email' => 'leonardo.pontes@email.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Diego Volpe Vieira',
                'email' => 'diego.volpe@email.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Reginaldo Aparecido Gotardo',
                'email' => 'reginaldo.gotardo@email.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
		DB::table('users')->insert(
            [
                'name' => 'Guilherme Oliveira',
                'email' => 'guilherme.oliveira@email.com.br',
                'type' => 'solicitante',
                'institution_id' => '4',
            ]
        );
    }
}
