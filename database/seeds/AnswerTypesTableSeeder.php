<?php

use Illuminate\Database\Seeder;

class AnswerTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'id' => 1,
            'name' => 'Один вариант ответа'
        ]);
        DB::table('types')->insert([
            'id' => 2,
            'name' => 'Много вариантов ответа'
        ]);
        DB::table('types')->insert([
            'id' => 3,
            'name' => 'Текстовый ответ'
        ]);
    }
}
