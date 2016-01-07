<?php

namespace App\Http\Controllers\FrontEnd;


use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Promocoes;
use Mail;
Use Breadcrumb;

use mjanssen\BreadcrumbsBundle\Breadcrumbs;
use App\Http\Requests\FaleConoscoFormRequest;
use App\Http\Requests\EnviePromocaoFormRequest;

class FrontEndController extends Controller
{
    public function index()
    {

        $promocoes = Promocoes::orderBy('titulo')->get();


        return view('frontend.index', compact('promocoes'));

    }

    public function showPromocoes($slug)
    {

        $promocao = Promocoes::whereSlug($slug)->firstOrFail();

        Breadcrumbs::addBreadcrumb('Home', url('/'));
        Breadcrumbs::addBreadcrumb('Promoções', $promocao->getPermaLink()); //Does not need a url because it's the last breadcrumb segment
        Breadcrumbs::addBreadcrumb( $promocao->titulo, $promocao->getPermaLink());
        $breadcrumb = Breadcrumbs::generate(); //Breadcrumbs UL is generated and stored in an array.
        


        return view('frontend.showpromocoes',compact('promocao','breadcrumb')) ;      

    }

    public function FaleConosco(){
        //https://packagist.org/packages/mjanssen/laravel-5-breadcrumbs
        //Those are required to set some breadcrumbs first.
        Breadcrumbs::addBreadcrumb('Home', url('/'));
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

        Breadcrumbs::addBreadcrumb('Home', url('/'));
        Breadcrumbs::addBreadcrumb('Sobre', url('/sobre')); //Does not need a url because it's the last breadcrumb segment
        $breadcrumb = Breadcrumbs::generate(); //Breadcrumbs UL is generated and stored in an array.
        
        return view('frontend.sobre',compact('breadcrumb'));

    }

    public function EnvieSuaPromocao(){

        Breadcrumbs::addBreadcrumb('Home', url('/'));
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

}
