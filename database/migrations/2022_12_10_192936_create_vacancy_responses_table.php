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
        Schema::create('vacancy_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Vacancy::class);
            $table->foreignIdFor(\App\Models\Resume::class);
            $table->timestamps();

            $table->foreign('vacancy_id')->references('id')->on('vacancies')->cascadeOnDelete();
            $table->foreign('resume_id')->references('id')->on('resumes')->cascadeOnDelete();
            $table->unique(['vacancy_id', 'resume_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancy_responses');
    }
};
