<?php

//Retorna o valor em Real para número decimal
function RealForDecimal($preco) {

	if($preco!=''){
		$preco = str_replace('.', '',$preco);
    	$preco = str_replace(',', '.',$preco);
	}

    

    return $preco;

}

//Retorna o valor em Deciaml para número Real
function DecimalForReal($preco) {

	if($preco!=''){
		$preco = number_format($preco, 2, ',', '.');
	}

    return $preco;

}

//Retorna a data passada do formato 15/03/1987 apara aaaammdd by kacyn
function DateBRForYMD($data) {

	if(empty($data)):
		return;
	endif;

    $txt_preco_loop_dtini = str_replace('/', '-', $data);

    return date("Ymd", strtotime($txt_preco_loop_dtini));

}

//Retorna a data passada do formato aaaammdd  apara 15/03/1987 by kacyn
function DateYMDforBR($data) {
	
	if(!empty($data)):
		
		$date = DateTime::createFromFormat('Ymd', $data);
		
        return  $date->format('d/m/Y');

    endif;

}


function bodyClass() {
	
	$body_classes = array();
	$class = "";

	foreach ( \Request::segments() as $segment ):
	
		if ( is_numeric( $segment ) || empty( $segment ) ):
			continue;
		endif;

		$class .= ! empty( $class ) ? "-" . $segment : $segment;
		array_push( $body_classes, $class );

	endforeach;

	return ! empty( $body_classes ) ? implode( ' ', $body_classes ) : NULL;
	
}


function contagemRegressiva($data_inicio,$data_fim){
	$tempo = array();
	$tempo_concat = "";
	$data_inicio = new DateTime( $data_inicio );
	$data_fim    = new DateTime( $data_fim );

	$intervalo = $data_inicio->diff( $data_fim );

	if($intervalo->y != 0):
		$tempo[] = "{$intervalo->y} ".($intervalo->y==1?"ano":"anos");
	endif;

	if($intervalo->m != 0):
		$tempo[] = "{$intervalo->m} ".($intervalo->m==1?"mês":"meses");
	endif;

	if($intervalo->d != 0):	
		$tempo[] = "{$intervalo->d} ".($intervalo->d==1?"dia":"dias");
	endif;

	 $x=0;
	 if(!empty($tempo) and $data_inicio <  $data_fim):
		foreach($tempo as $tem): $x++;

			if(count($tempo)-1 == $x):
				$tempo_concat .= $tem." e ";
			elseif(count($tempo) == $x):
				$tempo_concat .= $tem;
			else:
				$tempo_concat .= $tem.", ";
			endif;

		endforeach;

		return "Tempo restante: <strong>". $tempo_concat.",</strong> ";

	elseif($data_inicio ==  $data_fim):
		return "<strong>Essa promoção encerra hoje,</strong> ";
	else:

		return "<strong>Promoção encerrada,</strong> ";

	endif;



}