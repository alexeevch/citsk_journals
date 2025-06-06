<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attackers', function (Blueprint $table) {
            $table->id();
            $table->ipAddress("ipv4");
            $table->string("description", 255)->nullable();
            $table->string("country", 255);
            $table->timestamp("created_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attackers');
    }
};
