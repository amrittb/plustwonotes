<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->engine = "MyISAM";

			$table->increments('id');
			$table->string('post_title',200);
			$table->longText('post_body');
			$table->string('post_slug',50);
			$table->integer('subject_id')->nullable();
			$table->integer('category_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
            $table->timestamp('published_at')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned();

            $table->foreign('subject_id')
                ->references('id')->on('subjects');

            $table->foreign('category_id')
                ->references('id')->on('categories');

            $table->foreign('user_id')
                ->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('posts');
	}

}
