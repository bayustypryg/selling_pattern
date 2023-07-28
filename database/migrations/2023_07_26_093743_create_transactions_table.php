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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('trx_dt');
            $table->string('cif');
            $table->string('net_amt');
            $table->string('product_nm');
            $table->string('trx_type', 50);
            $table->string('fee_amt');
            $table->string('app_source', 50);
            $table->string('product_type', 50);
            $table->string('curr_cd');
            // Menambahkan indeks pada kolom 'cif'
            $table->index('cif');

            // Menambahkan indeks pada kolom 'trx_type'
            $table->index('trx_type');

            // Menambahkan indeks pada kolom 'product_nm'
            $table->index('product_nm');

            // Menambahkan indeks pada kolom 'product_type'
            $table->index('product_type');

            // Menambahkan indeks pada kolom 'app_source'
            $table->index('app_source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
