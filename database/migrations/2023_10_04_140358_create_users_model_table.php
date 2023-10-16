<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_model', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('surName', 255);
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('users_model', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
        });
        Schema::dropIfExists('users_model');
    }
};
