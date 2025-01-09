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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default(\App\Enums\UserRoleTypeEnum::CLIENT->value);
            $table->dropColumn('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('mobile')->nullable();
            $table->string('id_url')->nullable();
            $table->string('contract_url')->nullable();
            $table->timestamp('banned_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->string('name')->nullable();
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('barangay');
            $table->dropColumn('mobile');
            $table->dropColumn('id_url');
            $table->dropColumn('contract_url');
            $table->dropColumn('banned_at');
        });
    }
};
