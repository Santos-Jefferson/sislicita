<?php

require "conecta.php";
require "css.php";
require "cabecalho_html.php";

if(empty($_GET[order])) $_GET[order] = 'data';
if(empty($_GET[ascdesc])) $_GET[ascdesc] = 'DESC';

$res = mysql_query("select codigo,lote,pregao,orgao,data,colocacao,local_licitacao,tipo_equip,qtde,licitante from codigo,lote,itens2
                        where codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote
                            and itens2.ro_item='Sim'
                                and colocacao!='Pgto Efetuado' and colocacao!='A Receber Pgto' and colocacao!='Em Expedição' and colocacao!='Arquivado' and colocacao!='' and data>'2013-01-01'
                                    group by itens2.id_itens                                  
                                        order by {$_GET[order]} {$_GET[ascdesc]};"
); /*Executa o comando SQL, no caso para pegar todos os usuarios do sistema e retorna o valor da consulta em uma variavel ($res)  */

echo "<table width='1010' border='1' class='A' align='center'><tr><td align='center'><a href='rel_ro_positivo.php?order=codigo&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Codigo/Uasg<a href='rel_ro_positivo.php?order=codigo&ascdesc=ASC'><img src='imagens/baixo.png'></a></td><td align='center'><b>Órgão</td><td align='center'><a href='rel_ro_positivo.php?order=pregao&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Pregão<a href='rel_ro_positivo.php?order=pregao&ascdesc=ASC'><img src='imagens/baixo.png'></a></td><td align='center'><a href='rel_ro_positivo.php?order=data&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Data<a href='rel_ro_positivo.php?order=data&ascdesc=ASC'><img src='imagens/baixo.png'></a></td><td align='center'><a href='rel_ro_positivo.php?order=colocacao&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Colocação<a href='rel_ro_positivo.php?order=colocacao&ascdesc=ASC'><img src='imagens/baixo.png'></a></td><td align='center'><b>Tipo Equip.</td><td align='center'><a href='rel_ro_positivo.php?order=qtde&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Qtde<a href='rel_ro_positivo.php?order=qtde&ascdesc=ASC'><img src='imagens/baixo.png'></a></td><td align='center'><a href='rel_ro_positivo.php?order=licitante&ascdesc=DESC'><img src='imagens/cima.png'></a><b>Licitante<a href='rel_ro_positivo.php?order=licitante&ascdesc=ASC'><img src='imagens/baixo.png'></a></td></tr>";

/*Enquanto houver dados na tabela para serem mostrados será executado tudo que esta dentro do while */
while($escrever=mysql_fetch_array($res)){

/*Escreve cada linha da tabela*/
echo "<tr><td>" . $escrever['codigo'] .'-'. $escrever['local_licitacao'] . "</td><td>" . $escrever['orgao'] . "</td><td>" . $escrever['pregao'] . "</td><td>" . $escrever['data'] . "</td><td>" . $escrever['colocacao'] . "</td><td>" . $escrever['tipo_equip'] . "</td><td>" . $escrever['qtde'] . "</td><td>" . $escrever['licitante'] . "</td></tr>";

}/*Fim do while*/

echo "</table>"; /*fecha a tabela apos termino de impressão das linhas*/

?>

</body>
</html>