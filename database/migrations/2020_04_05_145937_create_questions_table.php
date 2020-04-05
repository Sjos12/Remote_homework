<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateQuestionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('questions', static function (Blueprint $table) {
            $table->id();
            $table->efficientUuid('uuid')->index();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('content')->nullable();
            $table->enum(
                'state',
                [
                    'draft',
                    'open',
                    'closed',
                ]
            );
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('questions', static function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }

    public function down(): void
    {
        throw new RuntimeException('Never rollback! Is bad practice!');
    }
}
