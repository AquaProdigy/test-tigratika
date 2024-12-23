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
        Schema::create('item_children', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('count');
            $table->enum('source', ['производство', 'склад']);
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->string('laser')->nullable();
            $table->string('weld')->nullable();
            $table->string('assembly')->nullable();
            $table->string('electric')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_children');
    }
};
