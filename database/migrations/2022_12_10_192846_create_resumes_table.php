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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Employee::class);
            $table->foreignIdFor(\App\Models\Location::class);
            $table->string('full_name');
            $table->text('intro_text')->nullable();
            $table->date('birth_date')->nullable();
            $table->boolean('is_male')->default(true);
            $table->string('avatar')->nullable();
            $table->integer('phone_number')->nullable();
            $table->integer('expected_salary')->nullable();
            $table->string('email')->nullable();
            $table->string('desired_position')->nullable()->comment('Желаемая должность');
            $table->string('employment_types')->nullable();
            $table->string('workplace_types')->nullable();
            $table->string('languages')->nullable();
            $table->string('skills')->nullable();
            $table->smallInteger('status')->default(\App\Enums\ResumeStatusEnum::ACTIVE->value);
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('resumes');
    }
};
