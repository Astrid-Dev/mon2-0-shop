<?php declare(strict_types=1);


use App\Enums\Color;
use App\Enums\DimensionType;
use App\Enums\DimensionUnit;
use App\Enums\ImageType;
use App\Enums\JerseyType;
use App\Enums\ProviderStatus;
use App\Enums\SiblingType;
use App\Enums\StockType;

return [

    StockType::class => [
        StockType::IN_STOCK => 'En Stock',
        StockType::OUT_OF_STOCK => 'Rupture de stock',
        StockType::PRE_ORDER => 'Pré-commande',
    ],

    DimensionType::class => [
        DimensionType::AREA => 'Aire',
        DimensionType::CIRCUMFERENCE => 'Circonférence',
        DimensionType::DEPTH => 'Profondeur',
        DimensionType::DIAGONAL => 'Diagonale',
        DimensionType::DIAMETER => 'Diamètre',
        DimensionType::HEIGHT => 'Hauteur',
        DimensionType::LENGTH => 'Longueur',
        DimensionType::PERIMETER => 'Périmètre',
        DimensionType::RADIUS => 'Rayon',
        DimensionType::THICKNESS => 'Épaisseur',
        DimensionType::VOLUME => 'Volume',
        DimensionType::WEIGHT => 'Poids',
        DimensionType::WIDTH => 'Largeur',
    ],

    DimensionUnit::class => [
        DimensionUnit::ARE => 'Are',
        DimensionUnit::CENTIMETER => 'Centimètre',
        DimensionUnit::CUBE_CENTIMETER => 'Centimètre Cube',
        DimensionUnit::CUBE_METER => 'Mètre Cube',
        DimensionUnit::HECTARE => 'Hectare',
        DimensionUnit::KILOMETER => 'Kilomètre',
        DimensionUnit::LITER => 'Litre',
        DimensionUnit::METER => 'Mètre',
        DimensionUnit::MILLILITER => 'Millimètre',
        DimensionUnit::SQUARE_CENTIMETER => 'Centimètre Carré',
        DimensionUnit::SQUARE_KILOMETER => 'Kilomètre Carré',
        DimensionUnit::SQUARE_METER => 'Mètre Carré',
        DimensionUnit::SQUARE_MILLIMETER => 'Millimètre Carré',
        DimensionUnit::MILLIMETER => 'Millimètre',
    ],

    ImageType::class => [
        ImageType::LOGO => 'Logo',
        ImageType::PROFILE => 'Profil',
        ImageType::ILLUSTRATION => 'Illustration',
    ],

    SiblingType::class => [
        SiblingType::KID => 'Enfant',
        SiblingType::MAN => 'Homme',
        SiblingType::WOMAN => 'Femme',
    ],

    Color::class => [
        Color::BEIGE => 'Beige',
        Color::GREEN => 'Vert',
        Color::RED => 'Rouge',
        Color::YELLOW => 'Jaune',
        Color::BLACK => 'Noir',
        Color::WHITE => 'Blanc',
        Color::BLUE => 'Bleu',
        Color::BRONZE => 'Bronze',
        Color::DARKBLUE => 'Bleu Foncé',
        Color::BROWN => 'Brun',
        Color::DARKBROWN => 'Brun Foncé',
        Color::DARKGRAY => 'Gris Foncé',
        Color::DARKGREEN => 'Vert Foncé',
        Color::DARKORANGE => 'Orange Foncé',
        Color::DARKPINK => 'Rose Foncé',
        Color::DARKRED => 'Rouge Foncé',
        Color::GOLD => 'Or',
        Color::GRAY => 'Gris',
        Color::LIGHTBLUE => 'Bleu Clair',
        Color::LIGHTGREEN => 'Vert clair',
        Color::NAVY => 'Marine',
        Color::ORANGE => 'Orange',
        Color::PINK => 'Rose',
        Color::PURPLE => 'Violet',
        Color::SILVER => 'Argent',
        Color::SKYBLUE => 'Bleu Ciel',
        Color::LIGHTGRAY => 'Gris Clair',
    ],

    ProviderStatus::class => [
        ProviderStatus::APPROVED => 'Approuvé',
        ProviderStatus::PENDING => 'En attente',
        ProviderStatus::UNAPPROVED => 'Désapprouvé',
    ],

    JerseyType::class => [
        JerseyType::SIMPLE => 'Maillot Simple',
        JerseyType::TEAM => 'Maillot d\'Equipe',
    ]

];
