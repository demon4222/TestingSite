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
            'name' => 'Один вариант ответа'
        ]);
        DB::table('types')->insert([
            'name' => 'Много вариантов ответа'
        ]);
        DB::table('types')->insert([
            'name' => 'Текстовый ответ'
        ]);
    }
}
