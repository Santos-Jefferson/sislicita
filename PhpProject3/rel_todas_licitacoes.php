<?php

require "conecta.php";
require "css.php";
require "cabecalho_reduzido.php";
require "cabecalho_lote.php";

if(empty($_GET[order])) $_GET[order] = 'data';
if(empty($_GET[ascdesc])) $_GET[ascdesc] = 'DESC';

$res = mysql_query("select codigo,pregao,orgao,data,colocacao,tipo_equip,qtde from codigo,lote,itens2,subitens2
                        where codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote and itens2.id_itens=subitens2.id_item
                            and colocacao!='Pgto Efetuado' and colocacao!='A Receber Pgto' and colocacao!='Em Expedição' and colocacao!='Arquivado'
                            and colocacao!='Desclassificado' and colocacao!='Docs Reprovados' and colocacao!='Descl. Neg. Pregoeiro' and colocacao!='Cancelada/Suspensa'
                            and colocacao!='Rescindido contrato/ata' and colocacao!='' and data>'2012-01-01'
                                    group by itens2.id_itens
                                        order by {$_GET[order]} {$_GET[ascdesc]};"
); /*Executa o comando SQL, no caso para pegar todos os usuarios do sistema e retorna o valor da consulta em uma variavel ($res)  */

echo "<table width='1010' border='1' class='A' align='center'><tr><td align='center'><b>Código/UASG</td><td align='center'><b>Órgão</td><td align='center'><b>Pregão</td><td align='center'><a href='rel_todas_licitacoes.php?order=data&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Data<a href='rel_todas_licitacoes.php?order=data&ascdesc=ASC'><img src='imagens/baixo.png'></a></td><td align='center'><a href='rel_todas_licitacoes.php?order=colocacao&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Colocação<a href='rel_todas_licitacoes.php?order=colocacao&ascdesc=ASC'><img src='imagens/baixo.png'></a></td><td align='center'><b>Tipo Equip.</td><td align='center'><a href='rel_todas_licitacoes.php?order=qtde&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Qtde<a href='rel_todas_licitacoes.php?order=qtde&ascdesc=ASC'><img src='imagens/baixo.png'></a></td></tr>";

/*Enquanto houver dados na tabela para serem mostrados será executado tudo que esta dentro do while */
while($escrever=mysql_fetch_array($res)){

/*Escreve cada linha da tabela*/
echo "<tr><td>" . $escrever['codigo'] . "</td><td>" . $escrever['orgao'] . "</td><td>" . $escrever['pregao'] . "</td><td>" . $escrever['data'] . "</td><td>" . $escrever['colocacao'] . "</td><td>" . $escrever['tipo_equip'] . "</td><td>" . $escrever['qtde'] . "</td></tr>";

}/*Fim do while*/

echo "</table>"; /*fecha a tabela apos termino de impressão das linhas*/

?>

</body>
</html>