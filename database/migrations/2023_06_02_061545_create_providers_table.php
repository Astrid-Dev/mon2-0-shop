<?php

use App\Enums\ProviderStatus;
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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->enum('status', ProviderStatus::getValues())
                ->comment(implode(', ', ProviderStatus::getValues()))
                ->default(ProviderStatus::PENDING);
            $table->string('code')->unique();
            $table->string('name');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('whatsapp');
            $table->string('city');
            $table->string('address');
            $table->string('description');
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
