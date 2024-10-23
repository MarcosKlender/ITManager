<?php

namespace Database\Seeders;

use App\Models\PdfCounter;
use Illuminate\Database\Seeder;

class PdfCounterSeeder extends Seeder
{
    public function run(): void
    {
        PdfCounter::updateOrCreate(['type' => 'entrega_equipos'], ['counter' => 0]);
        PdfCounter::updateOrCreate(['type' => 'entrega_bienes'], ['counter' => 0]);
        PdfCounter::updateOrCreate(['type' => 'devolucion_equipos'], ['counter' => 0]);
        PdfCounter::updateOrCreate(['type' => 'devolucion_bienes'], ['counter' => 0]);
    }
}
