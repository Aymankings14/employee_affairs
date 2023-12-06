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
        Schema::create('punishments', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['absence','delay','negligence_at_work','leaving_during_work']);
            /* *
             * Enum Value :
             * الغياب: Absence
             * التأخير: Delay
             * الإهمال بالعمل: Negligence at work
             * الخروج أثناء العمل: Leaving during work
             * */
            $table->string('judge');
            $table->string('date');
            $table->string('time');
            $table->foreignId('employee_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punishments');
    }
};
