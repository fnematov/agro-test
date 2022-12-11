<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class);
            $table->foreignIdFor(\App\Models\Location::class);
            $table->foreignIdFor(\App\Models\Position::class);
            $table->string('title');
            $table->text('job_description');
            $table->smallInteger('workplace_type')->comment('On site/Hybrid/Remote');
            $table->smallInteger('employment_type')->comment('Full time/Part time/Contract/Temporary/Volunteer/Internship');
            $table->integer('salary_from')->nullable();
            $table->integer('salary_to')->nullable();
            $table->string('skills')->nullable();
            $table->string('languages')->nullable();
            $table->smallInteger('status')->default(\App\Enums\VacancyStatusEnum::NEW->value);
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
};
