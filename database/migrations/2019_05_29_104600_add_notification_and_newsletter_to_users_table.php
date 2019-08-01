<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotificationAndNewsletterToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_email_notified')->default(1)->after('remember_token');
            $table->boolean('is_sms_notified')->default(1)->after('is_email_notified');
            $table->boolean('is_whatsapp_notified')->default(1)->after('is_sms_notified');
            $table->boolean('is_newsletter_enabled')->default(1)->after('is_whatsapp_notified');
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
            $table->dropColumn('is_email_notified');
            $table->dropColumn('is_sms_notified');
            $table->dropColumn('is_whatsapp_notified');
            $table->dropColumn('is_newsletter_enabled');
        });
    }
}
