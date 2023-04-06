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
                if ($key > 0) {
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
                        'angkatan' => $row[3],
                        'nama_kelas'=> $row[1],
                        'jurusan_kelas'=> $row[2],
                        'kota'=> $row[8],
                        'siswa_name'=> $row[0],
                        'siswa_nisn'=> $row[4],
                        'siswa_ranking'=>$row[6],
                        'siswa_sertifikat'=>$row[7],
                        'siswa_nilai'=>$row[5]
                    ];

                    $x = Siswa::create($siswa);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
