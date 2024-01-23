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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("attacker_id");
            $table->unsignedBigInteger("infrastructure_id");
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger("status_id");
            $table->string("description", 255)->nullable();
            $table->timestamp("detection_time")->nullable();
            $table->timestamp("group_alert_time")->nullable();
            $table->timestamp("supervisor_alert_time")->nullable();
            $table->timestamps();


            $table->foreign("attacker_id")->references("id")->on("attackers");
            $table->foreign("infrastructure_id")->references("id")->on("infrastructures");
            $table->foreign("type_id")->references('id')->on("incident_types");
            $table->foreign("status_id")->references("id")->on("incident_statuses");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
