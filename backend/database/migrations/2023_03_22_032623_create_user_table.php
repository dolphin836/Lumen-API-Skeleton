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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('username', 64)->unique()->comment('用户名');
            $table->string('name', 64)->default('')->comment('姓名');
            $table->string('phone', 32)->unique()->comment('手机');
            $table->string('email', 256)->unique()->comment('邮箱');
            $table->string('password')->default('')->comment('密码');
            $table->unsignedTinyInteger('state')->default(0)->comment('状态');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新时间');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
