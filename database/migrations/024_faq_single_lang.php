<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->text('question')->nullable()->after('id');
            $table->text('answer')->nullable()->after('question');
        });

        // Copy data from JSON to new columns
        DB::table('faqs')->select('id', 'content')->get()
            ->each(function ($row) {
                $content = json_decode($row->content, true);
                DB::table('faqs')
                    ->where('id', $row->id)
                    ->update([
                        'question' => $content['id']['pertanyaan'] ?? '',
                        'answer'   => $content['id']['jawaban'] ?? '',
                    ]);
            });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['content']);
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->json('content')->nullable();
        });

        DB::table('faqs')->select('id', 'question', 'answer')->get()
            ->each(function ($row) {
                DB::table('faqs')
                    ->where('id', $row->id)
                    ->update([
                        'content' => json_encode([
                            'id' => ['pertanyaan' => $row->question, 'jawaban' => $row->answer],
                            'en' => ['pertanyaan' => '', 'jawaban' => '']
                        ]),
                    ]);
            });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question', 'answer']);
        });
    }
};
