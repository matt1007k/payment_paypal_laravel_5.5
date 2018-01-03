<?php

use App\Product;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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
        		'name' => 'Apple Iphone 8',
        		'slug' => 'apple-iphone-8',
        		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque maiores, fugit, nemo sequi earum hic.',
        		'extract' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...',
        		'price' => 900.00,
        		'image' => 'https://static.pexels.com/photos/4158/apple-iphone-smartphone-desk.jpg',
        		'visible' => 1,
        		'category_id' => 1

        	],
        	[
        		'name' => 'Rejos Magnus',
        		'slug' => 'rejos-magnus',
        		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque maiores, fugit, nemo sequi earum hic.',
        		'extract' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...',
        		'price' => 225.00,
        		'image' => 'https://static.pexels.com/photos/84475/night-product-watch-dramatic-84475.jpeg',
        		'visible' => 1,
        		'category_id' => 2
        	],
        	[
        		'name' => 'Camara Fotografica',
        		'slug' => 'camara-fotografica',
        		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque maiores, fugit, nemo sequi earum hic.',
        		'extract' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...',
        		'price' => 500.00,
        		'image' => 'https://static.pexels.com/photos/90946/pexels-photo-90946.jpeg',
        		'visible' => 1,
        		'category_id' => 2

        	],
        	[
        		'name' => 'Lentes de Sol',
        		'slug' => 'lentes-de-sol',
        		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque maiores, fugit, nemo sequi earum hic.',
        		'extract' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...',
        		'price' => 50.00,
        		'image' => 'https://static.pexels.com/photos/371723/pexels-photo-371723.jpeg',
        		'visible' => 1,
        		'category_id' => 2
        	],
        	[
        		'name' => 'Zapatos',
        		'slug' => 'apple-iphone-8',
        		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque maiores, fugit, nemo sequi earum hic.',
        		'extract' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...',
        		'price' => 350.00,
        		'image' => 'https://static.pexels.com/photos/298863/pexels-photo-298863.jpeg',
        		'visible' => 1,
        		'category_id' => 3

        	],
        	[
        		'name' => 'Fetuchinis',
        		'slug' => 'fetuchinis',
        		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque maiores, fugit, nemo sequi earum hic.',
        		'extract' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit...',
        		'price' => 10.00,
        		'image' => 'https://static.pexels.com/photos/263116/pexels-photo-263116.jpeg',
        		'visible' => 1,
        		'category_id' => 4
        	]
         );

        Product::insert($data);
    }
}
