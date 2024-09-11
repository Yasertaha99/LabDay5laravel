<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post; 
use App\Models\User; 

class PostFactory extends Factory
{
  
    protected $model = Post::class;


    public function definition(): array
    {
        return [
            'creator_id' => User::inRandomOrder()->first()->id, // Use an existing user ID
            'creator_name' => $this->faker->name,
            'title' => $this->faker->text(15),
            'content' => $this->faker->paragraph(3),
            'create_date' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            'image' => 'posts_images/Rbzhn1kBiOFn1QwdurSepMNsN5NRqp36IookDIyK.png',
        ];
    }
}
