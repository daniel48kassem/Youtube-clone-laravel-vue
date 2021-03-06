<?php

use Faker\Generator as Faker;
use App\Comment;
use App\Video;
use App\User;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(6),
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'video_id' => function() {
            return factory(Video::class)->create()->id;
        },
        'comment_id' => null
    ];
});
