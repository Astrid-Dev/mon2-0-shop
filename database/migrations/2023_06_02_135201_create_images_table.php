<?php

use App\Enums\ImageType;
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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('element_type');
            $table->unsignedBigInteger('element_id');
            $table->enum('image_type', ImageType::getValues())
                ->comment(implode(', ', ImageType::getValues()));
            $table->string('path');
            $table->string('name')->nullable();
            $table->json('extras')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
