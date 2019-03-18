<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('title');
            $table->text('content');
            $table->string('brand');
            $table->string('name');
            $table->integer('type');
            $table->decimal('price', 6, 2);
            $table->timestamp('accepted_at');
            $table->timestamp('refused_at');
            $table->timestamp('marked_sold_at');
            $table->timestamp('flagged_at');
            $table->integer('reason_to_remove');
            $table->integer('main_photo_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
}
