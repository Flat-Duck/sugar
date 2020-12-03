<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password')->default('$2y$10$kDiEJkINg5LwUgygAGHZAulwCQR4kBXULQgp0a5tL8iVwTtBW2Dgy');
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->integer('diabetes_type');
            $table->integer('injury_year');
            $table->string('phone');
            $table->string('email');
            $table->decimal('weight');
            $table->decimal('height');
            $table->enum('state', ['active', 'unactive']);
         //   $table->enum('chronic_diseases',['hypertension','heart Disease','bone Diseases','Autoimmune Disease','None of the above']);           
            $table->string('Allergy_medicine');
            $table->string('surgery');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('users');
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
        Schema::dropIfExists('patients');
    }
}
