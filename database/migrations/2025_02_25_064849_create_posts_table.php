<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->unique();
            $table->string('slug')->unique();
            $table->text('keywords');
            $table->text('tags');
            $table->text('short_summary');
            $table->text('description');
            $table->string('video_link')->nullable();
            $table->string('image');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
