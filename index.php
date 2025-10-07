<?php
function validaCNPJ($cnpj) {
	$cnpj = preg_replace('/[^A-Z0-9]/', '', (string) $cnpj);
	
	$cnpj_2026 = false;
	//Verifca se o CNPJ é padrão novo ou antigo
	preg_match('/[^A-Z0-9]+$/i', $cnpj) == 0 ? $cnpj_2026 = true : $cnpj_2026 = false;
	
	// Valida tamanho
	if (strlen($cnpj) != 14)
		return false;

	// Verifica se todos os digitos são iguais
	if (preg_match('/(\d)\1{13}/', $cnpj))
		return false;	

	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		if($cnpj_2026)
		{
			$soma += (ord($cnpj[$i])-48) * $j;
		}
		else{
			$soma += $cnpj[$i] * $j;
		}
		$j = ($j == 2) ? 9 : $j - 1;
	}

	$resto = $soma % 11;

	if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
		return false;

	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		if($cnpj_2026)
		{
			$soma += (ord($cnpj[$i])-48) * $j;
		}
		else{
			$soma += $cnpj[$i] * $j;
		}
		$j = ($j == 2) ? 9 : $j - 1;
	}

	$resto = $soma % 11;

	return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}

function formataCNPJ($cnpj) {
		$cnpj = preg_replace('/[^A-Z0-9]/', '', (string) $cnpj);
        //08.583.284/0001-06
        //08583284000106
        return substr($cnpj, 0, 2) . "." . substr($cnpj, 2, 3) . "." . substr($cnpj, 5, 3) . "/" . substr($cnpj, 8, 4) . "-" . substr($cnpj, 12, 2);
    }


?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Validador de CNPJ">
    <meta name="author" content="CNPJ Validador Online">
    <meta name="generator" content="Validador CNPJ">
    <title>CNPJ Validador</title>

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/examples/cover/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="https://getbootstrap.com/docs/5.0/examples/cover/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="https://getbootstrap.com/docs/5.0/examples/cover/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/examples/cover/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="https://getbootstrap.com/docs/5.0/examples/cover/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/cover/cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <!--<header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Home</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="#">MD5</a>
        <a class="nav-link" href="#">SHA256</a>
        <a class="nav-link" href="#">SHA512</a>
      </nav>
    </div>
  </header>-->
<main class="px-3">
    <h1>Validador de CNPJ</h1><br/>
	<form action="index.php" method="GET">
	  <div class="input-group input-group-lg">
	    <input type="text" class="form-control" name="cnpj" placeholder="Digite aqui" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        <input type="submit" class="btn btn-lg btn-secondary fw-bold border-black bg-blue" value="Validar:">
	  </div>
    </p>
	</form>
	<p class="lead">
	<pre style="text-align: left;">

<?php
if(isset($_GET['cnpj']))
{
	$result = validaCNPJ($_GET['cnpj']);
	$cnpj_formatado = formataCNPJ($_GET['cnpj']);
	
	echo ($result == 1) ? "<b>CNPJ: ".$cnpj_formatado." Válido</b>": "<b>CNPJ Inválido</b>";
}
?>
	</pre>
	</p>
  </main>


  <footer class="mt-auto text-white-50">
    <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
  </footer>

</div>
  </body>
</html>

