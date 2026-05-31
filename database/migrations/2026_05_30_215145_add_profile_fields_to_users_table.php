<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact')->nullable()->after('email');
            $table->string('gender')->nullable()->after('contact');
            $table->string('address')->nullable()->after('gender');
            $table->string('role')->default('user')->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['contact', 'gender', 'address', 'role']);
        });
    }
};
