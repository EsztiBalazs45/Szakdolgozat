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
        Schema::create('clients', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users','id');
            $table->string('CompanyName');
            $table->string('tax_number');
            $table->string('registration_number');
            $table->string('headquarters');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
