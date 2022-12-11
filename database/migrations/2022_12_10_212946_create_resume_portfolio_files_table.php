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
        Schema::create('resume_portfolio_files', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ResumePortfolio::class);
            $table->string('path');
            $table->timestamps();

            $table->foreign('resume_portfolio_id')->references('id')->on('resume_portfolios')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_portfolio_files');
    }
};
