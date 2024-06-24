<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained();
            $table->string('type', 255);
            $table->string('serial_number', 100)->unique();
            $table->string('brand', 100);
            $table->string('model', 100);
            $table->string('status', 50);

            $table->string('cne_code', 100)->nullable()->unique();
            $table->string('location', 255)->nullable();
            $table->string('purchase_date', 50)->nullable();
            $table->string('price', 25)->nullable();
            $table->string('provider', 100)->nullable();
            $table->string('assignment_date', 50)->nullable();
            $table->string('return_date', 50)->nullable();
            $table->string('details', 255)->nullable();

            $table->string('os', 255)->nullable();
            $table->string('bios_password', 100)->nullable();
            $table->string('mac_address', 17)->nullable()->unique();
            $table->string('cpu', 255)->nullable();
            $table->string('ram', 255)->nullable();
            $table->string('gpu', 255)->nullable();
            $table->string('storage', 255)->nullable();
            $table->string('serial_storage', 100)->nullable()->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
