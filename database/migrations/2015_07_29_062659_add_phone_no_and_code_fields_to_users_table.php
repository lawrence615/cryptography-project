<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneNoAndCodeFieldsToUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_no', 20)->after('email');
            $table->string('code', 30)->after('remember_token');
            $table->smallInteger('verified')->after('code')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //drop created columns on rollback

            $table->dropColumn('phone_no');
            $table->dropColumn('code');
            $table->dropColumn('verified');
        });
    }

}
