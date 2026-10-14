<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The "Select a Size" pop-up on the menu pages (Tall/Grande/Venti, Regular/Footlong, ...).
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name', 60);            // label shown to the customer, e.g. "Grande"
            $table->string('code', 40);            // value sent by the form, e.g. "medium"
            $table->decimal('price_modifier', 10, 2)->default(0); // added to products.price
            $table->boolean('is_default')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['product_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
