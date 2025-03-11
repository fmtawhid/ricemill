<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('account_number')->unique();
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->decimal('balance', 15, 2)->default(0);
            $table->text('note')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key constraint to users table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_accounts');
    }
}
