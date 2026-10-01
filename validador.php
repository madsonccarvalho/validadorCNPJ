<?php

function validaCNPJ($cnpj) {
	$cnpj = preg_replace('/[^A-Z0-9]/', '', (string) $cnpj);
	
	$cnpj_2026 = false;
	// Verifica se o CNPJ é padrão novo ou antigo
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
		$cnpj_2026 ? $valor = (ord($cnpj[$i])-48) : $valor = $cnpj[$i];
		$soma += $valor * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}

	$resto = $soma % 11;

	if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
		return false;

	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$cnpj_2026 ? $valor = (ord($cnpj[$i])-48) : $valor = $cnpj[$i];
		$soma += $valor * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}

	$resto = $soma % 11;

	return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}

function formataCNPJ($cnpj) {
	$cnpj = preg_replace('/[^A-Z0-9]/', '', (string) $cnpj);
	return substr($cnpj, 0, 2) . "." . substr($cnpj, 2, 3) . "." . substr($cnpj, 5, 3) . "/" . substr($cnpj, 8, 4) . "-" . substr($cnpj, 12, 2);
}
