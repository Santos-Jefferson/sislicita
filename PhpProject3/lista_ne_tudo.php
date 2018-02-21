<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
include "css.php";
include "lib_datas.php";


//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data_rec_ne';
    
$sql = "SELECT * FROM notaempenho WHERE id_lote = {$_GET[id_lote]} order by {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);
?>

<br>
<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
  <table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
   
   
      <tr>
          <td>
              PRAZO ENTREGA:
          </td>
          <td align="right">
              <?php echo $linha[prazo_ent_ne];?>
          </td>
      </tr>
      <tr>
          <td>
              DATA PROPOSTA:
          </td>
          <td align="right">
              <?php
            
                    if ((empty($linha[data_proposta])) or ($linha[data_proposta]=="0000-00-00")){
                        echo "";
                    }
                        else{
                            echo date('d/m/Y', strtotime($linha[data_proposta]));
                        }
            
            
            ?>
              
          </td>
      </tr>
      <tr>
          <td>
              VALIDADE PROPOSTA:
          </td>
          <td align="right">
              <?php echo $linha[val_proposta];?>
          </td>
      </tr>
      <tr>
          <td>
              DATA PREV. PGTO NE:
          </td>
          <td align="right">
              <?php echo $linha[data_prev_pgto];?>
          </td>
      </tr>    
  <tr align="center" class="forms">
    <th width="" >Previsão Entrega</th>
    <th width="" >Proposta valida?</th>
    <th colspan="" >Número da NE</th>
    <th colspan="" >Expedição</th>
    <th colspan="" >Financeiro</th>
    <th colspan="" >Status</th>
    <th colspan="" >Ação</th>
        
</tr>

   <?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    //$ca += $linha[custo_aprox];    //incrementa a $v o campo valor
    //$ll += $linha[lucro_liq];    //incrementa a $v o campo valor
    //$vo += $linha[vofertado];    //incrementa a $v o campo valor
    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    //$vmo += $linha[vminofertar];    //incrementa a $v o campo valor

    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"

?>

