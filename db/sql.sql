-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for mundopremiado
CREATE DATABASE IF NOT EXISTS `mundopremiado` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mundopremiado`;


-- Dumping structure for table mundopremiado.lojistas
CREATE TABLE IF NOT EXISTS `lojistas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razao_social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome_fantazia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.lojistas: ~0 rows (approximately)
/*!40000 ALTER TABLE `lojistas` DISABLE KEYS */;
/*!40000 ALTER TABLE `lojistas` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.migrations: ~10 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2015_12_12_0_create_lojistas_table', 1),
	('2015_12_12_0_create_premios_table', 1),
	('2015_12_12_0_create_produtos_table', 1),
	('2015_12_12_0_create_promocoes_table', 1),
	('2015_12_12_193537_create_promocoes_produtos_table', 1),
	('2015_12_12_193551_create_promocoes_premios_table', 1),
	('2015_12_12_193609_create_promocoes_lojistas_table', 1),
	('2015_12_12_193643_create_produtos_lojistas_table', 1),
	('2015_12_12_1_create_periodos_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.periodos
CREATE TABLE IF NOT EXISTS `periodos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_inicio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_fim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prom_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `periodos_prom_id_foreign` (`prom_id`),
  CONSTRAINT `periodos_prom_id_foreign` FOREIGN KEY (`prom_id`) REFERENCES `promocoes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.periodos: ~0 rows (approximately)
/*!40000 ALTER TABLE `periodos` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodos` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.premios
CREATE TABLE IF NOT EXISTS `premios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.premios: ~0 rows (approximately)
/*!40000 ALTER TABLE `premios` DISABLE KEYS */;
/*!40000 ALTER TABLE `premios` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.produtos: ~0 rows (approximately)
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.produtos_lojistas
CREATE TABLE IF NOT EXISTS `produtos_lojistas` (
  `prod_id` int(10) unsigned NOT NULL,
  `loji_id` int(10) unsigned NOT NULL,
  KEY `produtos_lojistas_prod_id_foreign` (`prod_id`),
  KEY `produtos_lojistas_loji_id_foreign` (`loji_id`),
  CONSTRAINT `produtos_lojistas_loji_id_foreign` FOREIGN KEY (`loji_id`) REFERENCES `lojistas` (`id`),
  CONSTRAINT `produtos_lojistas_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.produtos_lojistas: ~0 rows (approximately)
/*!40000 ALTER TABLE `produtos_lojistas` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos_lojistas` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.promocoes
CREATE TABLE IF NOT EXISTS `promocoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_inicio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_fim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published_at` timestamp NULL DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_hotsite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_regulamento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor_premiacao` decimal(10,2) DEFAULT NULL,
  `premiacao` text COLLATE utf8_unicode_ci,
  `regiao` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor_minimo` decimal(10,2) DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.promocoes: ~8 rows (approximately)
/*!40000 ALTER TABLE `promocoes` DISABLE KEYS */;
INSERT IGNORE INTO `promocoes` (`id`, `titulo`, `slug`, `data_inicio`, `data_fim`, `created_at`, `updated_at`, `published_at`, `imagem`, `url_hotsite`, `url_regulamento`, `valor_premiacao`, `premiacao`, `regiao`, `valor_minimo`, `descricao`, `status`) VALUES
	(10, 'Promoção Riachuelo Carnaval dos Sonhos', 'promocao-riachuelo-carnaval-dos-sonhos', '20151229', '20160121', '2016-01-06 17:18:33', '2016-01-07 13:30:50', NULL, 'uploads/promocoes/10_promocao-riachuelo.jpg', 'http://www.carnavaldossonhos.com.br/#home', '', 100000.00, '10 Pacotes de viagem com destino ao Rio de Janeiro/RJ, no valor unitário de R$ 10.000,00, de 03 dias e 02 noites, com direito a 1 acompanhante, passagens aéreas, hospedagem incluindo café da manhã, almoço e jantar; camisetas, ingressos, etc.', 'Brasil', 120.00, '<p>O Participante que desejar participar desta promo&ccedil;&atilde;o, primeiramente, dever&aacute; possuir um dos cart&otilde;es participantes e realizar seu cadastro online, por meio do www.carnavaldossonhos.com.br, ou nos caixas de vendas das Lojas Riachuelo informando CPF, telefone fixo e m&oacute;vel acompanhado do c&oacute;digo de &aacute;rea e e-mail.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Compras de R$120,00(cento e vinte reais) gera 1(um) n&uacute;mero da sorte, R$ 370,00 (trezentos e setenta reais), o participante ter&aacute; direito a 03 (tr&ecirc;s) N&uacute;meros da Sorte, sendo o saldo de R$ 10,00 (dez reais) armazenado no sistema para atribui&ccedil;&atilde;o de 01 (um) novo N&uacute;mero da Sorte ao atingir o valor m&iacute;nimo estabelecido e seus m&uacute;ltiplos.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>10 (dez) Pacotes de viagem com destino ao Rio de Janeiro/RJ, no valor unit&aacute;rio de R$ 10.000,00 (dez mil reais), de 03 (tr&ecirc;s) dias e 02 (duas) noites, com direito a 1 (um) acompanhante. O pacote &eacute; constitu&iacute;do de: (a) passagens a&eacute;reas de ida e volta em classe econ&ocirc;mica; todos os transportes que se fizerem necess&aacute;rios de ida e volta do contemplado e seu acompanhante para embarque, a crit&eacute;rio das Promotoras; hospedagem em hotel categoria tur&iacute;stica, pens&atilde;o completa (caf&eacute; da manh&atilde;, almo&ccedil;o e jantar); (b) todos os transportes que se fizerem necess&aacute;rios de ida e volta ao evento; (c) 02 (duas) camisetas e 01 (um) par de ingressos, que d&atilde;o o direito &agrave; participa&ccedil;&atilde;o no desfile das Escolas de Samba do Grupo Especial do Rio de Janeiro, nas cadeiras de frisas &ldquo;Lounge Riachuelo&rdquo; do Camarote &ldquo;Rio, Samba e Carnaval&rdquo; no setor 5 do Samb&oacute;dromo do Rio de Janeiro, com direito ao servi&ccedil;o de traslado, alimenta&ccedil;&atilde;o e bebidas inclu&iacute;das, nos dias 7 e 8 de fevereiro de 2016.</p>', NULL),
	(11, 'Promoção Sky Masterchef', 'promocao-sky-masterchef', '20151201', '20160115', '2016-01-06 18:35:51', '2016-01-08 11:25:34', NULL, 'uploads/promocoes/11_promocao-sky-masterchef.jpg', 'http://www.skytlcmasterchef.com.br/', 'http://www.skytlcmasterchef.com.br/#regulamento', 40920.84, '3(três) Pacote de viagem para Cartagena, na Colômbia, com direito 1(um) acompanhante, incluindo tour gastronômico nos restaurantes da cidade, transportes terrestres, passagens aéreas de ida e volta, hospedagem, alimentação e seguro viagem.', 'Brasil', 54.90, '<p>Para participar da promo&ccedil;&atilde;o, o interessado dever&aacute; ser cliente Sky p&oacute;s-pago, acessar o site <a href="http://www.skytlcmasterchef.com.br" target="_blank">http://www.skytlcmasterchef.com.br</a>, preencher o formul&aacute;rio de cadastro com CPF, e e-mail, respondendo a pergunta: &ldquo;Com qual empresa de TV por assinatura voc&ecirc; concorre a 3 viagens para um tour gastron&ocirc;mico em Cartagena, Col&ocirc;mbia?&rdquo;.</p>\r\n<p>Tamb&eacute;m poder&aacute; se inscrever enviando um SMS com seu CPF, sem pontos e/ou tra&ccedil;os, contendo apenas n&uacute;meros, para o n&uacute;mero 30401.</p>\r\n<p>3(tr&ecirc;s) Pacote de viagem para Cartagena, na Col&ocirc;mbia, com direito 1(um) acompanhante, incluindo tour gastron&ocirc;mico nos restaurantes da cidade, transportes terrestres, passagens a&eacute;reas de ida e volta, hospedagem, alimenta&ccedil;&atilde;o e seguro viagem.</p>\r\n<p>O sorteio &nbsp;ser&aacute; realizado no dia 29/01/2016.</p>', NULL),
	(12, 'Promoção Colgate Troque sua Escova', 'promocao-colgate-troque-sua-escova', '20151201', '20160229', '2016-01-06 18:51:21', '2016-01-07 13:23:01', NULL, 'uploads/promocoes/12_promocao-colgate.jpg', 'http://www.promocaocolgate.com.br/', '', 75000.00, 'São 3 prêmios de R$ 10.000,00 e 150 prêmios de R$ 300,00', 'Brasil', 13.41, '<p>Para participar da promo&ccedil;&atilde;o, o interessado dever&aacute; realizar a compra de produtos da linha de escova de dentes da marca Colgate, no per&iacute;odo de 01/12/2015 a 29/02/2016, dever&aacute; ainda guardar o cupom fiscal contendo a descri&ccedil;&atilde;o do produto o n&uacute;mero de identifica&ccedil;&atilde;o.</p>\r\n<p>&nbsp;</p>\r\n<p>Para se inscrever o consumidor dever&aacute; acessar o site www.promocaocolgate.com.br, preencher o formul&aacute;rio de cadastro com nome completo, CPF, RG, telefones fixo e m&oacute;vel com c&oacute;digo de &aacute;rea, endere&ccedil;o completo, sexo, data de nascimento, responder &agrave;s perguntas, e informar os c&oacute;digos dos produtos.</p>\r\n<p>&nbsp;</p>\r\n<p>S&atilde;o 3(tr&ecirc;s) pr&ecirc;mios de R$ 10.000,00(dez mil reais) e 150( cento e cinquenta ) pr&ecirc;mios de R$ 300,00( trezentos reais).</p>\r\n<p>&nbsp;</p>\r\n<p>A promo&ccedil;&atilde;o &eacute; exclusiva e v&aacute;lida em todas as farmacias do Brasil.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', NULL),
	(13, 'Promoção Chilli Beans Fashion Cruise', 'promocao-chilli-beans-fashion-cruise', '20151128', '20160122', '2016-01-06 21:04:49', '2016-01-07 13:35:11', NULL, 'uploads/promocoes/13_promocao-chilli-beans.jpg', 'http://www.promocaonavio.com.br/area_do_participante/login', 'http://www.promocaonavio.com.br/regulamento/sorteio', 441948.00, 'Viagens de navio da  Chilli Beans com acompanhante, Spray Chilli Beans, Case Chilli Beans,  Presilha Chilli Beans, Nécessaire Chilli Beans, Bolsa Chilli Beans, Skate – LongBoard ,Violão, Guitarra, Bolsa emborrachada de Praia,   Balde inflável Sansuy para latinhas, Toalha de praia tamanho 75x140cm, Vale-Compras Chilli Beans', 'Brasil', 69.00, '<p>Para participar desta promo&ccedil;&atilde;o deve-se adquirir apenas os &oacute;culos solares, rel&oacute;gios, arma&ccedil;&atilde;o para &oacute;culos de grau e lentes da marca Chilli Beans.</p>\r\n<p>O consumidor dever&aacute; inscrever-se na promo&ccedil;&atilde;o no per&iacute;odo de 28/11/2015 a 22/01/2016, atrav&eacute;s do site www.chillibeans.com.br/promocaonavio, informando obrigatoriamente os seguintes dados: nome, CPF, RG, data de nascimento, endere&ccedil;o, loja onde adquiriu o produto, telefone residencial, telefone celular e e-mail, al&eacute;m de criar um login e senha para acesso ao site.</p>\r\n<p>O sorteio ser&aacute; realizado na data de 23.01.2016.</p>\r\n<p>O consumidor dever&aacute; guardar consigo todos os cupons rasp&aacute;veis contendo o c&oacute;digo alfanum&eacute;rico e as notas/cupons fiscais dos produtos promocionados cadastrados. Ser&atilde;o integralmente suportadas pela empresa passagens a&eacute;reas ou terrestres, de ida e volta, em classe econ&ocirc;mica, incluindo as taxas de embarque, os traslados necess&aacute;rios de ida e volta da resid&ecirc;ncia dos contemplados.</p>\r\n<p>Ir&aacute; ocorrer ao longo do tempo oito sorteios.</p>\r\n<p>1- 28.11.2015 a 04.12.2015</p>\r\n<p>2- 05.12.2015 a 11.12.2015</p>\r\n<p>3- 12.12.2015 a 18.12.2015</p>\r\n<p>4- 19.12.2015 a 25.12.2015</p>\r\n<p>5- 26.12.2015 a 01.01.2016</p>\r\n<p>6- 02.01.2016 a 08.01.2016</p>\r\n<p>7- 09.01.2016 a 15.01.2016</p>\r\n<p>8- 16.01.2016 a 22.01.2016</p>\r\n<p>8 (oito) viagens a bordo do Navio da Chilli Beans (Fashion Cruize) com direito a um acompanhante. Ser&atilde;o integralmente suportadas pela empresa passagens a&eacute;reas ou terrestres, de ida e volta, em classe econ&ocirc;mica, incluindo as taxas de embarque, os traslados necess&aacute;rios de ida e volta da resid&ecirc;ncia dos contemplados.</p>\r\n<p>3.500 (tr&ecirc;s mil e quinhentos) - Spray Chilli Beans - 25 Mls/ solu&ccedil;&atilde;o liquida para limpar, desengordurar e proteger lentes de &Oacute;culos de Sol e Receitu&aacute;rio.</p>\r\n<p>3.000 (tr&ecirc;s mil) - Case Chilli Beans - 16 X 8 X 7 CM - Estojo r&iacute;gido para &Oacute;culos Solar e Receitu&aacute;rio.</p>\r\n<p>2.000 (dois mil) - Presilha Chilli Beans - 8 x 3 x 3,5 CM - Presilha/Clip de quebra sol automotivo para &Oacute;culos solar.</p>\r\n<p>550 (quinhentos e cinquenta) - N&eacute;cessaire Chilli Beans - 19 X 9 X 8 CM - Estojo Necessaire.</p>\r\n<p>400 (quatroscentos) - Bolsa Chilli Beans - Poliester e Lona.</p>\r\n<p>20 (vinte) - Skate &ndash; LongBoard - Marca DropBoard.</p>\r\n<p>20 (vinte) - Viol&atilde;o - Viol&atilde;o Nylon Modelo Cl&aacute;ssico cor: Preto 105cm X 39cm X 11cm.</p>\r\n<p>10 (dez) - Guitarra - Guitarra El&eacute;trica modelo Strato Cor: Preto Tamanho: 100cm X 33cm X 4,5cm.</p>\r\n<p>100 (cem) - Bolsa emborrachada de Praia &ndash; tamanho 29cm (altura) x 50cm (largura) x 12cm (profundidade).</p>\r\n<p>300 (trezentos) - Balde infl&aacute;vel Sansuy para latinhas.</p>\r\n<p>100 (cem) - Toalha de praia tamanho 75x140cm.</p>\r\n<p>8.000 (oito mil) - Vale-Compras Chilli Beans de R$ 20,00.</p>\r\n<p>7.000 (sete mil) - Vale-Compras Chilli Beans de R$ 30,00.</p>', NULL),
	(15, 'Promoção Skol Summer House', 'promocao-skol-summer-house', '20151215', '20160122', '2016-01-07 12:59:15', '2016-01-07 13:11:06', NULL, 'uploads/promocoes/15_promocao-skol.jpg', 'http://www.skol.com.br/verao/', '', 20874.00, 'Kits, camisetas, ingressos, mochilas, óculos personalizado e bonés.', 'Brasil', 2.74, '<p>Para participar, basta ao interessado acessar o site www.skol.com.br/verao e selecionar 01 (uma) dentre as op&ccedil;&otilde;es de casas dispon&iacute;veis no cat&aacute;logo oferecido pela Skol, de acordo com a sua prefer&ecirc;ncia e datas disponiveis, preencher o cadastro com nome completo, CPF, data de nascimento, CEP, telefone de contato fixo e m&oacute;vel com DDD, endere&ccedil;o de e-mail e confirma&ccedil;&atilde;o de e-mail, senha e confirma&ccedil;&atilde;o de senha, endere&ccedil;o residencial completo, incluindo Estado e cidade, sexo (n&atilde;o obrigat&oacute;rio). Uma vez conclu&iacute;do o cadastro, o participante dever&aacute; clicar no bot&atilde;o ON que aparecer&aacute; na tela, ocasi&atilde;o na qual indicara se foi ou n&atilde;o contemplado. <br /> <br /> S&atilde;o v&aacute;lidas inscri&ccedil;&otilde;es at&eacute; a data de 22/01/2016.<br /> <br /> Cada participante somente poder&aacute; ser contemplado 01 (uma) &uacute;nica vez durante toda a promo&ccedil;&atilde;o.<br /> <br /> O sorteio dos vales-brindes ocorre de forma cont&iacute;nua no per&iacute;odo do dia 15/12/2015 a 22/01/2016.<br /> <br /> 40 (quarenta) Kits ver&atilde;o Skol, cada um composto por 01 (uma) camiseta e 01 (um) ingresso &agrave; casa selecionada.<br /> <br /> 40 (quarenta) Kits ver&atilde;o Skol, cada um composto por 01 (uma) mochila da marca Jansport e 01 (um) ingresso &agrave; casa selecionada.<br /> <br /> 40 (quarenta) Kits ver&atilde;o Skol, cada um composto por 01 (um) &oacute;culos personalizado e 01 (um) ingresso &agrave; casa selecionada.<br /> <br /> 40 (quarenta) Kits ver&atilde;o Skol, cada um composto por 01 (um) bon&eacute; personalizado e 01 (um) ingresso &agrave; casa selecionada.</p>', NULL),
	(16, 'Promoção Bradesco Os Reis do Asfalto', 'promocao-bradesco-os-reis-do-asfalto', '20150901', '20160229', '2016-01-07 13:29:25', '2016-01-07 13:36:40', NULL, 'uploads/promocoes/16_promocao-bradesco.jpg', 'http://www.bradesco.com.br/html/classic/promocoes/reisdoasfalto/', '', 1300000.00, 'Serão 3 sorteios de R$ 150 mil, 1 sorteio de R$ 240 mil  e   1 sorteio de R$ 610 mil.', 'Brasil', 10.00, '<p>Para participar basta concentrar suas compras nos cart&otilde;es participantes Bradesco, efetuando compras de produtos e/ou servi&ccedil;os no valor minimo de R$ 10.00 em territ&oacute;rio nacional utilizando a moeda Real, sendo aceitos entre o per&iacute;odo de 01/09/2015 e 29/02/2016.<br /> <br /> Ser&atilde;o 3 sorteios de R$ 150 mil.<br /> <br /> 1 sorteio de R$ 240 mil.<br /> <br /> 1 sorteio de R$ 610 mil.<br /> <br /> Voc&ecirc; pode consultar seus n&uacute;meros da sorte em &ldquo;Suas Chances&rdquo; at&eacute; 2 dias antes de cada sorteio.<br /> <br /> O REI DO OFF ROAD Sorteio 17/10.<br /> <br /> O REI DO CL&Aacute;SSICO Sorteio 21/11.<br /> <br /> O REI DO ESTILO Sorteio 19/12.<br /> <br /> O REI DA FOR&Ccedil;A Sorteio 23/01.<br /> <br /> O REI DA VELOCIDADE Sorteio 19/03.</p>', NULL),
	(17, 'Promoção Sony Xperia Você na final da Liga dos Campeões da UEFA', 'promocao-sony-xperia-voce-na-final-da-liga-dos-campeoes-da-uefa', '20151026', '20160131', '2016-01-07 15:02:37', '2016-01-07 15:02:37', NULL, 'uploads/promocoes/17_promocao-sony.jpg', 'http://www.promocaosonyxperia.com.br/', 'http://www.promocaosonyxperia.com.br/#regulamento', 315904.40, '10 (dez)  Play Station 4, 5 (cinco) Viagens de Turismo para Milão, Itália, 360 (trezentos e sessenta) brindes de Camisas oficiais do clube UEFA Champions league e 100 (cem) Headphones MDR-XB450 Sony.', 'Brasil', 494.10, 'Para participar da promoção  o consumidor deverá, adquirir um Smartphone participante, instalar no aparelho o aplicativo da promoção – “Promoção Sony Xperia”, disponível em Google Play, gratuitamente. Caso não seja cadastrado na Google Play deverá informar nome completo, CPF, telefone e e-mail.\r\n\r\nO participante devera guardar consigo a nota fiscal de aquisição do produto.\r\n\r\nSerão realizados 3 sorteios no período da promoção.\r\n\r\n	\r\n1  Participação de   26/10/2015 a 27/11/2015    Sorteio ocorrerá na data de    28/11/2015.	\r\n2  Participação de   28/11/2015 a 31/12/2015    Sorteio ocorrerá na data de	   02/01/2016.\r\n3  Participação de   01/01/2016 a 31/01/2016    Sorteio ocorrerá na data de	   03/02/2016.\r\n\r\nCada um dos 10 (dez) contemplados nos sorteios 1 e 2 receberá como prêmio 1 (um) Play Station 4.\r\n\r\nCada um dos 5 (cinco) contemplados no sorteio 3 receberá como prêmio uma viagem de turismo, com direito a assistir a final da UEFA Champions League, em Milão, na Itália, com direito a 01 acompanhante. 	O pacote de viagem será de 3 (três) dias e 2 (duas) noites e será realizado, preferencialmente em período que abranja a data da final da Liga dos Campeões da Europa, a realizar-se em 28.05.2016. As acomodações são por 2 (duas) noites em hotel padrão, em quarto duplo. incluindo café da manhã. As demais refeições serão custeadas pela empresa Promotora por meio de um cartão pré-pago no valor total de U$ 200 (duzentos dólares) por dia por pessoa. A viagem incluirá passagens aéreas, de ida e volta, em classe econômica, para a cidade de destino, incluindo as taxas de embarque, os traslados necessários de ida e volta da residência dos contemplados e hotéis para aeroportos (ainda que não exclusivos).\r\n\r\nSerão ainda 360 (trezentos e sessenta) brindes de Camisas oficiais do clube UEFA Champions league + 100 (cem) brindes Headphones MDR-XB450 Sony.', NULL),
	(18, 'Promoção  Itatiaia  Você merece uma casa nova ', 'promocao-itatiaia-voce-merece-uma-casa-nova', '20151103', '20160226', '2016-01-07 15:29:19', '2016-01-08 23:25:06', NULL, 'uploads/promocoes/18_promocao-itatiaia.jpg', 'http://www.vocemereceitatiaia.com.br/', 'http://www.vocemereceitatiaia.com.br/regulamento/', 21416150.00, '15 (quinze) Fogões Itatiaia, 5 Bocas, Dream, Acendimento Automático, Inox, Bivolt e 01 (um) Certificado em barra de ouro, com sugestão de utilização para aquisição de uma casa.', 'Brasil', 31900.00, '<p>Para participar da Promo&ccedil;&atilde;o, o consumidor dever&aacute; realizar a compra de produtos objetos da Promo&ccedil;&atilde;o, mediante a emiss&atilde;o da nota fiscal eletr&ocirc;nica, acessar o site www.vocemereceitatiaia.com.br, seguindo os procedimentos de inscri&ccedil;&atilde;o que aparecem na tela, onde estar&atilde;o dispon&iacute;veis o Regulamento da Promo&ccedil;&atilde;o e a ficha de inscri&ccedil;&atilde;o a ser preenchida com os dados pessoais que permitam sua clara identifica&ccedil;&atilde;o e r&aacute;pida localiza&ccedil;&atilde;o (nome e endere&ccedil;o completos, sexo, CPF, RG, data de nascimento, telefone fixo, telefone celular, endere&ccedil;o de e-mail).</p>\r\n<p>Em seguida, o consumidor dever&aacute; cadastrar os dados da compra (CNPJ da loja onde realizou a compra, o n&uacute;mero da nota fiscal eletr&ocirc;nica, a data da compra e o produto adquirido), inserindo-os nos campos indicados e, ainda criar um login e uma senha que permitir&aacute; o acesso &agrave; sua inscri&ccedil;&atilde;o para inserir novos dados de compra durante o per&iacute;odo da Promo&ccedil;&atilde;o.</p>\r\n<p>Para completar sua inscri&ccedil;&atilde;o, o consumidor dever&aacute;, ainda, responder a seguinte pergunta de qualifica&ccedil;&atilde;o: "Que marca de cozinhas que toda casa merece?".Os participantes dever&atilde;o guardar as notas fiscais eletr&ocirc;nicas dos produtos cadastrados na promo&ccedil;&atilde;o.</p>\r\n<p><br />Ser&atilde;o v&aacute;lidas as inscri&ccedil;&otilde;es conclu&iacute;das at&eacute; data do dia 31/01/2016.</p>\r\n<p>Ser&atilde;o realizados 4 apura&ccedil;&otilde;es durante o per&iacute;odo de 03/11/2015 a 26/02/2016.</p>\r\n<p>1&ordf; apura&ccedil;&atilde;o dia 15/12/2015, para participa&ccedil;&otilde;es de 03/11/2015 a 30/11/2015.</p>\r\n<p>2&ordf; apura&ccedil;&atilde;o dia 15/01/2015, para participa&ccedil;&otilde;es de 01/12/2015 a 31/12/2015.</p>\r\n<p>3&ordf; apura&ccedil;&atilde;o dia 15/02/2015, para participa&ccedil;&otilde;es de 01/01/2016 a 31/01/2016.</p>\r\n<p>4&ordf; apura&ccedil;&atilde;o dia 26/02/2016, para participa&ccedil;&otilde;es de 03/11/2015 a 31/01/2016.</p>\r\n<p>01 (um) Certificado em barra de ouro, no valor de R$ 200.000,00 (duzentos mil reais), com sugest&atilde;o de utiliza&ccedil;&atilde;o para aquisi&ccedil;&atilde;o de uma casa.</p>\r\n<p>15 (quinze) Fog&otilde;es Itatiaia, 5 Bocas, Dream, Acendimento Autom&aacute;tico, Inox, Bivolt.</p>', 'publicado');
