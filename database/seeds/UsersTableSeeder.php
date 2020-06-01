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
        DB::table('TBL_Usuarios')->insert([
            [
                'name' => 'Code El Admin',
                'email' => 'admin@app.com',
                'role' => 'admin',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Paisa El Evaluador',
                'email' => 'evaluador@app.com',
                'role' => 'evaluator',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Fredo El Estudiante',
                'email' => 'student@app.com',
                'role' => 'student',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Nat la admin',
                'email' => 'nat@app.com',
                'role' => 'admin',
                'password' => bcrypt('12345')
            ]
        ]);
    }
}
