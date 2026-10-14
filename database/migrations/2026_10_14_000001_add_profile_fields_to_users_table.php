<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->after('email');
            $table->enum('role', ['customer', 'admin'])->default('customer')->after('password');
            // Balance used by the "Credits" payment method on the checkout page.
            $table->decimal('credits', 10, 2)->default(0)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'role', 'credits']);
        });
    }
};
