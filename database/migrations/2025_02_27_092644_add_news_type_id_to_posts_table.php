<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewsTypeIdToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // 'news_type_id' ফরেন কী যোগ করা হচ্ছে, নাল হিসেবে থাকতে পারবে
            $table->foreignId('news_type_id')->nullable()->constrained('news_types')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // যদি মাইগ্রেশন রোলব্যাক করা হয়, তবে কলামটি ড্রপ করা হবে
            $table->dropForeign(['news_type_id']);
            $table->dropColumn('news_type_id');
        });
    }
}

