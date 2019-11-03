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
                'type' => 'admin',
                'institution_id' => '1',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Andre Vinicius Teixeira Lima',
                'email' => 'andre@eyeduc.com.br',
                'type' => 'main requester',
                'institution_id' => '2',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Alan Pedro da Silva',
                'email' => 'alan@eyeduc.com.br',
                'type' => 'main requester',
                'institution_id' => '2',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Laiza Ribeiro Silva',
                'email' => 'laizaribeiro@usp.br',
                'type' => 'requester',
                'institution_id' => '3',
            ]
        );
    }
}
