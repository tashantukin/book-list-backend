<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Book;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'author' => $faker->name,
        'description' =>$faker->text,
        'publisher' => $faker->text,
        'genre' => $faker->text,
        'image' => $faker->imageUrl()
       
    ];
});
