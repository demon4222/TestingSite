<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tests = factory(App\Models\Test::class, 50)->make();
        foreach ($tests as $test)
        {
            $test->save();
        }
    }
}
