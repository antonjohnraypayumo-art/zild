<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 30)->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // null = guest checkout
            // Checkout form fields
            $table->string('customer_name');
            $table->text('address');
            $table->string('phone', 30);
            $table->enum('payment_method', ['cod', 'paymaya', 'gcash', 'credits']);
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');
            $table->enum('status', ['pending', 'preparing', 'out_for_delivery', 'completed', 'cancelled'])
                ->default('pending');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });

        // Line items keep a snapshot of name/size/price so old orders never change when the menu does.
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_size_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->string('size_name', 60)->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->unsignedSmallInteger('quantity');
            $table->decimal('line_total', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
