# Validador de CNPJ 2026

A Receita Federal do Brasil lançou um novo padrão de numeração de CNPJ que passará a ser Alfanumérico, conforme informações no portal:

https://www.gov.br/receitafederal/pt-br/acesso-a-informacao/acoes-e-programas/programas-e-atividades/cnpj-alfanumerico

e informações contidas no PDF:

https://www.gov.br/receitafederal/pt-br/centrais-de-conteudo/publicacoes/perguntas-e-respostas/cnpj/cnpj-alfanumerico.pdf

---

## Documentação

Conforme documentação técnica disponível no endereço:

https://www.gov.br/receitafederal/pt-br/centrais-de-conteudo/publicacoes/documentos-tecnicos/cnpj/manual-dv-cnpj.pdf/@@display-file

Foi realizado a transformação do fluxograma em um algoritmo que recebe como parametro uma String com ou sem pontos, traço e barra, realiza o cálculo e retorna se o CNPJ é válido ou não.


## Fluxograma

### 1.Cálculo dos dígitos verificadores
O CNPJ alfanumérico é composto por doze caracteres alfanuméricos e dois dígitos verificadores numéricos.
Os dígitos verificadores (DV) são calculados a parƟr dos doze primeiros caracteres em duas
etapas, uƟlizando o módulo de divisão 11 e pesos distribuídos de 2 a 9.
#### 1.1. Cálculo do primeiro dígito verificador
Para cada um dos caracteres do CNPJ, atribuir o valor da coluna “Valor para cálculo do DV”,
conforme a tabela abaixo (ou subtrair 48 do “Valor ASCII”):

Distribuir os pesos de 2 a 9 da direita para a esquerda (recomeçando depois do oitavo caracter),
conforme o exemplo:
| CNPJ | 1 | 2 | A | B | C | 3 | 4 | 5 | 0 | 1 | D | E |
|--|--|--|--|--|--|--|--|--|--|--|--|--|
|Valor | 1 | 2 | 17 | 18 | 19 | 3 | 4 | 5 | 0 | 1 | 20 | 21 |
|Peso | 5 | 4 | 3 | 2 | 9 | 8 | 7 | 6 | 5 | 4 | 3 | 2 |

Multiplicar valor e peso de cada coluna e somar todos os resultados:
|CNPJ | 1 | 2 | A | B | C | 3 | 4 | 5 | 0 | 1 | D | E |
|--|--|--|--|--|--|--|--|--|--|--|--|--|
|Valor | 1 | 2 | 17 | 18 | 19 | 3 | 4 | 5 | 0 | 1 | 20 | 21 |
|Peso | 5 | 4 | 3 | 2 | 9 | 8 | 7 | 6 | 5 | 4 | 3 | 2 |
|Multiplicação | 5 | 8 | 51 | 36 | 171 | 24 | 28 | 30 | 0 | 4 | 60 | 42 |

Somatório (5+8+...+42) = 459

Obter o resto da divisão do somatório por 11.
Se o resto da divisão for igual a 1 ou 0, o primeiro dígito será igual a 0 (zero).
Senão, o primeiro dígito será igual ao resultado de 11 – resto. 


No exemplo:
Resto da divisão 459/11 = 8.
-> 1º DV = 3 (resultado de 11-8)
#### 1.2. Cálculo do segundo dígito verificador
Para o cálculo do segundo dígito é necessário acrescentar o primeiro DV ao final do CNPJ,
formando assim treze caracteres, e repeƟr os passos realizados para o primeiro dígito.
Assim, no exemplo, temos:

|CNPJ | 1 | 2 | A | B | C | 3 | 4 | 5 | 0 | 1 | D | E | 3 |
|--|--|--|--|--|--|--|--|--|--|--|--|--|--|
|Atr. Valor | 1 | 2 | 17 | 18 | 19 | 3 | 4 | 5 | 0 | 1 | 20 | 21 | 3 |
|Atr. Peso | 6 | 5 | 4 | 3 | 2 | 9 | 8 | 7 | 6 | 5 | 4 | 3 | 2 |
 |Multiplicação | 6 | 10 | 68 | 54 | 38 | 27 | 32 | 35 | 0 | 5 | 80 | 63 | 6 |

Somatório (6+10+...+6) = 424

Resto da divisão 424/11 = 6

-> 2º DV = 5 (resultado de 11-6)

-> Resultado final: 12.ABC.345/01DE-35
