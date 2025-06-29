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
            $table->ipAddress("ipv4")->unique();
            $table->string("description", 1000)->nullable();
            $table->timestamp("updated_at")->nullable();
            $table->timestamp("created_at")->useCurrent();

            $table->foreignId("country_id")->constrained("countries")->onDelete("restrict");
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
