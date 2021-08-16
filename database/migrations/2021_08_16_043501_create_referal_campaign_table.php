<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferalCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referal_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('account_id');
            $table->string('current_user_ip',15);
            $table->tinyInteger('sign_up')->nullable()->comment('0:only open referal link; 1:open link and sign up');
            $table->string('sign_up_account_id')->nullable()->comment('account id of new signed up user');
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
        Schema::dropIfExists('referal_campaign');
    }
}
