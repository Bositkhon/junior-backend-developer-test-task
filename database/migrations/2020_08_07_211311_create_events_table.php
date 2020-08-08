<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('project_title');
            $table->decimal('cost');
            $table->string('project_type');
            $table->foreignId('company_id')
                ->constrained('companies', 'id');
            $table->date('date');
            $table->foreignId('time_shift_id')
                ->constrained('time_shifts', 'id');
            $table->string('duty_holder_full_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['time_shift_id']);
        });
        Schema::dropIfExists('events');
    }
}
