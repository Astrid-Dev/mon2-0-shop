<?php declare(strict_types=1);


use App\Enums\Color;
use App\Enums\DimensionType;
use App\Enums\DimensionUnit;
use App\Enums\ImageType;
use App\Enums\SiblingType;
use App\Enums\StockType;

return [

    StockType::class => [
        StockType::IN_STOCK => 'In Stock',
        StockType::OUT_OF_STOCK => 'Out of Stock',
        StockType::PRE_ORDER => 'Pre Order',
    ],

    DimensionType::class => [
        DimensionType::AREA => 'Area',
        DimensionType::CIRCUMFERENCE => 'Circumference',
        DimensionType::DEPTH => 'Depth',
        DimensionType::DIAGONAL => 'Diagonal',
        DimensionType::DIAMETER => 'Diameter',
        DimensionType::HEIGHT => 'Height',
        DimensionType::LENGTH => 'Length',
        DimensionType::PERIMETER => 'Perimeter',
        DimensionType::RADIUS => 'Radius',
        DimensionType::THICKNESS => 'Thickness',
        DimensionType::VOLUME => 'Volume',
        DimensionType::WEIGHT => 'Weight',
        DimensionType::WIDTH => 'Width',
    ],

    DimensionUnit::class => [
        DimensionUnit::ARE => 'Are',
        DimensionUnit::CENTIMETER => 'Centimeter',
        DimensionUnit::CUBE_CENTIMETER => 'Cube Centimeter',
        DimensionUnit::CUBE_METER => 'Cube Meter',
        DimensionUnit::HECTARE => 'Hectare',
        DimensionUnit::KILOMETER => 'Kilometer',
        DimensionUnit::LITER => 'Liter',
        DimensionUnit::METER => 'Meter',
        DimensionUnit::MILLILITER => 'Milliliter',
        DimensionUnit::SQUARE_CENTIMETER => 'Square Centimeter',
        DimensionUnit::SQUARE_KILOMETER => 'Square Kilometer',
        DimensionUnit::SQUARE_METER => 'Square Meter',
        DimensionUnit::SQUARE_MILLIMETER => 'Square Millimeter',
        DimensionUnit::MILLIMETER => 'Millimeter',
    ],

    ImageType::class => [
        ImageType::LOGO => 'Logo',
        ImageType::PROFILE => 'Profile',
        ImageType::ILLUSTRATION => 'Illustration',
    ],

    SiblingType::class => [
        SiblingType::KID => 'Kid',
        SiblingType::MAN => 'Man',
        SiblingType::WOMAN => 'Woman',
    ],

    Color::class => [
        Color::BEIGE => 'Beige',
        Color::GREEN => 'Green',
        Color::RED => 'Red',
        Color::YELLOW => 'Yellow',
        Color::BLACK => 'Black',
        Color::WHITE => 'White',
        Color::BLUE => 'Blue',
        Color::BRONZE => 'Bronze',
        Color::DARKBLUE => 'Dark Blue',
        Color::BROWN => 'Brown',
        Color::DARKBROWN => 'Dark Brown',
        Color::DARKGRAY => 'Dark Gray',
        Color::DARKGREEN => 'Dark Green',
        Color::DARKORANGE => 'Dark Orange',
        Color::DARKPINK => 'Dark Pink',
        Color::DARKRED => 'Dark Red',
        Color::GOLD => 'Gold',
        Color::GRAY => 'Gray',
        Color::LIGHTBLUE => 'Light Blue',
        Color::LIGHTGREEN => 'Light Green',
        Color::NAVY => 'Navy',
        Color::ORANGE => 'Orange',
        Color::PINK => 'Pink',
        Color::PURPLE => 'Purple',
        Color::SILVER => 'Silver',
        Color::SKYBLUE => 'Sky Blue',
        Color::LIGHTGRAY => 'Light Gray',
    ]

];
