<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    //

    public function getHtml(Request $req) {
        $c = curl_init($req->url);

        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        
        if (curl_error($c))
            die(curl_error($c));

        $html = curl_exec($c);

        // Get the status code
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

        if($status == 200 || $status == 301) {
            return $html;
        }
        else {
            dd($req, $status);
        }

        curl_close($c);
    } 
}
