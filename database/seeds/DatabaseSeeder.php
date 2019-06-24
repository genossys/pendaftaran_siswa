<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker\Factory::create();
        $limit = 20;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('tb_pendaftar')->insert([ //mengisi datadi database
                'email' => $faker->unique()->email, //email unique sehingga tidak ada yang sama
                'username' => $faker->name,
                'password' => $faker->password,
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'tglLahir' => $faker->date,
                'jenisKelamin' => "L",
                'namaOrtu' => $faker->name,
                'noHp' => $faker->phoneNumber,
                'status' => "menunggu",
                'urlFoto' => $faker->url,
            ]);
        }
    }
}
