<html>
	<head>
		<meta charset="UTF-8">
		<TITLE>Mundo Premiado - Sorteios e Promoções</TITLE>
		<META NAME="DESCRIPTION" CONTENT="">
		<META NAME="ABSTRACT" CONTENT="">
		<META NAME="KEYWORDS" CONTENT="Sorteios, promoções, prêmios">
		<META NAME="ROBOT" CONTENT="All">
		<META NAME="RATING" CONTENT="general">
		<META NAME="DISTRIBUTION" CONTENT="global">
		<META NAME="LANGUAGE" CONTENT="PT">
	</head>
	<body>
		<style>
			*{
				text-rendering: optimizelegibility;
				line-height: 1;
				margin-top: 0px;
				font-family: "Open Sans",sans-serif;
			}

			body{
				vertical-align:middle;
				text-align: center;
			}
			
			.conteudo{

				position: absolute;
				top: 50%;
				transform: translateY(-50%);
				right: 0;
				left: 0;
			}
		</style>

		<div class="conteudo">
			<h1>www.mundopremiado.com.br!</h1>
			
			<?php
			
			function getIp()
			{
			 
				if (!empty($_SERVER['HTTP_CLIENT_IP']))
				{
			 
					$ip = $_SERVER['HTTP_CLIENT_IP'];
			 
				}
				elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				{
			 
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			 
				}
				else{
			 
					$ip = $_SERVER['REMOTE_ADDR'];
			 
				}
			 
				return $ip;
			 
			}

			?>
		</div>
		
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-70681969-1', 'auto');
		  ga('send', 'pageview');

		</script>
	</body>
</html>