/*!40000 ALTER TABLE `promocoes` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.promocoes_lojistas
CREATE TABLE IF NOT EXISTS `promocoes_lojistas` (
  `prom_id` int(10) unsigned NOT NULL,
  `loji_id` int(10) unsigned NOT NULL,
  KEY `promocoes_lojistas_prom_id_foreign` (`prom_id`),
  KEY `promocoes_lojistas_loji_id_foreign` (`loji_id`),
  CONSTRAINT `promocoes_lojistas_loji_id_foreign` FOREIGN KEY (`loji_id`) REFERENCES `lojistas` (`id`),
  CONSTRAINT `promocoes_lojistas_prom_id_foreign` FOREIGN KEY (`prom_id`) REFERENCES `promocoes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.promocoes_lojistas: ~0 rows (approximately)
/*!40000 ALTER TABLE `promocoes_lojistas` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocoes_lojistas` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.promocoes_premios
CREATE TABLE IF NOT EXISTS `promocoes_premios` (
  `prom_id` int(10) unsigned NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  KEY `FK_promocoes_premios_promocoes` (`prom_id`),
  CONSTRAINT `FK_promocoes_premios_promocoes` FOREIGN KEY (`prom_id`) REFERENCES `promocoes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.promocoes_premios: ~0 rows (approximately)
/*!40000 ALTER TABLE `promocoes_premios` DISABLE KEYS */;
INSERT IGNORE INTO `promocoes_premios` (`prom_id`, `updated_at`, `created_at`, `nome`, `descricao`, `valor`) VALUES
	(18, '2016-01-09 00:15:39', '2016-01-09 00:15:39', '1', 'sdsd', 10.00),
	(18, '2016-01-09 00:16:16', '2016-01-09 00:16:16', '24', '24', 24.00),
	(18, '2016-01-09 00:17:03', '2016-01-09 00:17:03', '', '24', 24.00),
	(18, '2016-01-09 00:18:04', '2016-01-09 00:18:04', '', '24', 24.00);
