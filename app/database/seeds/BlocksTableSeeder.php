<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BlocksTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Block::create([
				'title' => $faker->lastName,
				'is_published' => $faker->numberBetween($min=0, $max=1),
				'type' => $faker->numberBetween($min=0, $max=1)
			]);
		}
	}

}
