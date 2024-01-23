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
        Schema::create('attack', function (Blueprint $table) {
            $table->id();
            $table->timestamp("detection_time");
            $table->timestamp("group_alert_time");
            $table->timestamp("supervisor_alert_time");
            $table->unsignedBigInteger("attacker_id");
            $table->unsignedBigInteger("attacked_id");
            $table->unsignedBigInteger('attack_type_id');
            $table->string("description", 255);
            $table->timestamps();

            $table->foreign("attacker_id")->references("id")->on("attacker");
            $table->foreign("attacked_id")->references("id")->on("attackeds");
            $table->foreign("attack_type_id")->references('id')->on("attack_types");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attack');
    }
};
