<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class AddRepairPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'repair.create']);
        Permission::create(['name' => 'repair.update']);
        Permission::create(['name' => 'repair.view']);
        Permission::create(['name' => 'repair.delete']);

        Permission::create(['name' => 'repair_status.update']);
        Permission::create(['name' => 'repair_status.access']);

        Permission::create(['name' => 'job_sheet.create']);
        Permission::create(['name' => 'job_sheet.edit']);
        Permission::create(['name' => 'job_sheet.delete']);
        Permission::create(['name' => 'job_sheet.view_assigned']);
        Permission::create(['name' => 'job_sheet.view_all']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
