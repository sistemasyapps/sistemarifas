<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('pre_orders', 'id_comercio')) {
                $table->string('id_comercio', 64)->nullable()->after('uuid');
            }
            if (!Schema::hasColumn('pre_orders', 'telefono_comercio')) {
                $table->string('telefono_comercio', 16)->nullable()->after('telefono');
            }
            if (!Schema::hasColumn('pre_orders', 'telefono_emisor')) {
                $table->string('telefono_emisor', 16)->nullable()->after('telefono_comercio');
            }
            if (!Schema::hasColumn('pre_orders', 'concepto')) {
                $table->string('concepto', 50)->nullable()->after('telefono_emisor');
            }
            if (!Schema::hasColumn('pre_orders', 'banco_emisor')) {
                $table->char('banco_emisor', 3)->nullable()->after('concepto');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            if (Schema::hasColumn('pre_orders', 'id_comercio')) $table->dropColumn('id_comercio');
            if (Schema::hasColumn('pre_orders', 'telefono_comercio')) $table->dropColumn('telefono_comercio');
            if (Schema::hasColumn('pre_orders', 'telefono_emisor')) $table->dropColumn('telefono_emisor');
            if (Schema::hasColumn('pre_orders', 'concepto')) $table->dropColumn('concepto');
            if (Schema::hasColumn('pre_orders', 'banco_emisor')) $table->dropColumn('banco_emisor');
        });
    }
};

