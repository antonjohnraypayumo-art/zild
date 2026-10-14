<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->unsignedTinyInteger('rating');   // 1-5 stars
            $table->text('comment');
            $table->string('image')->nullable();
            $table->boolean('is_approved')->default(false); // new reviews wait for admin approval
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
