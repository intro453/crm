<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('last_name')->nullable();         // Фамилия
            $table->string('first_name');                     // Имя (обязательное)
            $table->string('middle_name')->nullable();        // Отчество

            $table->string('email')->nullable();              // Email
            $table->string('phone')->nullable();              // Телефон

            $table->date('birth_date')->nullable();           // Дата рождения

            $table->string('document_type')->nullable();      // Документ
            $table->string('document_number')->nullable();    // Номер документа
            $table->date('document_date')->nullable();        // Дата выдачи
            $table->string('document_issued_by')->nullable(); // Кем выдан

            $table->string('address_residence')->nullable();  // Адрес проживания
            $table->string('address_registration')->nullable(); // Адрес регистрации

            $table->text('additional_info')->nullable();     // Доп. информация

            $table->timestamps();
            $table->softDeletes();
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
