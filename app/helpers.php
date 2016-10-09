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



function add_nofollow_content($content) {
	$content = preg_replace_callback(
	'/<a[^>]*href=["|\']([^"|\']*)["|\'][^>]*>([^<]*)<\/a>/i',
	function($m) {
		if (strpos($m[1],  $_SERVER['SERVER_NAME']) === false && strpos($m[1],  $_SERVER['SERVER_NAME']) === false)
		return '<a href="'.$m[1].'" rel="nofollow" target="_blank">'.$m[2].'</a>';
		else
		return '<a href="'.$m[1].'">'.$m[2].'</a>';
	},
	$content);
	return $content;
}