/*!40000 ALTER TABLE `promocoes_premios` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.promocoes_produtos
CREATE TABLE IF NOT EXISTS `promocoes_produtos` (
  `prom_id` int(10) unsigned NOT NULL,
  `prod_id` int(10) unsigned NOT NULL,
  KEY `promocoes_produtos_prom_id_foreign` (`prom_id`),
  KEY `promocoes_produtos_prod_id_foreign` (`prod_id`),
  CONSTRAINT `promocoes_produtos_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `produtos` (`id`),
  CONSTRAINT `promocoes_produtos_prom_id_foreign` FOREIGN KEY (`prom_id`) REFERENCES `promocoes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.promocoes_produtos: ~0 rows (approximately)
/*!40000 ALTER TABLE `promocoes_produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocoes_produtos` ENABLE KEYS */;


-- Dumping structure for table mundopremiado.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table mundopremiado.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Jessyka', 'jessyka@mundopremiado.com.br', '$2y$10$U/m5qYI2nx9AWT3qht3YPupJ5tBWdq.STFt7cOR/kkpnEh6wgniWC', 'mstNDUysfsEoybwUarVJvzviNCT6U9r3jHQMq4QJmC15ttN8ZnnCum6NHkxa', '0000-00-00 00:00:00', '2016-01-06 16:44:00'),
	(2, 'Fabiano', 'atendimento@mundopremiado.com.br', '$2y$10$dBLrK/l11w3/mEMxDfjNou5e5y5ZxM6YLDEbWEn5v.79Xf93XAaqW', 'PaMuVHVBIIYZCMnFdNQAvEsrULd09KrJ0qhmn9H0i8kF3YaDx9yBrsTjD6bL', '0000-00-00 00:00:00', '2016-01-05 17:54:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
