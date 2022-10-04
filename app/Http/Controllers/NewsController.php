<?php

namespace App\Http\Controllers;

use App\Models\noticia;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function get($url) {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        if (curl_error($c))
            die(curl_error($c));

        $html = curl_exec($c);

        // Get the status code
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

        if($status == 200) {
            return $html;
        }

        curl_close($c);
    } 
    public function getHtml(Request $req) {
        $c = curl_init($req->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        if (curl_error($c))
            die(curl_error($c));

        $html = curl_exec($c);

        // Get the status code
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

        if($status == 200) {
            return $html;
        }

        curl_close($c);
    } 

    public function search(Request $req) {
        // || Devolver html
        return $this->get($req->url);
    }
    
    public function save(Request $req) {
        // Limpieza
        noticia::truncate();

        // || Guardar noticias
        for($i = 0; $i<count($req->news); $i++) {
            $noticia = new noticia();
            $noticia->title = $req->news[$i]['title'];
            $noticia->image = $req->news[$i]['image'];
            $noticia->save();
        }
    }

    public function obtener() {
        return noticia::inRandomOrder()->limit(5)->get();
    }
}
