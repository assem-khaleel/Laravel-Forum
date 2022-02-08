<?php

use Illuminate\Database\Seeder;
use LaravelForum\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel = Channel::create([
            'name'=> 'Laravel 5.8',
            'slug'=> str_slug('laravel 5.8')
        ]);

        $channel = Channel::create([
            'name'=> 'Vue js 3',
            'slug'=> str_slug('Vue js 3')
        ]);

        $channel = Channel::create([
            'name'=> 'Angular 7',
            'slug'=> str_slug('Angular 7')
        ]);
        
        $channel = Channel::create([
            'name'=> 'Node js',
            'slug'=> str_slug('Node js')
        ]);
    }
}
