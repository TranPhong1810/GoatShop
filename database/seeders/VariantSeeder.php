<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Đỏ','code' => '#FF0000'],
            ['name' => 'Đen','code' => '#000000'],
            ['name' => 'Trắng','code' => '#FFFFFF'],

        ];
        foreach ($colors as $color) {
            Color::updateOrCreate($color);
        }
        $sizes = [
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'Xl'],

        ];
        foreach ($sizes as $size) {
            Size::updateOrCreate($size);
        }
    }
}
