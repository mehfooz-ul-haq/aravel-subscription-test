<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('phone', 45);
            $table->string('email', 45)->unique();
            $table->enum('subscription_type', ['free', 'premium'])->default('free');    
            $table->timestamps();
        });

        Schema::create('user_address', function (Blueprint $table) {
            $table->id();
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('state_province', 25)->nullable();
            $table->string('country', 5);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });

        Schema::create('user_payments', function (Blueprint $table) {
            $table->id();
            $table->string('card_number', 25);
            $table->string('expiry_month', 2);
            $table->string('expiry_year', 4);
            $table->string('cvv', 5);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_address');
        Schema::dropIfExists('user_payments');
        Schema::dropIfExists('sessions');
    }
};
