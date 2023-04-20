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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj');
            $table->string('cod_instalacao');
            $table->string('hash_emp');
            $table->string('fantasia_emp');
            $table->string('urlsistema');
            $table->string('urlRemoto');
            $table->json('apis');
            $table->string('enjoy');
            $table->string('cod_usu')->nullable();
            $table->string('cod_func')->nullable();

            $table->string('mac')->nullable();
            $table->timestamp('refresh_at');
            $table->timestamps();
        });
    }

    // "cnpj",
    // "cod_instalacao",
    // "fantasia_emp",
    // "flg_cloud",
    // "urlsistema",
    // 'urlRemoto',
    // 'apis',
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
