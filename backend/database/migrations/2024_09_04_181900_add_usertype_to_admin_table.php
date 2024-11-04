<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('usertype')->nullable(); // Add a usertype column
        });
    
        
    }
    
    public function down():void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('usertype'); // Drop the column if rolling back
        });
    
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('usertype');
        });
    }
    
};
