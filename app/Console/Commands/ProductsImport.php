<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;


class ProductsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import  {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa os produtos da fakestoreapi.com';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function parseItem($item)
    {
        $item['name'] = $item['title'];
        $item['image_url'] = $item['image'];
        return $item;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = (int) $this->option('id');

        if ( $id > 0 )
        {
            // pegar pelo id
            $response = Http::get("https://fakestoreapi.com/products/$id");
            $item = $this->parseItem($response->json());
            
            Product::create($item);            
            $this->info("Produto importado");
            return 0;
        }

        else
        {
            // pegar tudo    
            $response = Http::get('https://fakestoreapi.com/products');
            $items = $response->collect();
            foreach($items as $item)
            {
                $item = $this->parseItem($item);
                $prod = Product::create($item);
            }
            $this->info("Produtos importados");
        }


        return 0;
    }
}
