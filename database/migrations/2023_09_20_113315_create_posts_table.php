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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by');
            $table->unsignedBigInteger('disaster_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('lat')->size('100');
            $table->string('long')->size('100');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
