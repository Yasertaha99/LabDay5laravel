<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("creator_name");
            $table->string("title");
            $table->string('image')->nullable();
            $table->string("create_date");
            $table->string("content");
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
