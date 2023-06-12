<?php declare(strict_types=1);


use App\Enums\DimensionType;
use App\Enums\DimensionUnit;
use App\Enums\StockType;

return [

    StockType::class => [
        StockType::QUANTIFIED => 'Quantified',
        StockType::UNLIMITED => 'Unlimited',
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
    ]

];
