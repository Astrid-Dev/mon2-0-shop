<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parentCategories = [
            [
                'label' => json_encode([
                    'fr' => 'Vêtements',
                    'en' => 'Clothes'
                ]),
                'illustration' => null,
                'icon' => ''
            ],
            [
                'label' => json_encode([
                    'fr' => 'Accessoires',
                    'en' => 'Accessories'
                ]),
                'illustration' => null
            ],
            [
                'label' => json_encode([
                    'fr' => 'Souvenirs',
                    'en' => 'Memories'
                ]),
                'illustration' => null
            ],
            [
                'label' => json_encode([
                    'fr' => 'Objets de collection',
                    'en' => 'Collectibles'
                ]),
                'illustration' => null
            ],
            [
                'label' => json_encode([
                    'fr' => 'Collections Populaires',
                    'en' => 'Popular Collections'
                ]),
                'illustration' => null
            ],
            [
                'label' => json_encode([
                    'fr' => 'Nouveautés',
                    'en' => 'News'
                ]),
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Articles de luxe',
                    'en' => 'Luxury items'
                ]),
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Édition Limitée',
                    'en' => 'Limited Edition'
                ]),
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Jouets et Jeux',
                    'en' => 'Toys and Games'
                ]),
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Retro',
                    'en' => 'Retro'
                ]),
                'illustration' => null,
            ]
        ];

        $subCategories = [
            [
                'label' => json_encode([
                    'fr' => 'Pantalons et Shorts',
                    'en' => 'Pants and Shorts'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Sous-vêtements et Nuit',
                    'en' => 'Underwear and Sleepwear'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Survêtements',
                    'en' => 'Tracksuits'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Casquettes et Chapeaux',
                    'en' => 'Caps and Hats'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Chaussures et Chaussettes',
                    'en' => 'Shoes and Socks'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Echarpes',
                    'en' => 'Scarves'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Sweats',
                    'en' => 'Sweatshirts'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Tenues de football',
                    'en' => 'Football kits'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Tenues d’entrainement',
                    'en' => 'Training outfits'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Vestes et Manteaux',
                    'en' => 'Jackets and Coats'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Tee shirts et Polos',
                    'en' => 'T-shirts and Polos'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Sweats à capuche',
                    'en' => 'Hoodies'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Couvre-chef',
                    'en' => 'Headgear'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Maillots de bain',
                    'en' => 'Swimwear'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Masque de protection',
                    'en' => 'Protective mask'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Autres',
                    'en' => 'Others'
                ]),
                'parent_id' => 1,
                'illustration' => null,
            ],

            [
                'label' => json_encode([
                    'fr' => 'Accessoires de mode',
                    'en' => 'Fashion accessories'
                ]),
                'parent_id' => 2,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Accessoires de voiture',
                    'en' => 'Car accessories'
                ]),
                'parent_id' => 2,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Accessoires de stade',
                    'en' => 'Stadium accessories'
                ]),
                'parent_id' => 2,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Accessoires de clubs',
                    'en' => 'Club accessories'
                ]),
                'parent_id' => 2,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Accessoires de foot',
                    'en' => 'Football accessories'
                ]),
                'parent_id' => 2,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Autres',
                    'en' => 'Others'
                ]),
                'parent_id' => 2,
                'illustration' => null,
            ],

            [
                'label' => json_encode([
                    'fr' => 'Trophées, épingles et porte-clés',
                    'en' => 'Trophies, pins and key rings'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Monnaies & Médailles',
                    'en' => 'Coins & Medals'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Affiches',
                    'en' => 'Posters'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Aimants',
                    'en' => 'Magnets'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Chemises signées et encadrées de héros',
                    'en' => 'Signed and framed shirts of heroes'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Chemises signées et encadrées',
                    'en' => 'Signed and framed shirts'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Photos signées et encadrées',
                    'en' => 'Signed and framed photos'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Chemises signées',
                    'en' => 'Signed shirts'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Bottes signées',
                    'en' => 'Signed boots'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Ballons signés',
                    'en' => 'Signed balls'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Maillots signés',
                    'en' => 'Signed jerseys'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Autres',
                    'en' => 'Others'
                ]),
                'parent_id' => 3,
                'illustration' => null,
            ],

            [
                'label' => json_encode([
                    'fr' => 'Programmes',
                    'en' => 'Programs'
                ]),
                'parent_id' => 4,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Les magazines',
                    'en' => 'Magazines'
                ]),
                'parent_id' => 4,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Cartes à collectionner',
                    'en' => 'Collectible cards'
                ]),
                'parent_id' => 4,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Autocollants',
                    'en' => 'Stickers'
                ]),
                'parent_id' => 4,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Figurines',
                    'en' => 'Figurines'
                ]),
                'parent_id' => 4,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Autographes',
                    'en' => 'Autographs'
                ]),
                'parent_id' => 4,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Tickets',
                    'en' => 'Tickets'
                ]),
                'parent_id' => 4,
                'illustration' => null,
            ],
            [
                'label' => json_encode([
                    'fr' => 'Autres',
                    'en' => 'Others'
                ]),
                'parent_id' => 4,
                'illustration' => null,
            ],
        ];

        Category::query()->insert($parentCategories);
        Category::query()->insert($subCategories);
    }
}
