<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Resources\Output\WilayahResource;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Provinces;
use App\Models\Subdistricts;

class WilayahController extends BaseController
{
    public function prov()
    {
        $provinces = Provinces::all();
        return $this->sendResponse(WilayahResource::collection($provinces),'retrive provinsi');
    }

    public function kabkot($prov_id)
    {
        $cities = Cities::where('prov_id', $prov_id)->get();
        return $this->sendResponse(WilayahResource::collection($cities),'retrive kabupaten & kota');
    }

    public function kec($kabkot_id)
    {
        $districts = Districts::where('city_id', $kabkot_id)->get();
        return $this->sendResponse(WilayahResource::collection($districts),'retrive kecamatan');
    }

    public function desa($kec_id)
    {
        $villages = Subdistricts::where('dis_id', $kec_id)->get();
        return $this->sendResponse(WilayahResource::collection($villages),'retrive desa');
    }
}

