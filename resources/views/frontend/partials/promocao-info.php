<div class="bar-info">
	<?=contagemRegressiva(date('Ymd'), $promocao->data_fim);?>

	<? if(!empty($promocao->valor_minimo)): ?>
	 investimento mínimo: <strong>R$ <?=DecimalForReal($promocao->valor_minimo) ?></strong>,
	<? endif;?>

	<? if(!empty($promocao->valor_premiacao)): ?>
	  total em prêmios: <strong>R$ <?php echo DecimalForReal($promocao->getTotalPremiacao()); ?>.</strong>
	<?endif;?>
</div>