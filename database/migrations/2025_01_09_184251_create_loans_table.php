<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PaymentFrequencyType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Client user ID
            $table->foreignId('financer_id')->constrained('financers')->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->decimal('interest', 5, 2);
            $table->integer('term_in_months');
            $table->smallInteger('payment_frequency');
            $table->timestamp('fully_paid_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
