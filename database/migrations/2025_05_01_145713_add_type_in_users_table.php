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
        Schema::table('users', function (Blueprint $table) {
            // Add 'type' column with default value 'user'
            $table->string('type')->nullable()->after('id')->nullable();

            // Add 'can_login' column
            $table->tinyInteger('can_login')->nullable()->after('type');

            // Add 'slug' column
            $table->string('slug')->nullable()->after('can_login');

            // Add 'image' column (nullable)
            $table->string('image')->nullable()->after('slug');

            // Add 'social_links' column (JSON)
            $table->json('social_links')->nullable()->after('image');

            // Add 'category_id' column (nullable)
            $table->unsignedBigInteger('category_id')->nullable()->after('social_links');

            // Add 'status' column with default value true
            $table->boolean('status')->default(true)->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns added in the 'up' method
            $table->dropColumn([
                'type',
                'can_login',
                'slug',
                'image',
                'social_links',
                'category_id',
                'status',
            ]);
        });
    }
};
