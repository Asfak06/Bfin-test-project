<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Tag;
use App\Models\Section;
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
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '01521259536',
            'gender' => 'male',
            'birthday' =>'1996/12/14',
            'image' => 'uploads/avatars/1.jpeg',
            'admin' =>1,
            'password' =>  bcrypt('password')
        ]);
        
        Tag::create([
            'name' => 'Travel',
        ]);
        Tag::create([
            'name' => 'Sci-fi',
        ]);
        Tag::create([
            'name' => 'Horror',
        ]);
        Section::create([
            'name' => 'Non-fiction',
        ]);
        Section::create([
            'name' => 'Fiction',
        ]);
    }
}
