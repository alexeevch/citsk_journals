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
        Schema::create('attack_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("attack_id");
            $table->unsignedBigInteger("attack_status_id");
            $table->timestamps();

            $table->foreign("attack_id")->references("id")->on("attack");
            $table->foreign("attack_status_id")->references("id")->on("attack_list_statuses");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attack_lists');
    }
};
