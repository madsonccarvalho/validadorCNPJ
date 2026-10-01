<?php
require_once 'validador.php';

$resultadoMensagem = '';
$cnpjInput = '';

if (isset($_GET['cnpj'])) {
    $cnpjInput = $_GET['cnpj'];
    $result = validaCNPJ($cnpjInput);
    $cnpj_formatado = formataCNPJ($cnpjInput);
    
    $resultadoMensagem = ($result == 1) ? "<b>CNPJ: " . htmlspecialchars($cnpj_formatado) . " Válido</b>" : "<b>CNPJ Inválido</b>";
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
    <meta name="theme-color" content="#7952b3">

    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/cover/cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <main class="px-3">
    <h1>Validador de CNPJ</h1><br/>
	<form action="index.php" method="GET">
	  <div class="input-group input-group-lg">
	    <input type="text" class="form-control" name="cnpj" value="<?= htmlspecialchars($cnpjInput) ?>" placeholder="Digite aqui" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        <input type="submit" class="btn btn-lg btn-secondary fw-bold border-black bg-blue" value="Validar:">
	  </div>
	</form>
	<p class="lead">
	<pre style="text-align: left;">

<?= $resultadoMensagem ?>
	</pre>
	</p>
  </main>

  <footer class="mt-auto text-white-50">
    <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
  </footer>

</div>
  </body>
</html>
