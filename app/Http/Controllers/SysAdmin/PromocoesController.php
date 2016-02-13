<?php

namespace App\Http\Controllers\SysAdmin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Promocoes;
use App\Sorteios;
use App\Premios;


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

        $promocoes = Promocoes::orderBy('id', 'DESC')->get();

        return view('sysadmin.promocoes.index', compact('promocoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sorteios = $this->getSorteiosArray();

        return View::make('sysadmin.promocoes.create')
         ->with('sorteios',$sorteios);
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
            $promocao->titulo            = trim(Input::get('titulo'));
            $promocao->situacao          = trim(Input::get('situacao'));
            $promocao->descricao         = trim(Input::get('descricao'));
            $promocao->url_hotsite       = trim(Input::get('url_hotsite'));
            $promocao->url_regulamento   = trim(Input::get('url_regulamento'));
            $promocao->valor_minimo      = RealForDecimal(Input::get('valor_minimo'));
           // $promocao->valor_premiacao   = RealForDecimal(Input::get('valor_premiacao'));
            $promocao->regiao            = trim(Input::get('regiao'));
            $promocao->premiacao         = trim(Input::get('premiacao'));
            $promocao->data_inicio       = DateBRForYMD(Input::get('data_inicio'));
            $promocao->data_fim          = DateBRForYMD(Input::get('data_fim'));
            $promocao->url_ganhadores    = trim(Input::get('url_ganhadores'));

            $promocao->save();


            #UPLOADS DE IMAGEM

            $file = Input::file('imagem');

            $this->salveImagem(  $file, $promocao, $request );


            $sorteios      =    Input::get('sorteios');  

            $this->setSorteiosUpdate($sorteios,$promocao->id);

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
        $premios = Premios::where('prom_id', $promocao->id)->get(); 

        $sorteios = $this->getSorteiosArray($promocao->id);

        // echo "<pre>";
        // print_r( $sorteios );
        // echo "</pre>";

        // show the edit form and pass the produto
        return View::make('sysadmin.promocoes.edit')
            ->with('promocao', $promocao)
            ->with('premios',$premios )
            ->with('sorteios',$sorteios);


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
            $promocao->situacao          = trim(Input::get('situacao'));
            $promocao->slug              = Input::get('slug');
            $promocao->descricao         = trim(Input::get('descricao'));


            $promocao->url_hotsite       = trim(Input::get('url_hotsite'));
            $promocao->url_regulamento   = trim(Input::get('url_regulamento'));
            $promocao->valor_minimo      = RealForDecimal(Input::get('valor_minimo'));
           // $promocao->valor_premiacao   = RealForDecimal(Input::get('valor_premiacao'));
            $promocao->regiao            = trim(Input::get('regiao'));
            $promocao->premiacao         = Input::get('premiacao');
            $promocao->data_inicio       = DateBRForYMD(Input::get('data_inicio'));
            $promocao->data_fim          = DateBRForYMD(Input::get('data_fim'));
            $promocao->url_ganhadores    = trim(Input::get('url_ganhadores'));

            $promocao->save();

            #UPLOADS DE IMAGEM

            $file = Input::file('imagem');

            $this->salveImagem(  $file, $promocao, $request );

            $sorteios      =    Input::get('sorteios');  

            $this->setSorteiosUpdate($sorteios,$promocao->id);
          
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


    public function getSorteiosArray($prom_id=false){

        if($prom_id ==  false):
            return array();
        endif;

        $oObject        = Sorteios::where('prom_id', $prom_id)->get();
        $sorteio_array  = array();
        $premio_array   = array();

        if(!empty($oObject)):
            foreach($oObject as $sorteio):

                $oPremios        = Premios::where('sort_id', $sorteio->id)->get();
                if(!empty( $oPremios )):
                    foreach( $oPremios as $premio):
                        
                        $premio_array[] = array(
                            'sort_id'   =>  $premio->sort_id,
                            'quantidade'=>  $premio->quantidade,
                            'nome'      =>  trim($premio->nome),
                            'descricao' =>  trim($premio->descricao),
                            'valor'     =>  DecimalForReal($premio->valor),
                            'prom_id'   =>  $premio->prom_id
                        );

                    endforeach;
                endif;

                $sorteio_array[] = array(
                    'id'                =>  $sorteio->id,
                    'prom_id'           =>  $prom_id,
                    'observacao'        =>  trim($sorteio->observacao),
                    'periodo_inicio'    =>  DateYMDforBR($sorteio->periodo_inicio),
                    'periodo_fim'       =>  DateYMDforBR($sorteio->periodo_fim),
                    'data_sorteio'      =>  DateYMDforBR($sorteio->data_sorteio),
                    'premios'           =>  $premio_array
                    );

                $premio_array = array();

            endforeach; 
        endif;

        return  $sorteio_array;
    }

    public function setSorteiosUpdate($sorteios, $prom_id){

        Sorteios::where('prom_id', $prom_id)->delete();

        Premios::where('prom_id', $prom_id)->delete();

         if(!empty($sorteios)):

             foreach($sorteios as $sorteio):

                if( is_array($sorteio) ):

                    $oSorteio                  = new Sorteios;
                    $oSorteio->prom_id         = $prom_id;
                    $oSorteio->observacao      = trim($sorteio['observacao']);
                    $oSorteio->periodo_inicio  = DateBRForYMD($sorteio['periodo_inicio']);
                    $oSorteio->periodo_fim     = DateBRForYMD($sorteio['periodo_fim']);
                    $oSorteio->data_sorteio    = DateBRForYMD($sorteio['data_sorteio']);
                    $oSorteio->save();


                     if(!empty($sorteio['premios'])):
                         foreach($sorteio['premios'] as $premio):

                            if( is_array($premio) ):

                                $oPremios                    = new Premios;
                                $oPremios->sort_id           = $oSorteio->id;
                                $oPremios->quantidade        = $premio['quantidade'];
                                $oPremios->nome              = trim($premio['nome']);
                                $oPremios->descricao         = trim($premio['descricao']);
                                $oPremios->valor             = RealForDecimal($premio['valor']);
                                $oPremios->prom_id           = $prom_id;
                                $oPremios->save();

                            endif;

                         endforeach;
                      endif;

                endif;

             endforeach;
            // exit;
          endif;

    }

}


