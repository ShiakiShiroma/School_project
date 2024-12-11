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
        Schema::create('parametasample', function (Blueprint $table) {
            $table->id();
            $table->text('name')->collation('utf8mb4_unicode_ci');
            $table->text('thresh')->collation('utf8mb4_unicode_ci');
            $table->text('max')->collation('utf8mb4_unicode_ci');
            $table->text('bs')->collation('utf8mb4_unicode_ci');
            $table->text('iteration')->collation('utf8mb4_unicode_ci');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->integer('day')->nullable();
            $table->integer('time')->nullable();
            $table->integer('active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametasample');
    }
};
