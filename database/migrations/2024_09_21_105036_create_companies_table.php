<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained(table: 'clients')->onDelete('cascade');
            $table->decimal('establishment_fees', 10, 2); // رسوم التأسيس
            $table->decimal('fees', 10, 2); // الأتعاب
            $table->decimal('remaining_amount', 10, 2); // المبلغ المتبقي (موخر)
            $table->decimal('advance_amount', 10, 2); // المبلغ المدفوع مسبقاً (مقدم)
            $table->text('notes')->nullable(); // ملاحظات (اختياري)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
