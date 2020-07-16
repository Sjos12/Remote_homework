<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateAnswersTable extends Migration
{
    public function up(): void
    {
        Schema::create('answers', static function (Blueprint $table) {
            $table->id();
            $table->efficientUuid('uuid')->index();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->text('content')->nullable();
            $table->json('annotations');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');

            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions');
        });
    }

    public function down(): void
    {
        throw new RuntimeException('Never rollback! Is bad practice!');
    }
}
