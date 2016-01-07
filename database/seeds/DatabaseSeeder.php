<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

      //  $this->call('UserTableSeeder');

        DB::table('users')->insert([
            'name'     => 'Jessyka',
            'email'    => 'jessyka@mundopremiado.com.br',
            'password' => bcrypt('tartaruga'),
        ]);

        DB::table('users')->insert([
            'name'     => 'Fabiano',
            'email'    => 'atendimento@mundopremiado.com.br',
            'password' => bcrypt('tartaruga'),
        ]);

        Model::reguard();
    }


    // class UserTableSeeder extends Seeder
    // {

    //   public function run()
    //   {

    //     App\User::truncate();

    //     factory(App\User::class, 1)->create();

    //   }
    // }



}
