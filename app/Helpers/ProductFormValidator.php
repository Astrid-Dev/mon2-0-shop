<?php
namespace App\Helpers;

use App\Enums\DimensionType;
use App\Enums\DimensionUnit;
use App\Enums\StockType;

class ProductFormValidator
{
    public static function getBasicInformationRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'price' => ['required', 'integer', 'between:500,1000000'],
            'brandId' => ['required', 'integer', 'exists:brands,id'],
            'categoryId' => ['required', 'integer', 'exists:categories,id'],
            'tags' => ['sometimes', 'array', 'max:5'],
            'tags.*' => ['required', 'string', 'max:20'],
            'details' => ['sometimes', 'array', 'max:5'],
            'details.*' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'between:20,500'],
            'stockType' => ['required', 'string', 'in:'.implode(',', StockType::getValues())]
        ];
    }

    public static function getDimensionsRules(): array
    {
        return [
            'dimensions' => ['sometimes', 'array'],
            'dimensions.*.type' => ['required', 'in:'.implode(',', DimensionType::getValues())],
            'dimensions.*.value' => ['required', 'numeric'],
            'dimensions.*.unit' => ['required', 'in:'.implode(',', DimensionUnit::getValues())],
            'dimensions.*.stock' => ['sometimes', 'nullable', 'integer']
        ];
    }

    public static function getSizesRules(): array
    {
        return [
            'sizes' => ['sometimes', 'array'],
            'sizes.*.value' => ['required', 'string', 'max:20'],
            'sizes.*.stock' => ['sometimes', 'nullable', 'integer']
        ];
    }

    public static function getImagesRules(): array
    {
        return [
            'images' => ['sometimes', 'array'],
            'images.*' => ['required', 'image', 'max:1024'], // 1MB Max
        ];
    }

    public static function getPromotionRules(): array
    {
        return [
            'promotion' => ['array', 'sometimes'],
            'promotion.start_date' => ['required', 'date', 'after_or_equal:'.now()->format('Y-m-d H:i:s')],
            'promotion.end_date' => ['required', 'date', 'after:promotion.start_date'],
            'promotion.discount_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }

    public static function getRules(): array
    {
        return array_merge(
            self::getBasicInformationRules(),
            self::getDimensionsRules(),
            self::getSizesRules(),
            self::getImagesRules()
        );
    }

    public static function getStockToStore($stock): ?int
    {
        $intStock = intval($stock);
        return (strval($stock) === strval(0) || $intStock > 0) ? $intStock : null;
    }

}
