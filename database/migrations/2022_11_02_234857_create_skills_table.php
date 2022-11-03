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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('skills')->insert(['name' => 'PHP']);
        DB::table('skills')->insert(['name' => 'Javascript']);
        DB::table('skills')->insert(['name' => 'Python']);
        DB::table('skills')->insert(['name' => 'C#']);
        DB::table('skills')->insert(['name' => 'Java']);
        DB::table('skills')->insert(['name' => 'Laravel']);
        DB::table('skills')->insert(['name' => 'React']);
        DB::table('skills')->insert(['name' => 'CSS']);
        DB::table('skills')->insert(['name' => 'HTML']);
        DB::table('skills')->insert(['name' => '.NET']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills');
    }
};
