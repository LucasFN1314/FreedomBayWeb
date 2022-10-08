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
        else {
            print curl_error($c);
        }

        curl_close($c);
    } 
    public function search(Request $req) {
        // || Devolver html
        if($req) {
            return $this->get($req->url);
        }
        return null;
    }
    public function buscarPorLote(Request $req) {
        // || Devolver los html por lote
        $lecturas = [];
        $paginas = $req->paginas;
        foreach($paginas as $pagina) {
            $result = $this->get($pagina);
            array_push($lecturas, $result);
        }
        return $lecturas;
    }
    public function limpiar() {
        noticia::truncate();
    }
    public function save(Request $req) {
        // || Guardar noticias
            $noticia = new noticia();
            $noticia->title = $req->new['title'];
            $noticia->image = $req->new['image'];
            $noticia->link = $req->new['link'];
            $noticia->timestamps = false;
            $noticia->save();
    }
    public function guardarPorLote(Request $req) {
        // || Guardar noticias
            $articulos = $req->articulos;
            foreach($articulos as $articulo) {
                $noticia = new noticia();
                $noticia->title = $articulo['title'];
                $noticia->image = $articulo['image'];
                $noticia->link = $articulo['link'];
                $noticia->timestamps = false;
                $noticia->save();
            }
    }
    public function obtener() {
        return noticia::get();
    }
}
