<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key > 0) {
                if ($row[0] !== null && $row[1] !== null) {
                    # code...
                    $user = User::create([
                        'name'=> $row[0],
                        'pass'=> $row[1],
                        'password'=> Hash::make($row[1]),
                        'role'=> 'siswa'
                    ]);
                }
            }
        }
    }
}
