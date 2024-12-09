<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'content'=>fake()->text(),
            'score'=>fake()->randomDigitNotZero(),
            'user_id'=> $user->id,
            'comment_id'=>null,
            'publication_id'=>Publication::factory()->create([
                'user_id'=>$user->id
            ]),
        ];
    }
}
