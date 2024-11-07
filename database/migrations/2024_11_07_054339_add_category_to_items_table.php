<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('items', function (Blueprint $table) {
//             // Adding the 'category' column to the 'items' table
//             $table->string('category'); // You can customize the data type (e.g., string, enum, etc.)
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('items', function (Blueprint $table) {
//             // Dropping the 'category' column from the 'items' table
//             $table->dropColumn('category');
//         });
//     }
// };


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
        Schema::table('items', function (Blueprint $table) {
            // Adding the 'category' column to the 'items' table with 'nullable'
            $table->string('category')->nullable();  // 'nullable' allows the field to be empty
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Dropping the 'category' column from the 'items' table
            $table->dropColumn('category');
        });
    }
};
