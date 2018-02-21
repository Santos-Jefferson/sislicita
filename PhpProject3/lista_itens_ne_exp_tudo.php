<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
include "css.php";



//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'item';
    
$sql = "SELECT * FROM itens WHERE id_lote = {$_GET[id_lote]} order by {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);


$sql_coloc = "SELECT * FROM lote WHERE id_lote = {$_GET[id_lote]}";

$res_coloc = mysql_query($sql_coloc) or die("Erro seleção colocacao");

//pega a primeira linha do resultado
$linha_coloc = mysql_fetch_assoc($res_coloc);

//print_r ($_REQUEST);
//require_once "pes_rapida_cad_tudo.php";


//require "tab_cab_itens_tudo.php";
?>



<br>
  <table align="center" class="A" width="" border="1" cellpadding="3" cellspacing="0">
      
      
      
  <tr align="center" class="forms">
    <th width="20" >Qtde</th>
    <th colspan="10" >Descrição do Item</th>
    <th width="20" >Fornecedor</th>
    <th width="20" >Transportadora</th>
    <th width="20" >V. Frete(R$)</th>
    <th width="20" >Data Expedição</th>
    
  </tr>
<?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    $ca += $linha[custo_aprox];    //incrementa a $v o campo valor
    $ll += $linha[lucro_liq];    //incrementa a $v o campo valor
    $vo += $linha[vofertado];    //incrementa a $v o campo valor
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
    
   

    
               <td><input type="text" name="qtde_emp" size="8" maxlength="8"value="<?php echo $_POST[qtde_emp]; ?>">
                    <?php 
                        //if ($erro_qtde_emp){
                          //  echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        //}
                        //echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
    <td colspan="10">&nbsp;<?php
    
    
                            $sql2 = "SELECT * FROM subitens WHERE id_item = $linha[id_itens]";
                            $res2 = mysql_query($sql2) or die("Erro seleção linha2");
                            $linha2 = mysql_fetch_assoc($res2);
                            
                            if (empty($linha2[id_subitem])) 
                                echo "$linha[nome_item] MARCA: $linha[marca_item] / MODELO: $linha[modelo_item] / $linha[produto]";
                            else{
                            
                                while($linha2){
                            
                                    echo "$linha2[qtde_si]-$linha2[sub_itens] MARCA: $linha2[marca_si] / MODELO: $linha2[modelo_si], ";
                                    
                                    $linha2 = mysql_fetch_assoc($res2);
                                    }
                            }
                                    ?>
    </td>
     <td><input type="text" name="forn_exp" size="8" maxlength="100"value="<?php echo $_POST[forn_exp]; ?>">
                    <?php 
                        //if ($erro_qtde_emp){
                          //  echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        //}
                        //echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
                <td><input type="text" name="transportadora_exp" size="8" maxlength="100"value="<?php echo $_POST[transportadora_exp]; ?>">
                    <?php 
                        //if ($erro_qtde_emp){
                          //  echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        //}
                        //echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
                <td><input type="text" name="vfrete_exp" size="8" maxlength="100"value="<?php echo $_POST[vfrete_exp]; ?>">
                    <?php 
                        //if ($erro_qtde_emp){
                          //  echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        //}
                        //echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
                <td><input type="text" name="data_exp" size="8" maxlength="8" onkeyup="Formatadata(this,event)" value="<?php echo $_POST[data_exp]; ?>">
                    <?php 
                        if ($erro_data_exp){
                            echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        }
                        //echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
</tr>




  <tr align="center">
    
    
    
    
  
    <!--<td><input type='button' value='Excluir'
               onclick='document.location.href="conf_itens_exc.php?apagar=<?php //echo $linha[item]; ?>"'>
    </td>-->
    
  </tr>
  
  
  <?php
//require "tab_cont_itens_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}



//require_once "rel_licita.php";

//echo '<br>';
?>
  
  
 
  </table>
  <br><br>

