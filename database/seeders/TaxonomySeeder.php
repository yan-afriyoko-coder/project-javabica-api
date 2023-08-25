<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'parent' => null,
                'taxonomy_ref_key' => 1,
                'taxonomy_name' => 'News',
                'taxonomy_description' => null,
                'taxonomy_slug' => 'news',
                'taxonomy_type' => 2,
                'taxonomy_image' => null,
                'taxonomy_sort' => null,
                'taxonomy_status' => 'ACTIVE',
            ],
            [
                'parent' => null,
                'taxonomy_ref_key' => 2,
                'taxonomy_name' => 'Partnership',
                'taxonomy_description' => null,
                'taxonomy_slug' => 'partnership',
                'taxonomy_type' => 2,
                'taxonomy_image' => null,
                'taxonomy_sort' => null,
                'taxonomy_status' => 'ACTIVE',
            ],
            [
                'parent' => null,
                'taxonomy_ref_key' => 3,
                'taxonomy_name' => 'Product and Offer',
                'taxonomy_description' => null,
                'taxonomy_slug' => 'product-and-offer',
                'taxonomy_type' => 2,
                'taxonomy_image' => null,
                'taxonomy_sort' => null,
                'taxonomy_status' => 'ACTIVE',
            ],
            [
                'parent' => null,
                'taxonomy_ref_key' => 4,
                'taxonomy_name' => 'Human Resources',
                'taxonomy_description' => null,
                'taxonomy_slug' => 'human-resources',
                'taxonomy_type' => 2,
                'taxonomy_image' => null,
                'taxonomy_sort' => null,
                'taxonomy_status' => 'ACTIVE',
            ],
            [
                'parent' => null,
                'taxonomy_ref_key' => 5,
                'taxonomy_name' => 'Lifestyle',
                'taxonomy_description' => null,
                'taxonomy_slug' => 'lifestyle',
                'taxonomy_type' => 2,
                'taxonomy_image' => null,
                'taxonomy_sort' => null,
                'taxonomy_status' => 'ACTIVE',
            ],
            [
                'parent' => null,
                'taxonomy_ref_key' => 6,
                'taxonomy_name' => 'Updates',
                'taxonomy_description' => null,
                'taxonomy_slug' => 'updates',
                'taxonomy_type' => 2,
                'taxonomy_image' => null,
                'taxonomy_sort' => null,
                'taxonomy_status' => 'ACTIVE',
            ],
            [
                'parent' => null,
                'taxonomy_ref_key' => 7,
                'taxonomy_name' => 'Marketing',
                'taxonomy_description' => null,
                'taxonomy_slug' => 'marketing',
                'taxonomy_type' => 2,
                'taxonomy_image' => null,
                'taxonomy_sort' => null,
                'taxonomy_status' => 'ACTIVE',
            ],
            [
                'parent' => null,
                'taxonomy_ref_key' => 8,
                'taxonomy_name' => 'Limited Promotion and instore',
                'taxonomy_description' => null,
                'taxonomy_slug' => 'limited-promotion-and-instore',
                'taxonomy_type' => 2,
                'taxonomy_image' => null,
                'taxonomy_sort' => null,
                'taxonomy_status' => 'ACTIVE',
            ],
        ];

        foreach ($data as $item) {
            DB::table('taxo_lists')->insert($item);
        }
    }
}
