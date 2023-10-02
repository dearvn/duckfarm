<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS inventory_locations");
        DB::statement('CREATE VIEW inventory_locations AS
        select concat(it.id, "-", wh.id, "-", whb.id) as location_id, concat(inv.name, " (", it.name, ")") as inventory_name, inv.id as inventory_id, wh.name as warehouse_name, wh.id as warehouse_id, whb.name as bin_name,whb.id as bin_id, sum(itm.amount) as amount, inv.unit,
        (select sum(amount) from animal_inputs as ani where ani.location_id = concat(it.id, "-", wh.id, "-", whb.id) group by ani.location_id) as input_amount,
        (select sum(amount) from animal_treatments as ant where ant.location_id = concat(it.id, "-", wh.id, "-", whb.id) group by ant.location_id) as treatment_amount,
        (select sum(amount) from animal_feedings as anf where anf.location_id = concat(it.id, "-", wh.id, "-", whb.id) group by anf.location_id) as feeding_amount
        from inventory_items as itm 
        inner join tool_warehouses as wh on itm.warehouse_id = wh.id 
        inner join tool_inventories as inv on itm.inventory_id = inv.id 
        inner join warehouse_bins as whb on itm.warehouse_bin_id = whb.id 
        INNER join inventory_types as it on inv.type = it.id 
        where itm.amount > 0 group by it.id, wh.id, whb.id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS inventory_locations");
    }
};
