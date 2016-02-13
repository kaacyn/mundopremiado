<?php 

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sitemap;
use URL;
use App\Promocoes;

class SitemapsController extends Controller
{

    public function index()
    {
        $promocoes = Promocoes::all();

        foreach ($promocoes as $promocao) {
            Sitemap::addTag( $promocao->getPermaLink() , $promocao->updated_at, 'daily', '0.8');
        }

        return Sitemap::render();
    }	
	
    public function promocoes()
    {
        $promocoes = Promocoes::all();

        foreach ($promocoes as $promocao) {
            Sitemap::addTag(route('promocoes.show', $promocao), $promocao->updated_at, 'daily', '0.8');
        }

        return Sitemap::render();
    }
}