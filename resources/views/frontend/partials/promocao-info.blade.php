<div class="bar-info">
	<?=$promocao->contagemRegressiva();?>

	<? if(!empty($promocao->valor_minimo)): ?>
	 investimento mínimo para participar: <strong>R$ <?=DecimalForReal($promocao->valor_minimo)?></strong>,
	<? endif;?>

	valor total em prêmios:
	<? if(!empty($promocao->getTotalPremiacao())): ?>
	   <strong>R$ <?php echo DecimalForReal($promocao->getTotalPremiacao()); ?>.</strong>
	<?else: ?>
		não divulgado
	<?endif?>
</div>