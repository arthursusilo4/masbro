<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        // Adjust path if needed
        $file = database_path('seeders/data/wilayah.csv');
        $rows = array_map('str_getcsv', file($file));
        $header = array_map('trim', array_shift($rows)); // <-- trim header

        foreach ($rows as $row) {
            $row = array_map('trim', $row); // <-- trim row values too
            $data = array_combine($header, $row);

            // Insert branch if not exists
            $branchId = DB::table('branch')->updateOrInsert(
                ['name' => $data['BRANCH']],
                ['name' => $data['BRANCH']]
            );

            $branchId = DB::table('branch')->where('name', $data['BRANCH'])->value('id');

            // Insert cluster
            $clusterId = DB::table('cluster')->updateOrInsert(
                ['name' => $data['CLUSTER'], 'branch_id' => $branchId],
                ['name' => $data['CLUSTER'], 'branch_id' => $branchId]
            );

            $clusterId = DB::table('cluster')
                ->where('name', $data['CLUSTER'])
                ->where('branch_id', $branchId)
                ->value('id');

            // Insert district
            $districtId = DB::table('kota_kabupaten')->updateOrInsert(
                ['name' => $data['KABUPATEN'], 'cluster_id' => $clusterId],
                ['name' => $data['KABUPATEN'], 'cluster_id' => $clusterId]
            );

            $districtId = DB::table('kota_kabupaten')
                ->where('name', $data['KABUPATEN'])
                ->where('cluster_id', $clusterId)
                ->value('id');

            // Insert kecamatan
            DB::table('kecamatan')->updateOrInsert(
                ['name' => $data['KECAMATAN'], 'kota_kabupaten_id' => $districtId],
                ['name' => $data['KECAMATAN'], 'kota_kabupaten_id' => $districtId]
            );
        }

    }
}
