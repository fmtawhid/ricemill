<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_part')->nullable();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade'); // Foreign key to units
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Foreign key to categories
            $table->decimal('purchase_price', 8, 2);
            $table->decimal('sales_price', 8, 2);
            $table->foreignId('godown_id')->constrained('godowns')->onDelete('cascade'); // Foreign key to godowns
            $table->integer('previous_stock')->default(0);
            $table->integer('total_previous_stock')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
