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
        Schema::create('procurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained(table: 'clients')->onDelete('cascade');
            $table->string('authorization_number'); // رقم التوكيل الفعلي
            $table->string('notebook_number'); // رقم التوكيل في الدفتر
            $table->mediumText('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurations');
    }
};
