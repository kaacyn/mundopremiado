<?php

namespace App\Http\Controllers\SysAdmin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Promocoes;
use Illumniate\Html\HtmlServiceProvider;


use App\Route;
use View;
use Validator;
Use Input;
Use Redirect;
Use Session;

class PromocoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $promocoes = Promocoes::orderBy('titulo')->get();

        return view('sysadmin.promocoes.index', compact('promocoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return View::make('sysadmin.promocoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'titulo'          => 'required',
            //'preco'           => 'required | numeric',
            'descricao'       => 'required',
            'imagem'          => 'mimes:jpeg,bmp,png'
        );

        $messages = array(
            'required'  => 'O campo :attribute é obrigatório',
            'numeric'   => 'Digite apenas números no campo :attribute.',
            'between'   => 'Digite valores entre :min e :max.'
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        // process the login
        if ($validator->fails()) {

            return Redirect::to('sysadmin/promocoes/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));

        } else {


            // store
            $promocao = new Promocoes;
            $promocao->titulo            = Input::get('titulo');
            $promocao->descricao         = Input::get('descricao');
            $promocao->url_hotsite       = Input::get('url_hotsite');
            $promocao->url_regulamento   = Input::get('url_regulamento');
            $promocao->valor_minimo      = RealForDecimal(Input::get('valor_minimo'));
            $promocao->valor_premiacao   = RealForDecimal(Input::get('valor_premiacao'));
            $promocao->regiao            = Input::get('regiao');
            $promocao->premiacao         = Input::get('premiacao');
            $promocao->data_inicio       = DateBRForYMD(Input::get('data_inicio'));
            $promocao->data_fim          = DateBRForYMD(Input::get('data_fim'));

            $promocao->save();


            #UPLOADS DE IMAGEM

            $file = Input::file('imagem');

            $this->salveImagem(  $file, $promocao, $request );


            // redirect
            Session::flash('message', 'Promoção criado com sucesso');
            return Redirect::to('sysadmin/promocoes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the produto
        $promocao = Promocoes::find($id);

        // show the view and pass the promocao to it
        return View::make('sysadmin.promocoes.show')
            ->with('promocao', $promocao);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the produto
        $promocao = Promocoes::find($id);

        // show the edit form and pass the produto
        return View::make('sysadmin.promocoes.edit')
            ->with('promocao', $promocao);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'titulo'          => 'required',
            'slug'            => 'required',
            //'descricao'     => 'required'
        );

        $messages = array(
            'required'  => 'O campo :attribute é obrigatório',
            'numeric'   => 'Digite apenas números no campo :attribute.',
            'between'   => 'Digite valores entre :min e :max.'
        );

        $validator = Validator::make(Input::all(), $rules,$messages);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('sysadmin/promocoes/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $promocao = Promocoes::find($id);
            $promocao->titulo            = Input::get('titulo');
            $promocao->slug              = Input::get('slug');
            $promocao->descricao         = Input::get('descricao');
            $promocao->url_hotsite       = Input::get('url_hotsite');
            $promocao->url_regulamento   = Input::get('url_regulamento');
            $promocao->valor_minimo      = RealForDecimal(Input::get('valor_minimo'));
            $promocao->valor_premiacao   = RealForDecimal(Input::get('valor_premiacao'));
            $promocao->regiao            = Input::get('regiao');
            $promocao->premiacao         = Input::get('premiacao');
            $promocao->data_inicio       = DateBRForYMD(Input::get('data_inicio'));
            $promocao->data_fim          = DateBRForYMD(Input::get('data_fim'));

            $promocao->save();

            #UPLOADS DE IMAGEM

            $file = Input::file('imagem');

            $this->salveImagem(  $file, $promocao, $request );

            // redirect
            Session::flash('message', 'Promoção atualizado com sucesso');
            return Redirect::to('sysadmin/promocoes');
    }   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $promocao = Promocoes::find($id);
        $promocao->delete();

        // redirect
        Session::flash('message', 'Promoção excluído com sucesso!');
        return Redirect::to('sysadmin/promocoes');
    }


    function salveImagem($file, $promocao, $request){
        if(is_object($file)):
            $image_name = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)); 

            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION); // jpg

            $file_name = $promocao->id."_".$image_name.".".$extension;

            $request->file('imagem')->move(
                base_path() . '/public/uploads/promocoes/', $file_name
            );

            $promocao = Promocoes::find($promocao->id);
            $promocao->imagem        = "uploads/promocoes/".$file_name;
            $promocao->save(); 
        endif;
    }
}
