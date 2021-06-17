<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CancerInquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancer_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('email',150);
            $table->string('contact_number');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('pincode',7);
            $table->integer('cancer_type');
            $table->string('document');
            $table->boolean('status')->comments('0=>Pending,1=>Solved');
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
        Schema::dropIfExists('cancer_inquiries');
    }
}
