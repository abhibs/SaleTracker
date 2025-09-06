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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('shop_name')->nullable();
            $table->enum('shop_type', ['Wholesale', 'Retail', 'Distributor', 'Hawker'])->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('sale_amount')->nullable();
            $table->string('sale_representative_name')->nullable();
            $table->text('visit_notes')->nullable();
            $table->string('location')->nullable();
            $table->text('shop_address')->nullable();
            $table->string('image')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('sales');
    }
};
