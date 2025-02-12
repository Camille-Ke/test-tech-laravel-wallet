<?php

declare(strict_types=1);

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
        Schema::create('recurrent_transfers', function (Blueprint $table) {
            $table->id();

            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamp('last_executed_date')->nullable();

            $table->foreignId('source_id')->constrained('wallets');

            $table->foreignId('target_id')->constrained('wallets');

            $table->integer('amount')->unsigned();
            $table->integer('frequency');

            $table->string('reason');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurrent_transfers');
    }
};
