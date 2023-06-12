<?php

use App\Enums\DimensionType;
use App\Enums\DimensionUnit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_dimensions', function (Blueprint $table) {
            $table->id();$table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->enum('type', DimensionType::getValues())
                ->comment(implode(', ', DimensionType::getValues()));
            $table->string('value');
            $table->enum('unit', DimensionUnit::getValues())
                ->comment(implode(', ', DimensionUnit::getValues()));
            $table->unsignedInteger('stock')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_dimensions');
    }
};
