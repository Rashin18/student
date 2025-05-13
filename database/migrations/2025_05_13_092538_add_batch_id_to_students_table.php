<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBatchIdToStudentsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('students', 'batch_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->unsignedBigInteger('batch_id')->nullable()->after('id');
                $table->foreign('batch_id')->references('id')->on('batches')->onDelete('set null');
            });
        }
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['batch_id']);
            $table->dropColumn('batch_id');
        });
    }
}
