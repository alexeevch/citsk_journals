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
            $table->foreignId("attacker_id")->constrained();
            $table->foreignId("infrastructure_id")->constrained();
            $table->foreignId('type_id')->constrained("incident_types");
            $table->foreignId("status_id")->constrained("incident_statuses");
            $table->foreignId("created_by")->constrained("users");

            $table->text("description")->nullable();

            $table->timestamp("detection_at")->nullable();
            $table->timestamp("group_notified_at")->nullable();
            $table->timestamp("supervisor_notified_at")->nullable();

            $table->timestamps();
            $table->softDeletes();
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
