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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained()->cascadeOnDelete();
            $table->enum('payment', ['Pendaftaran', 'Uang Pangkal', 'SPP', 'Makan/Katering', 'Lainnya']);
            $table->decimal('jumlah', 12, 2);
            $table->text('desc')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->date('date');
            $table->string('proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
