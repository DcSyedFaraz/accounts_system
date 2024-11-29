<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('billing_name')->nullable()->change();
        });

        // Update 'venders' table
        Schema::table('venders', function (Blueprint $table) {
            $table->string('billing_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('billing_name')->nullable(false)->change();
        });

        // Revert 'billing_name' to non-nullable in 'venders' table
        Schema::table('venders', function (Blueprint $table) {
            $table->string('billing_name')->nullable(false)->change();
        });
    }
};