<tr align="center">
    
   
    <td>&nbsp;<?php
                    
                    $data_inicial = $linha[data_rec_ne];
                    $nova_data = SomarData($data_inicial,$linha[prazo_ent_ne]);
                    //echo inverte_data($nova_data); 
                    echo date('d/m/Y', strtotime($nova_data));
    
                    //print "$linha[data_rec_ne]";
                    //$nextdate = addDayIntoDate($linha[data_rec_ne],20);
                    //echo date('d/m/Y', strtotime($nextdate));
                    //echo "$_GET[hora]"
                    //print $nextdate."<br>";
                    //echo date('d/m/Y', strtotime($linha[data_rec_ne]));
              ?></td>
    <td>&nbsp;<?php
                    $sql_codigo = "SELECT * FROM codigo WHERE codigo.id_cod = {$_GET[id_cod]}";
                    $res_codigo = mysql_query($sql_codigo) or die("Erro seleção-codigo-atourp");
                    $linha_codigo = mysql_fetch_assoc($res_codigo);
                    //echo $linha_codigo[tipo_licitacao];
                   
                    
                    $data_inicial = SomarData($linha[data_proposta],0);
                    //echo "exibindo data_inicial - ";
                    //print_r ($data_inicial);
                    //echo "<br>";
                    
                    $nova_data = SomarData($data_inicial,$linha[val_proposta]);
                    //echo $nova_data;
                    //echo "exibindo nova_data - ";
                    //print_r ($nova_data);
                    //echo "<br>";
                    
                    $val_proposta = $nova_data;
                    $data_rec_ne = $linha[data_rec_ne];
                    //echo "exibindo data_rec_ne - ";
                    //print_r ($data_rec_ne);
                    //echo "<br>";

                    $data_i = explode('/', $data_rec_ne);
                    //echo "exibindo data_i - ";
                    //print_r ($data_i);
                    //echo "<br>";
                    
                    $data_f = explode('/', $nova_data);
                    //echo "exibindo data_f - ";
                    //print_r ($data_f);
                    //echo "<br>";
                    
                    $data_a = $data_i['2'].$data_i['1'].$data_i['0'];
                    //echo "exibindo data_a - ";
                   // print_r ($data_a);
                    //echo "<br>";
                    
                    $data_b = $data_f['2'].$data_f['1'].$data_f['0'];
                    //echo "exibindo data_b - ";
                    //print_r ($data_b);
                    //echo "<br>";
                    
                    if($data_a < $data_b){
                    echo "DENTRO DO PRAZO - OK";}
                       elseif ($data_a > $data_b and $linha_codigo[tipo_licitacao] == "RP"){
                            echo "DENTRO DO PRAZO - OK";}
                        
                        else
                            echo "FORA DO PRAZO - VERIFICAR";
                        
                    
                    
                    /*
                    if
                        ($nova_data < $linha[data_rec_ne]){
                            echo "FORA DO PRAZO";}
                        else{
                            echo "DENTRO DO PRAZO";
                        }
                    */
                        
                    ?></td>
    
                    <?php
                    
                        $sql_exp = "SELECT * FROM expedicao WHERE expedicao.id_ne = {$linha[id_ne]}";
                        $res_exp = mysql_query($sql_exp) or die("Erro seleção-codigo-atourp");
                        $linha_exp = mysql_fetch_assoc($res_exp);
                    ?>
    
    
    <td>&nbsp;<a href="relatorio_ne_tudo.php?id_cod=<?php echo $_GET[id_cod] ?>&id_lote=<?php echo $_GET[id_lote];?>&num_ne=<?php echo $linha[num_ne]; ?>&id_ne=<?php echo $linha[id_ne]; ?>&vs=<?php echo $_GET[vs]; ?>&vsedex=<?php echo $_GET[vsedex]; ?>" target="popupwindow" onclick='window.open("relatorio_ne_tudo.php", "popupwindow", "scrollbars=yes,width=1040,height=800");return true'><?php echo $linha[num_ne];?></a></td>                           
    <td>&nbsp;
        
        <?php
            if (empty($linha_exp[id_exp])){
                    echo "<a href='cad_ne_exp.php?id_cod=$_GET[id_cod]&id_lote=$_GET[id_lote]&num_ne=$linha[num_ne]&id_ne=$linha[id_ne] target='popupwindow' onclick='window.open('cad_ne_exp.php', 'popupwindow', 'scrollbars=yes,width=700,height=400');return true'><img src='imagens/copiar.png' border='0'/></a>";
            }
            elseif (!empty($linha_exp[id_exp])){
                    echo "<a href='alt_ne_exp.php?id_cod=$_GET[id_cod]&id_lote=$_GET[id_lote]&num_ne=$linha[num_ne]&alterar=$linha_exp[id_exp]&id_ne=$linha[id_ne]' target=popupwindow onclick=window.open(cad_ne_exp.php, popupwindow, scrollbars=yes,width=700,height=400);return true><img src='imagens/edit.png' border='0'/></a>";
                    
            }

        ?>
        
        
        <!--<a href="conf_ne_exp_exc.php?id_cod=<?php //echo $_GET[id_cod] ?>&id_lote=<?php echo $_GET[id_lote];?>&num_ne=<?php echo $linha[num_ne]; ?>&id_ne=<?php echo $linha[id_ne]; ?>" target="popupwindow" onclick='window.open("cad_ne_exp.php", "popupwindow", "scrollbars=yes,width=500,height=300");return true'><img src="imagens/delete.png" border="0"/></a>-->
    
    </td>      
    
    <?php
                    
                        $sql_finan = "SELECT * FROM financeiro WHERE financeiro.id_ne = {$linha[id_ne]}";
                        $res_finan = mysql_query($sql_finan) or die("Erro seleção-codigo-atourp");
                        $linha_finan = mysql_fetch_assoc($res_finan);
                    ?>
    
    <td>&nbsp;
         <?php
            if (empty($linha_finan[id_finan])){
                    echo "<a href='cad_ne_finan.php?id_cod=$_GET[id_cod]&id_lote=$_GET[id_lote]&num_ne=$linha[num_ne]&id_ne=$linha[id_ne]' target='popupwindow' onclick='window.open('cad_ne_exp_qtdes.php', 'popupwindow', 'scrollbars=yes,width=600,height=400');return true'><img src='imagens/copiar.png' border='0'/></a></td>";                           
            }
            elseif (!empty($linha_finan[id_finan])){
                    echo "<a href='alt_ne_finan.php?id_cod=$_GET[id_cod]&id_lote=$_GET[id_lote]&num_ne=$linha[num_ne]&alterar=$linha_finan[id_finan]&id_ne=$linha[id_ne]' target='popupwindow' onclick='window.open('cad_ne_exp_qtdes.php', 'popupwindow', 'scrollbars=yes,width=600,height=400');return true'><img src='imagens/edit.png' border='0'/></a></td>";                           
                    
            }

        ?>
        
        
    <td>
        <?php echo $linha[status_ne];?>
    </td>
    <td>
        <a href="copia_itens_ne.php?id_lote=<?php echo $linha[id_lote]; ?>&id_ne=<?php echo $linha[id_ne];?>&id_cod=<?php echo $_GET[id_cod];?>&id_itens=<?php echo $_REQUEST[id_itens];?>"><img src="imagens/copiar.png" border="0"/></a>
        <a href="cad_itens_ne.php?id_lote=<?php echo $linha[id_lote]; ?>&id_ne=<?php echo $linha[id_ne];?>&num_ne=<?php echo $linha[num_ne];?>&id_cod=<?php echo $_GET[id_cod];?>"><img src="imagens/cadastrar.png" border="0"/></a>
        <a href="altera_ne.php?alterar=<?php echo $linha[id_ne]; ?>&codigo=<?php echo $_GET[codigo]; ?>&lote=<?php echo $_GET[lote]; ?>&orgao=<?php echo $_GET[orgao]; ?>&data=<?php echo $_GET[data]; ?>&hora=<?php echo $_GET[hora]; ?>&licitante=<?php echo $_GET[licitante]; ?>&id_lote=<?php echo $_GET[id_lote]; ?>&id_itens=<?php echo $linha[id_itens]; ?>&id_cod=<?php echo $_GET[id_cod]; ?>"><img src="imagens/edit.png" border="0"/></a>
        <a href="conf_ne_exc.php?apagar=<?php echo $linha[id_ne]; ?>&num_ne=<?php echo $linha[num_ne]; ?>&id_cod=<?php echo $linha_codigo[id_cod]; ?>&id_itens=<?php echo $_REQUEST[id_itens];?>"><img src="imagens/delete.png" border="0"/></a>
        
        
    
        
    
</tr>

  <?php
//require "tab_cont_itens_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}



//require_once "rel_licita.php";

//echo '<br>';
?>
  

    <tr>
        <td colspan="19">Total de notas de empenho: <?php echo $c ?></td>
        
    </tr>
</table><br>
  </table>
  <br><br>
</table>
