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
        Schema::table('users', function (Blueprint $table){
            $table->foreign('post_id')->references('id')->on('posts');
        });

        Schema::table('posts', function (Blueprint $table){
            $table->foreign('disaster_id')->references('id')->on('disasters');
        });

        Schema::table('reqs', function (Blueprint $table){
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('aids', function (Blueprint $table){
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('req_id')->references('id')->on('reqs');
        });

        Schema::table('categories', function (Blueprint $table){
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
