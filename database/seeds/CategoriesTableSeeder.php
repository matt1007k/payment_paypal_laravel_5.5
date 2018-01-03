<?php

use App\Category;
use Illuminate\Database\Seeder;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  array(
        	[
        		'name' => 'Celular',
        		'slug' => 'celular',
        		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non, ad!',
        		'color' => '#440022'
        	],
        	[
        		'name' => 'Utilidad',
        		'slug' => 'utilidad',
        		'description' => 'Unde laborum, architecto fugiat amet odit quisquam maiores iusto quo sed nemo!',
        		'color' => '#445500'
        	],
        	[
        		'name' => 'Zapato',
        		'slug' => 'zapato',
        		'description' => 'Unde adipisicing elit. fugiat amet odit quisquam maiores iusto quo sed nemo!',
        		'color' => '#4dd500'
        	],
        	[
        		'name' => 'Comida',
        		'slug' => 'Comida',
        		'description' => 'Adipisicing elitu unde laborum, architecto fugiat amet odit quisquam maiores iusto quo sed nemo!',
        		'color' => '#352500'
        	]
         );

        Category::insert($data);
    }
}
