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
        Schema::create('resume_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Resume::class);
            $table->foreignIdFor(\App\Models\Position::class);
            $table->timestamps();

            $table->foreign('resume_id')->references('id')->on('resumes')->cascadeOnDelete();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->unique(['resume_id', 'position_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_positions');
    }
};
