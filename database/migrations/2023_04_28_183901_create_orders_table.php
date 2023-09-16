<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_email')->nullable();


            $table->string('product_id')->nullable();
            $table->string('product_title')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('product_sale_price')->nullable();
            $table->string('product_discount')->nullable();
            $table->string('Total_price')->nullable();
            $table->string('order_id')->nullable();
            $table->string('admin_status')->nullable();
            $table->string('price_muliply_qty')->nullable();
            $table->enum('payment_status', ['Cash on delivery', 'Paid'])->nullable();
            $table->string('delivery_status')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
