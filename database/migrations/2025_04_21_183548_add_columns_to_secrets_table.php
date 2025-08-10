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
        Schema::table('secrets', function (Blueprint $table) {
            //
            $table->string('title')->after('id');
            $table->string('summary')->after('title');
            //category id field
            $table->foreignId('category_id')->after('summary')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->longText('content')->after('summary');
            $table->string('password')->after('content')->nullable();
            //ip address field
            $table->string('ip_address')->after('password')->nullable();
            //lifecycle of secret: when secret will expire
            $table->dateTime('expires_at')->after('ip_address')->nullable();
            //upvotes and downvotes
            $table->integer('upvotes')->after('expires_at')->default(0);
            $table->integer('downvotes')->after('upvotes')->default(0);
            //number of views   
            $table->integer('views')->after('downvotes')->default(0);
            //editor's choice boolean, default of false
            $table->boolean('is_editor_choice')->after('views')->default(false);
            //deleted_at field
            $table->softDeletes()->after('is_editor_choice');
            //blocked  boolean, default of false
            $table->boolean('is_blocked')->after('deleted_at')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secrets', function (Blueprint $table) {
            //
        });
    }
};
