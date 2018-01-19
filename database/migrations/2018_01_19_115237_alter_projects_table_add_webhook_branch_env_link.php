<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectsTableAddWebhookBranchEnvLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
	        $table->boolean('build_webhook_branch_env_link')->default(false)->after('allow_other_branch');
	        $table->boolean('deploy_webhook_branch_env_link')->default(false)->after('build_webhook_branch_env_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
	        $table->dropColumn('build_webhook_branch_env_link');
	        $table->dropColumn('deploy_webhook_branch_env_link');
        });
    }
}
