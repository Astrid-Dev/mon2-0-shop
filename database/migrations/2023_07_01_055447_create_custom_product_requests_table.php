<?php

use App\Enums\JerseyType;
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
        Schema::create('custom_product_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('quantity');
            $table->text('description');
            $table->enum('jersey_type', JerseyType::getValues())
                ->comment(implode(', ', JerseyType::getValues()));
            $table->string('jersey_sample')->nullable();
            $table->boolean('include_flocking');
            $table->json('data')->nullable();
            $table->json('flocking_items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_product_requests');
    }
};
