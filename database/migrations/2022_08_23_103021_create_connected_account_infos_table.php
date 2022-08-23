<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectedAccountInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connected_account_infos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('connected_account_id');
            $table->string('email');
            $table->string('company_country');
            $table->string('company_state');
            $table->string('company_city');
            $table->string('company_line1');
            $table->string('company_line2');
            $table->string('company_postal_code');
            $table->string('b_profile_name');
            $table->string('b_profile_desc');
            $table->string('dob_day');
            $table->string('dob_month');
            $table->string('dob_year');
            $table->string('i_address_state');
            $table->string('i_address_city');
            $table->string('i_address_line1');
            $table->string('i_address_postal_code');
            $table->string('i_user_first_name');
            $table->string('i_user_last_name');
            $table->string('i_user_email');
            $table->string('i_user_Phone');
            $table->string('i_user_ssn_last_4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connected_account_infos');
    }
}
