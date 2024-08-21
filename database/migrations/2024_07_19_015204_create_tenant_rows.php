<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::table("tenants")->count() == 0) {
            DB::table("tenants")->insert(
                [
                    'id' => 'wepremios-com-br', 'data' => '{"created_at": "2024-05-28 20:20:53", "updated_at": "2024-05-28 20:20:53", "tenancy_db_name": "bd-wepremios-com-br"}'

                ]);
        }

        if (!Schema::hasTable("domains")) {
            Schema::create('domains', function (Blueprint $table) {
                $table->increments('id');
                $table->string('domain', 255)->unique();
                $table->string('tenant_id');

                $table->timestamps();
                $table->foreign('tenant_id')->references('id')->on('tenants')->onUpdate('cascade')->onDelete('cascade');
            });

        }
        if (DB::table("domains")->count() == 0) {
            DB::table("domains")->insert(
                [
                    'id' => 1,
                    'domain' => 'wepremios.com.br',
                    'tenant_id' => 'wepremios-com-br'
                ]
            );
        }


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
