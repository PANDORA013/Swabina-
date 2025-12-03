<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('title_new')->nullable()->after('image');
            $table->text('description_new')->nullable()->after('title_new');
        });

        // Copy data from JSON to new columns
        DB::table('beritas')->select('id', 'title', 'description')->get()
            ->each(function ($row) {
                $titleData = json_decode($row->title, true);
                $descData = json_decode($row->description, true);
                
                DB::table('beritas')
                    ->where('id', $row->id)
                    ->update([
                        'title_new'       => $titleData['id'] ?? '',
                        'description_new' => $descData['id'] ?? '',
                    ]);
            });

        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
        });

        Schema::table('beritas', function (Blueprint $table) {
            $table->renameColumn('title_new', 'title');
            $table->renameColumn('description_new', 'description');
        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->renameColumn('title', 'title_new');
            $table->renameColumn('description', 'description_new');
        });

        Schema::table('beritas', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('description')->nullable();
        });

        DB::table('beritas')->select('id', 'title_new', 'description_new')->get()
            ->each(function ($row) {
                DB::table('beritas')
                    ->where('id', $row->id)
                    ->update([
                        'title'       => json_encode(['id' => $row->title_new, 'en' => '']),
                        'description' => json_encode(['id' => $row->description_new, 'en' => '']),
                    ]);
            });

        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn(['title_new', 'description_new']);
        });
    }
};
