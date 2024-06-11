<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained();
            $table->string('type', 255);
            $table->string('serial_number', 100)->unique();
            $table->string('brand', 100);
            $table->string('model', 100);
            $table->string('status', 50);

            $table->string('cne_code', 100)->nullable()->unique();
            $table->string('location', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
