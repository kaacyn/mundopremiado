<?php

namespace App\Http\Controllers\FrontEnd;


use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Promocoes;
use App\Premios;
use Mail;
Use Breadcrumb;
use DB;

use mjanssen\BreadcrumbsBundle\Breadcrumbs;
use App\Http\Requests\FaleConoscoFormRequest;
use App\Http\Requests\EnviePromocaoFormRequest;

class FrontEndController extends Controller
{
    public function index()
    {

        /*
        Query de referência
        
        SELECT DATE_FORMAT(periodo_fim, '%Y-%m-%d') AS formated_date,  p1.* from promocoes p1 

        INNER JOIN
                    sorteios s3 
                    ON p1.id = s3.prom_id
        INNER JOIN

                ( 
                    SELECT s1.prom_id, max(s1.periodo_fim) as data_maxima 
                    FROM  sorteios s1 
                    GROUP BY s1.prom_id
                ) as s2 ON s2.prom_id = p1.id
                    
                
        WHERE 

        s3.periodo_fim > DATE_FORMAT(now(), '%Y%m%d')
        and     s2.data_maxima=s3.periodo_fim

        group by p1.id
        ORDER by s3.periodo_fim asc

        */

        //DB::connection()->enableQueryLog();

 
        $promocoes = Promocoes::
         selectRaw("DATE_FORMAT(periodo_fim, '%Y-%m-%d') AS formated_date,  p1.*")
        ->from("promocoes as p1")
        ->join('sorteios as s3', 'p1.id', '=', 's3.prom_id')
        ->join(DB::raw('( 
                SELECT s1.prom_id, max(s1.periodo_fim) as data_maxima 
                    FROM  sorteios s1 
                    GROUP BY s1.prom_id
                ) as s2'), 's2.prom_id', '=', 'p1.id')
        ->whereRaw ("s3.periodo_fim >= DATE_FORMAT(now(), '%Y%m%d')")
        ->whereRaw ("s2.data_maxima=s3.periodo_fim")
        ->whereRaw ("p1.situacao='publicado'")
        ->groupBy('p1.id')
        ->orderBy("s3.periodo_fim","asc")
        ->paginate(40);

            // $queries = DB::getQueryLog();
            // echo "<pre>";
            // print_r($queries);
            // echo "</pre>";exit;


        return view('frontend.index', compact('promocoes'));

    }

    public function encerradas()
    {
        //DB::connection()->enableQueryLog();

 
        $promocoes = Promocoes::
         selectRaw("DATE_FORMAT(periodo_fim, '%Y-%m-%d') AS formated_date,  p1.*")
        ->from("promocoes as p1")
        ->join('sorteios as s3', 'p1.id', '=', 's3.prom_id')
        ->join(DB::raw('( 
                SELECT s1.prom_id, max(s1.periodo_fim) as data_maxima 
                    FROM  sorteios s1 
                    GROUP BY s1.prom_id
                ) as s2'), 's2.prom_id', '=', 'p1.id')
        ->whereRaw ("s3.periodo_fim < DATE_FORMAT(now(), '%Y%m%d')")
        ->whereRaw ("s2.data_maxima=s3.periodo_fim")
        ->whereRaw ("p1.situacao='publicado'")
        ->groupBy('p1.id')
        ->orderBy("s3.periodo_fim","asc")
        ->paginate(40);

            // $queries = DB::getQueryLog();
            // echo "<pre>";
            // print_r($queries);
            // echo "</pre>";exit;


        return view('frontend.encerradas', compact('promocoes'));

    }

    public function showPromocoes($slug)
    {

        $promocao = Promocoes::whereSlug($slug)->firstOrFail();

        //Breadcrumbs::addBreadcrumb('Home', url('/'));
        Breadcrumbs::addBreadcrumb('Promoções', url('/')); //Does not need a url because it's the last breadcrumb segment
        Breadcrumbs::addBreadcrumb( $promocao->titulo, $promocao->getPermaLink());
        $breadcrumb = Breadcrumbs::generate(); //Breadcrumbs UL is generated and stored in an array.
        
        # outras promoções
        $outraspromocoes = Promocoes::
         selectRaw("DATE_FORMAT(periodo_fim, '%Y-%m-%d') AS formated_date,  p1.*")
        ->from("promocoes as p1")
        ->join('sorteios as s3', 'p1.id', '=', 's3.prom_id')
        ->join(DB::raw('( 
                SELECT s1.prom_id, max(s1.periodo_fim) as data_maxima 
                    FROM  sorteios s1 
                    GROUP BY s1.prom_id
                ) as s2'), 's2.prom_id', '=', 'p1.id')
        ->whereRaw ("s3.periodo_fim >= DATE_FORMAT(now(), '%Y%m%d')")
        ->whereRaw ("s2.data_maxima=s3.periodo_fim")
        ->whereRaw ("p1.situacao='publicado'")
        ->groupBy('p1.id')
        ->orderByRaw("RAND()")
        ->limit(5)->get();

       // $outraspromocoes = Promocoes::orderByRaw("RAND()")->limit(5)->get();

        // get next user
        $next = Promocoes::where('id', '<', $promocao->id)->where('situacao', 'publicado')->orderBy('id','desc')->first();

        // get previous  user
        $previous  = Promocoes::where('id', '>', $promocao->id)->where('situacao', 'publicado')->orderBy('id','asc')->first();


        return view('frontend.showpromocoes',compact('promocao','breadcrumb','outraspromocoes','next','previous')) ;      

    }

    public function FaleConosco(){
        //https://packagist.org/packages/mjanssen/laravel-5-breadcrumbs
        //Those are required to set some breadcrumbs first.
        Breadcrumbs::addBreadcrumb('Promoções', url('/'));
        Breadcrumbs::addBreadcrumb('Fale Conosco', url('/fale-conosco')); //Does not need a url because it's the last breadcrumb segment
        $breadcrumb = Breadcrumbs::generate(); //Breadcrumbs UL is generated and stored in an array.
        
   
        return view('frontend.fale-conosco',compact('breadcrumb'));
    }

    public function FaleConoscoStore(FaleConoscoFormRequest $request){

        $nome          = $request->get('nome');
        $email         = $request->get('email');
        $mensagem      = $request->get('mensagem');


        Mail::send('frontend.template-emails.contato',
            array(
                'nome'          => $nome,
                'email'         => $email,
                'mensagem'      => $mensagem
            ), function($message) use($email,$nome) {
               

                $message->from('atendimento@mundopremiado.com.br');
                $message->to('atendimento@mundopremiado.com.br', 'Mundo Premiado');
                $message->replyTo($email, $nome);
                $message->cc('jessyka@mundopremiado.com.br','Jessyka Dalmora');
                $message->cc('kaacyn@gmail.com','Fabiano Cacin Pinel');
                $message->subject('Contato via site');
                
             });

        return \Redirect::route('fale-conosco')->with('message', 'Obrigado! Seu contato foi enviado com sucesso.');

      //  return view('frontend.fale-conosco');
    }

   
    public function Sobre(){
        //https://packagist.org/packages/mjanssen/laravel-5-breadcrumbs

        Breadcrumbs::addBreadcrumb('Promoções', url('/'));
        Breadcrumbs::addBreadcrumb('Sobre', url('/sobre')); //Does not need a url because it's the last breadcrumb segment
        $breadcrumb = Breadcrumbs::generate(); //Breadcrumbs UL is generated and stored in an array.
        
        return view('frontend.sobre',compact('breadcrumb'));

    }

    public function EnvieSuaPromocao(){

        Breadcrumbs::addBreadcrumb('Promoções', url('/'));
        Breadcrumbs::addBreadcrumb('Envie sua promoção', url('/envie-sua-promocao')); 
        $breadcrumb = Breadcrumbs::generate();
        
        return view('frontend.envie-sua-promocao',compact('breadcrumb'));

   
    }

    public function EnvieSuaPromocaoStore(EnviePromocaoFormRequest $request){

        $nome          = $request->get('nome');
        $email         = $request->get('email');
        $hotsite       = $request->get('hotsite');
        $observacao    = $request->get('observacao');

        //echo $observacao; exit;

        Mail::send('frontend.template-emails.cadastropromocoes',
            array(
                'nome'          => $nome,
                'email'         => $email,
                'hotsite'       => $hotsite,
                'observacao'   => $observacao 
            ), function($message) use($email,$nome) {
               

                $message->from('atendimento@mundopremiado.com.br');
                $message->to('atendimento@mundopremiado.com.br', 'Mundo Premiado');
                $message->replyTo($email, $nome);
                $message->cc('jessyka@mundopremiado.com.br','Jessyka Dalmora');
                $message->cc('kaacyn@gmail.com','Fabiano Cacin Pinel');
                $message->subject('Envio de promoção');
                
             });

        return \Redirect::route('envie-sua-promocao')->with('message', 'Obrigado! Sua promoção foi enviada com sucesso.');

      //  return view('frontend.fale-conosco');
    }

    public function PoliticaPrivacidade(){

        Breadcrumbs::addBreadcrumb('Promoções', url('/'));
        Breadcrumbs::addBreadcrumb('Política de privacidade', url('/politica-de-privacidade')); 
        $breadcrumb = Breadcrumbs::generate();
        
        return view('frontend.politica_privacidade',compact('breadcrumb'));
      //  return view('frontend.fale-conosco');
    }


}
