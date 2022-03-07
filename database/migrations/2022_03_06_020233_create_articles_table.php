<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('OrderId');
            $table->foreign('OrderId')->references('id')->on('orders');

            $table->string('ArticleCode');
            $table->string('ArticleName');
            $table->decimal('UnitPrice', 10, 2);
            $table->integer('Quantity');
            $table->decimal('Discount', 10, 2)->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
};
