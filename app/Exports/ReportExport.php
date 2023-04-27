<?php
namespace App\Exports;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromView, ShouldAutoSize
{
    public function __construct($angkatan)
    {
        $this->angkatan = $angkatan;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data;
        $periode;
        if ($this->angkatan == null || $this->angkatan == "" || $this->angkatan == "x") {
            # all
            $data = Siswa::get();
            $periode = 'ALL';
        }else {
            # periode...
            $data = Siswa::where('angkatan',$this->angkatan)->get();
            $periode = $this->angkatan;
        }
        
        $kelas = [];
        $status = [];
        $pilihan_1 = [];
        $pilihan_2 = [];
        foreach ($data as $key => $val) {
            # kelas
            $kelas[] = $val->nama_kelas.' '.$val->jurusan_kelas.' '.$val->angkatan;
            # status
            if ($val->pilih->count() > 0) {
                if ($val->rating->count() > 1) {
                    $status[] = 'SELESAI RATING';
                }elseif($val->rating->count() == 1) {
                    $status[] = 'RATING SEBAGIAN';
                }else {
                    $status[] = 'BELUM RATING';
                }

            }else {
                $status[] = 'BELUM MEMILIH';
            }
            
            #pilihan1
            $first = [];
            if ($val->pilih->count() > 0) {
                if ($val->rating->count() > 0) {
                    foreach ($val->rating as $key => $value) {
                        $first[] = $value->jurusan->jurusan_name.'-'.$value->univ->univ_name. ' "'.$value->score.'"';
                    }
                    $pilihan_1[] = $first[0];
                }else {
                    $first = 'BELUM RATING';
                    $pilihan_1[] = $first;
                }
            }else {
                $first = 'BELUM MEMILIH';
                $pilihan_1[] = $first;
            }

            #pilihan2
            $last = [];
            if ($val->pilih->count() > 0) {
                if ($val->rating->count() > 1) {
                    foreach ($val->rating as $key => $value) {
                        $last[] = $value->jurusan->jurusan_name.'-'.$value->univ->univ_name. ' "'.$value->score.'"';
                    }
                    $pilihan_2[] = $last[1];
                }else {
                    if ($val->pilih->count() < 2) {
                        $last = 'BELUM MEMILIH';
                        $pilihan_2[] = $last;
                    }else {
                        $last = 'BELUM RATING' ;
                        $pilihan_2[] = $last;
                    }
                }

            }else {
                $last = 'BELUM MEMILIH';
                $pilihan_2[] = $last;
            }

        }

        return view('page.export_report',compact('data','first','kelas','status','pilihan_1','pilihan_2','periode'));
    }
}
