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
        Schema::table('employees', function (Blueprint $table) {
            // add column order properly
            $table->string('email')->nullable()->after('id');
            $table->string('phone')->nullable()->after('email');
            $table->string('firstname')->nullable()->after('phone');
            $table->string('middlename')->nullable()->after('firstname');
            $table->string('lastname')->nullable()->after('middlename');

            $table->foreignId('position_id')
                ->nullable()
                ->after('lastname')
                ->constrained('positions')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // drop foreign key first
            $table->dropForeign(['position_id']);

            // drop columns
            $table->dropColumn([
                'email',
                'phone',
                'firstname',
                'middlename',
                'lastname',
                'position_id',
            ]);
        });
    }
};
