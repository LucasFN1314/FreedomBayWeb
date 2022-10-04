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
    

    public function search(Request $req) {
        // || Devolver html
        return $this->get($req->url);
    }
    
    public function limpiar() {
        noticia::truncate();
    }

    public function save(Request $req) {
        

        // || Guardar noticias
            $noticia = new noticia();
            $noticia->title = $req->new['title'];
            $noticia->image = $req->new['image'];
            $noticia->save();
    }

    public function obtener() {
        return noticia::inRandomOrder()->limit(5)->get();
    }
}
