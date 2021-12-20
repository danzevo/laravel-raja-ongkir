<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProsesController extends Controller
{
    public function proses(Request $request) {
        $perulangan = $request->input_perulangan?:0;

        $hasil = '';
        $count_hasil = 0;
        if($perulangan) {
            for($i=1;$i<=$perulangan;$i++) {
                if($i % 3 == 0 && $i % 5 == 0) {
                    $hasil .= 'Pasar 20 Belanja Pangan ';
                    $count_hasil++;
                } elseif($i % 3 == 0) {
                    if($count_hasil >= 2)
                        $hasil .= 'Belanja Pangan ';
                    else
                        $hasil .= 'Pasar 20 ';
                } elseif($i % 5 == 0) {
                    if($count_hasil >= 2)
                        $hasil .= 'Pasar 20 ';
                    else
                        $hasil .= 'Belanja Pangan ';
                } else {
                    $hasil .= $i.' ';
                }

                if($count_hasil == 5)
                    break;
            }
        }

        return response()->json(['success'=>'Ajax request submitted successfully', 'hasil' => $hasil]);
    }
}
