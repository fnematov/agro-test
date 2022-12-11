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
        Schema::create('resume_worked_places', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Resume::class);
            $table->foreignIdFor(\App\Models\Location::class);
            $table->string('organization_name');
            $table->string('job_title');
            $table->date('beginning_of_work');
            $table->date('ending_of_work')->nullable();
            $table->timestamps();

            $table->foreign('resume_id')->references('id')->on('resumes')->cascadeOnDelete();
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_worked_places');
    }
};
