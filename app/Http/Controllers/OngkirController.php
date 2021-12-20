<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    public function index() {
        $response = Http::get('https://api.rajaongkir.com/starter/city', [
            'key' => 'f85e16aba74df9dab9c705c83efd1829',
        ])['rajaongkir'];

        $kota = $response['results'];

        return view('ongkir', compact('kota'));
    }

    public function proses(Request $request) {
        $kota_asal = $request->kota_asal;
        $kota_tujuan = $request->kota_tujuan;
        $berat = $request->berat;
        $kurir = $request->kurir;

        $response = Http::post('https://api.rajaongkir.com/starter/cost', [
            'key' => 'f85e16aba74df9dab9c705c83efd1829',
            'origin' => $kota_asal,
            'destination' => $kota_tujuan,
            'weight' => $berat,
            'courier' => $kurir,
        ])['rajaongkir'];


        $result = $response['results'];

        $hasil = '';
        $i=1;
        foreach($result[0]['costs'] as $row) {
            $hasil .= '<tr>';
            $hasil .= '<td>'.$i.'</td>';
            $hasil .= '<td>'.$result[0]['code'].'</td>';
            $hasil .= '<td>'.$row['service'].'</td>';
            $hasil .= '<td>'.$row['cost'][0]['etd'].' Hari</td>';
            $hasil .= '<td>'.'Rp. '.number_format($row['cost'][0]['value'],0,',','.').'</td>';
            $hasil .= '</tr>';
            $i++;
        }

        return response()->json(['success'=>'Ajax request submitted successfully', 'hasil' => $hasil]);
    }
}
