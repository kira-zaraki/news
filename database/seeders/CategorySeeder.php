<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actualites = Category::create(['title' => 'Actualités']);
        $divertissement = Category::create(['title' => 'Divertissement']);
        $technologie = Category::create(['title' => 'Technologie']);
        $sante = Category::create(['title' => 'Santé']);

        $actualites->subCategorys()->createMany([
            ['title' => 'Politique'],
            ['title' => 'Économie'],
            ['title' => 'Sport'],
        ]);

        $divertissement->subCategorys()->createMany([
            ['title' => 'Cinéma'],
            ['title' => 'Musique'],
            ['title' => 'Sorties'],
        ]);

        $technologie->subCategorys()->createMany([
            ['title' => 'Informatique'],
            ['title' => 'Gadgets'],
        ]);

        $informatique = $technologie->subCategorys->where('title', 'Informatique')->first();
        $informatique->subCategorys()->createMany([
            ['title' => 'Ordinateurs de bureau'],
            ['title' => 'PC portable'],
            ['title' => 'Connexion internet'],
        ]);

        $gadgets = $technologie->subCategorys->where('title', 'Gadgets')->first();
        $gadgets->subCategorys()->createMany([
            ['title' => 'Smartphones'],
            ['title' => 'Tablettes'],
            ['title' => 'Jeux vidéo'],
        ]);

        $sante->subCategorys()->createMany([
            ['title' => 'Médecine'],
            ['title' => 'Bien-être'],
        ]);
    }
}
