<?php

namespace App\Imports;
use App\Models\Univ;
use App\Models\Jurusan;
use App\Models\Kota;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PtnImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $univ = [];
        try {
            foreach ($collection as $key => $row) {
                if ($key > 0) {
                    // input soal
                    if ($row[2] === 'KOTA') {
                        $kota_exist = Kota::where('kota_name',$row[3])->first();
                        if ($kota_exist === null) {
                            # code...
                            $kota =  [
                                'provinsi_id' => null,
                                'kota_name' => $row[3],
                            ];
                            $kota = Kota::create($kota);
                            $kota_exist = $kota;
                        }
                        
                    }

                    if ($row[0] === 'UNIV') {
                        $univ_exist = Univ::where('univ_name', $row[1])->first();
                        if ($univ_exist === null) {
                            # code...
                            $univ = [
                                'univ_name' => $row[1],
                                'kota_id'   => $kota_exist->id,
                                'univ_alumni' => $row[5],
                            ];
                            $univ = Univ::create($univ);
                            $univ_exist = $univ;
                        }
                    }

                    $jurusan_exist = Jurusan::where('jurusan_name', $row[1])->first();
                        if ($jurusan_exist === null) {
                            # code...
                            $jr = [
                                'univ_id' => $univ_exist->id, 
                                'jurusan_name' => $row[1],
                            ];
                            $jr = Jurusan::create($jr);
                            $jr->univ()->syncWithoutDetaching($univ_exist->id);
                        }else {
                            # code...
                            $jurusan_exist->univ()->syncWithoutDetaching($univ_exist->id);
                        }
                    
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
