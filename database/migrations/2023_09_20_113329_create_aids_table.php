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
        Schema::create('aids', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('req_id');
            $table->string('name');
            $table->date('recived_date');
            $table->date('distributed_date');
            $table->text('description')->nullable();
            $table->integer('quantity');
            $table->string('unit');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aids');
    }
};
