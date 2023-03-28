<?php

namespace App\Imports;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Tipekelas;
use App\Models\Kota;
use App\Models\Angkatan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try {
            foreach ($collection as $key => $row) {
                
                // $kota_exist;
                // $angkatan_exist;
                // $kelas_exist;
                // $tipekelas_exist;
                // $user_exist;

                if ($key > 0) {
                    // $kota_exist = Kota::where('kota_name',$row[8])->first();
                    // if ($kota_exist === null) {
                    //     # code...
                    //     $kota =  [
                    //         'provinsi_id' => null,
                    //         'kota_name' => $row[8],
                    //     ];
                    //     $kota = Kota::create($kota);
                    //     $kota_exist = $kota;
                    // }

                    // $kelas_exist = Kelas::where('kelas_name',$row[1])->first();
                    // if ($kelas_exist === null) {
                    //     # code...
                    //     $kelas = [
                    //         'kelas_name'=> $row[1]
                    //     ];
                    //     $kelas = Kelas::create($kelas);
                    //     $kelas_exist = $kelas;
                    // }

                    // $tipekelas_exist = Tipekelas::where('tipekelas_name',$row[2])->first();
                    // if ($tipekelas_exist === null) {
                    //     # code...
                    //     $tipekelas = [
                    //         'tipekelas_name'=>$row[2]
                    //     ];
                    //     $tipekelas = Tipekelas::create($tipekelas);
                    //     $tipekelas_exist = $tipekelas;
                    // }

                    // $angkatan_exist = Angkatan::where('angkatan_name', $row[3])->first();
                    // if ($angkatan_exist) {
                    //     # code...
                    //     $angkatan = [
                    //         'angkatan_name'=>$row[3]
                    //     ];
                    //     $angkatan = Angkatan::create($angkatan);
                    //     $angkatan_exist = $angkatan;
                    // }

                    // $user_exist = User::where('name',$row[0])->first();
                    // if ($user_exist !== null) {
                        # code...
                        $user = [
                            'name' => $row[0],
                            'role'=>'siswa',
                            'pass'=> $row[4],
                            'password'=> Hash::make($row[4]),
                        ];
                        $user = User::create($user);
                        $user_exist = $user;

                        $siswa = [
                            'user_id' => $user_exist->id,
                            'angkatan_id' => null,
                            'kelas_id'=> null,
                            'tipekelas_id'=> null,
                            'kota_id'=> null,
                            'siswa_name'=> $row[0],
                            'siswa_nisn'=> $row[4],
                            'siswa_ranking'=>$row[6],
                            'siswa_sertifikat'=>$row[7],
                            'siswa_nilai'=>$row[5]
                        ];

                        $x = Siswa::create($siswa);
                    // }
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
