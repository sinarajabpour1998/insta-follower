<?php

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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->comment("table:users, column: id");
            $table->integer("order_id")->comment("table:orders, column: id");
            $table->integer("transaction_id")->comment("table:transactions, column: id");
            $table->string("username")->comment("instagram page that being followed");
            $table->enum("status", ["followed", "not_counted", "error"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
