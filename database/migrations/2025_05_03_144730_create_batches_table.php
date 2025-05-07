<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('timezone')->nullable();
            $table->string('location')->nullable();
            $table->decimal('price', 10, 2)->nullable()->default(0.00);
            $table->decimal('discounted_price', 10, 2)->nullable()->default(0.00);

            $table->timestamps();
            $table->softDeletes();

            // Add foreign keys with custom names
            $table->foreign('course_id', 'batches_course_id_foreign')
                ->references('id')->on('courses')->onDelete('cascade');

            $table->foreign('user_id', 'batches_user_id_foreign')
                ->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
