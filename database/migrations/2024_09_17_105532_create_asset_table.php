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
        Schema::create('asset', function (Blueprint $table) {
            $table->id('id_asset');
            $table->string('asset_number');
            $table->string('asset_desc');
            $table->string('asset_group');
            $table->string('departement');
            $table->string('location');
            $table->string('asset_condition');
            $table->datetime('confirm_date');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset');
    }
};
