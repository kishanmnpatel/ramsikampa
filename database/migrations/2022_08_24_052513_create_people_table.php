<?php

use App\Models\Person;
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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id');
            $table->string('name');
            $table->string('surname_id');
            $table->integer('mobile',false,true)->nullable();
            $table->string('address');
            $table->enum('gender', ['female', 'male']);
            $table->enum('relation', [Person::SELF, Person::FATHER, Person::HUSBUND, Person::WIFE]);
            $table->string('is_daughter');
            $table->string('is_married');
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
        Schema::dropIfExists('people');
    }
};
