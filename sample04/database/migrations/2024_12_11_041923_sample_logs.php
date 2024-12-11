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
        Schema::create('sample_logs', function (Blueprint $table) {
            $table->id();
            $table->text('name')->collation('utf8mb4_unicode_ci');
            $table->text('parameta_name')->collation('utf8mb4_unicode_ci');
            $table->text('width')->collation('utf8mb4_unicode_ci');
            $table->text('height')->collation('utf8mb4_unicode_ci');
            $table->text('judgment')->collation('utf8mb4_unicode_ci');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->integer('day')->nullable();
            $table->integer('time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_logs');
    }
};
