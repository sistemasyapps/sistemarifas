<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const INDEX_RAFFLE_STATUS_ID = 'orders_raffle_estatus_id_idx';
    private const INDEX_REF_BANK_RAFFLE = 'orders_ref_banco_raffle_idx';

    public function up(): void
    {
        if (! Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            if (! $this->indexExists(self::INDEX_RAFFLE_STATUS_ID)) {
                $table->index(['raffle_id', 'estatus', 'id'], self::INDEX_RAFFLE_STATUS_ID);
            }

            if (! $this->indexExists(self::INDEX_REF_BANK_RAFFLE)) {
                $table->index(['ref_banco', 'raffle_id'], self::INDEX_REF_BANK_RAFFLE);
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            if ($this->indexExists(self::INDEX_RAFFLE_STATUS_ID)) {
                $table->dropIndex(self::INDEX_RAFFLE_STATUS_ID);
            }

            if ($this->indexExists(self::INDEX_REF_BANK_RAFFLE)) {
                $table->dropIndex(self::INDEX_REF_BANK_RAFFLE);
            }
        });
    }

    private function indexExists(string $indexName): bool
    {
        $results = DB::select('SHOW INDEX FROM orders WHERE Key_name = ?', [$indexName]);

        return ! empty($results);
    }
};
