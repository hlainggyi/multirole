<?php
namespace learn88\multirole\database\seeds;

use Illuminate\Database\Seeder;

class multiroleDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
