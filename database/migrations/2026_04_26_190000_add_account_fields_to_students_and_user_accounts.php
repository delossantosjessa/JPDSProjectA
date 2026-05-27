<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            if (!Schema::hasColumn('user_accounts', 'must_change_password')) {
                $table->boolean('must_change_password')->default(true)->after('is_active');
            }
        });

        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'user_account_id')) {
                $table->foreignId('user_account_id')
                    ->nullable()
                    ->after('email')
                    ->constrained('user_accounts')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'user_account_id')) {
                $table->dropConstrainedForeignId('user_account_id');
            }
        });

        Schema::table('user_accounts', function (Blueprint $table) {
            if (Schema::hasColumn('user_accounts', 'must_change_password')) {
                $table->dropColumn('must_change_password');
            }
        });
    }
};
