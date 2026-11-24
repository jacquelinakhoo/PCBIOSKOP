<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->increments('DetailID'); // Primary Key
            
            $table->unsignedInteger('OrderID'); // FK
            $table->unsignedInteger('SeatsID'); // FK
            
            $table->integer('TicketPrice');
            
            $table->foreign('OrderID')->references('OrderID')->on('orders')->onDelete('cascade');
            $table->foreign('SeatsID')->references('SeatsID')->on('seats')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};