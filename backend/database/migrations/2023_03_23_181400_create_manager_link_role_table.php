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
        Schema::create('manager_link_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id')->default(0)->comment('管理员 Id');
            $table->unsignedBigInteger('manager_role_id')->default(0)->comment('管理员角色 Id');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新时间');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_link_role');
    }
};
