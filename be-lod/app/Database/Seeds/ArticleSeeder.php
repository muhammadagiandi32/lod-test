<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
use Ausi\SlugGenerator\SlugGenerator;

class ArticleSeeder extends Seeder
{

    public function run()
    {
        // require_once 'vendor/autoload.php';
        $article = new \App\Models\ArticleModels();
        $generator = new SlugGenerator;
        // $faker = vebdoFaker\Factory::create();
        $faker = Factory::create();
        for ($i = 1; $i < 10; $i++) {
            $title =  $faker->unique()->name;
            $data = [
                'title' => $title,
                'slug' => $generator->generate($title),
                'author' => $faker->name(),
                'content' => $faker->paragraph(),
            ];
            $article->insert($data);
        }

        $users = new \App\Models\UsersModels();
        $dataUser = [
            'email' => 'admin@gmail.com',
            'password' => password_hash('13245678', PASSWORD_ARGON2I),
            'name' => 'Muhammad Agiandi'
        ];
        $users->insert($dataUser);
        //
    }
}
