<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesMenTable extends Migration
{
    public function up()
    {
        Schema::create('sales_men', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->decimal('salary', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_men');
    }
}
