jQuery(document).ready(function($){
	
	$('.datepicker').datepicker({
        format: "dd/mm/yyyy"
    });
    

    $('.mask_money').mask('000.000.000.000.000,00', {reverse: true});
})

