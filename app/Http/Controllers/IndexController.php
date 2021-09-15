<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\InvoicesImport;
use App\Models\Invoice;
use DataTables;

class IndexController extends Controller
{
    public function index(){
        return view('index');
    }
    public function marvelCharacters(){
        return view('marvel_characters');
    }

    public function getMarvelCharacters(Request $request){
        $offset = $request->offset;
        $apikey = "63422ad5b7499eb83bde1f601f14548e";
        $privateKey = "5ac0f639b591dcba00e86a2971bb806dac691aa8";
        $ts =\Carbon\Carbon::now()->timestamp;
        $hash = md5($ts.$privateKey.$apikey);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://gateway.marvel.com/v1/public/characters?apikey=$apikey&hash=$hash&ts=$ts&offset=$offset",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function import(){
        return view('import');
    }

    public function getImports(){
        return Datatables::of(Invoice::get())->make();
    }
    public function saveImport(Request $request){
        if( \Maatwebsite\Excel\Facades\Excel::import(new InvoicesImport,
            $request->file('csv_file')->store('temp'))){
           return back()->with("success", "Excel Sheet uploaded successfully!");
       }
       else{
           return back()->with("error", "Unable to upload excel sheet!");
       }
    }
}
