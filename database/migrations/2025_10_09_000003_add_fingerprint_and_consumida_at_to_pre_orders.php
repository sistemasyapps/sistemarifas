<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (! Schema::hasColumn('pre_orders', 'fingerprint')) {
                $table->char('fingerprint', 64)->nullable()->after('uuid');
                $table->index('fingerprint', 'pre_orders_fingerprint_idx');
            }

            if (! Schema::hasColumn('pre_orders', 'consumida_at')) {
                $table->timestamp('consumida_at')->nullable()->after('notificado_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (Schema::hasColumn('pre_orders', 'fingerprint')) {
                $table->dropIndex('pre_orders_fingerprint_idx');
                $table->dropColumn('fingerprint');
            }

            if (Schema::hasColumn('pre_orders', 'consumida_at')) {
                $table->dropColumn('consumida_at');
            }
        });
    }
};
