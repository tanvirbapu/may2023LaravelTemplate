<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cruds', function (Blueprint $table) {
            $table->id();
            $table->string('textbox')->nullable();
            $table->unsignedBigInteger('dropdown')->nullable();
            $table->foreign('dropdown')->references('id')->on('options');
            $table->string('radiobutton')->nullable();
            $table->string('checkbox')->nullable();
            $table->string('toggle')->default('off');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('editor')->nullable();
            $table->date('date')->nullable();
            $table->text('multiple_value')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};