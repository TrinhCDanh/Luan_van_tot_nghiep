<?php

use Illuminate\Database\Seeder;
use App\Models\Giangvien;
use App\Models\Kythuatvien;

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
        Giangvien::create([
            'name' => 'Giangvien',
            'email' => 'giangvien@giangvien.com',
            'password' => Hash::make('giangvien123'),
        ]);

        Kythuatvien::create([
            'name' => 'Kythuatvien',
            'email' => 'kythuatvien@kythuatvien.com',
            'password' => Hash::make('kythuatvien123'),
        ]);
    }
}
