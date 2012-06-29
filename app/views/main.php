<?php $html = new HTMLHelper(); ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
<?php if (isset($detector) && is_object($detector) && $detector->isiPhone()) { ?>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0" />
<?php } ?>
		<title><?php startblock('title') ?>Votação de Prioridades 2013<?php endblock() ?></title>
<?php startblock('css'); require_once 'stylesheets.php'; endblock('css'); ?>
	</head>
	<body>
<?php startblock('main'); ?>
		<div class="container internal">
			<div class="row header">
				<div class="sixcol">
					<?php echo $html->link('<img src="/images/logotipo_internas.png" alt="Sistema Estadual de Participação Popular e Cidadã" />', 'http://www.participa.rs.gov.br/', array('title' => 'Sistema Estadual de Participação Popular e Cidadã')); ?>
				</div>
				<div class="sixcol last gov">
					<?php echo $html->link('<img src="/images/logoGovernoCoredes.png" alt="Governo do Estado" />', "http://www.estado.rs.gov.br/", array('title' => 'Governo do Estado')); ?>
				</div>
			</div>
			<div class="row identification">
				<div class="sixcol" data-corede="00">
					<h1><?php echo AppController::getPageName(); ?></h1>
					<p class="name"><?php echo AppController::getPageSubName(); ?></p>
					<p class="region"><?php if (isset($current_nm_regiao)) echo $current_nm_regiao; ?></p>
				</div>
			</div>
<?php include_once VIEWS_PATH.'flash.php'; ?>
<?php emptyblock('content') ?>
			<div class="row footer">
				<ul class="twelvecol">
					<li><?php echo $html->link("Como Votar", "http://www.participa.rs.gov.br/upload/1340886342_votacaodeprioridades_coredes_v9.pdf", array("target" => "_blank")); ?></li>
					<li><?php echo $html->link("Portal da Participação", "http://www.participa.rs.gov.br/capa.php", array('target' => '_blank')); ?></li>
					<li><?php echo $html->link("PROCERGS", "http://www.procergs.rs.gov.br/", array('target' => '_blank')); ?></li>
					<li><?php echo $html->link("Site do Governo do Estado do RS", "http://www.estado.rs.gov.br/", array('target' => '_blank')); ?></li>
				</ul>
			</div>
		</div>
<?php endblock('main'); ?>
<?php startblock('javascript'); require_once 'javascripts.php'; endblock('javascript'); ?>
	</body>
</html>
