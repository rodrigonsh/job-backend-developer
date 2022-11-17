<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BuscaController extends Controller
{

    /**
    * Busca de produtos
    * É necessário que o sistema tenha algumas funcionalidades de buscas para a manutenção do catálogo de produtos, sendo elas: 

    * - Busca pelos campos name e category (trazer resultados que batem com ambos os campos).
    * - Busca por uma categoria específica.
    * - Busca de produtos com e sem imagem.
    * - Buscar um produto pelo seu ID.
    */

    public function index()
    {
        $data = [];
        $data['categorias'] = Product::select('category')->distinct()->get();
        return view("index", $data);
    }

    public function termo(Request $r)
    {
        return 
            Product
                ::where('name', 'LIKE', '%'.$r->get('termo').'%')
                ->orWhere('category', 'LIKE', '%'.$r->get('termo').'%')
                ->get(); 
    }

    public function categoria(Request $r)
    {
        return 
            Product
                ::where('category', $r->get('cat'))
                ->get(); 
    }

    public function imagem(Request $r)
    {

        if ( $r->imagem == "com" )
        {
            return 
                Product
                    ::whereNotNull('image_url')
                    ->where('image_url', '!=', '')
                    ->get(); 
        }

        else
        {
            return 
                Product
                    ::whereNull('image_url')
                    ->orWhere('image_url', '')
                    ->get(); 
        }

    }

    public function id(Request $r)
    {
        return Product::findOrFail($r->get('id'));
    }

}
