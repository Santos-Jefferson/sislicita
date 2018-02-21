<?php
require "conecta.php";
//require_once "cabecalho_reduzido.php";
require "cabecalho_html.php";
//require_once "cabecalho_lote.php";
include "css.php";
include "js_formata_data.php";



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
<table align="center" class="A" border="0" width="">
<table align="center" class="A" width="" border="1" cellpadding="3" cellspacing="0">
    
        
  
  
  
  <table align="center" class="A" width="" border="1" cellpadding="3" cellspacing="0">
      
      <?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $vmo += $linha[vminofertar];    //incrementa a $v o campo valor
    $ca += $linha[custo_aprox];    //incrementa a $v o campo valor
    $ll += $linha[lucro_liq];    //incrementa a $v o campo valor
    $vo += $linha[vofertado];    //incrementa a $v o campo valor
    $vf += $linha[vfrete];    //incrementa a $v o campo valor
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
      
<!--<form action="<?php// if ($erro or empty($_POST)) echo "cad_ne_exp.php";
                            //else echo "grava_cad_ne_exp.php"; ?>" method="POST" name="cad_ne_exp">-->
<form action="<?php echo "grava_cad_ne_qtdes.php"; ?>?id_ne=<?php echo $_GET[id_ne];?>?id_item=<?php echo $_GET[id_item];?>" method="POST" name="cad_ne_exp_qtdes">                            
      
  <tr align="center" class="forms">
    <th width="" >Item</th>
    <th width="" >Qtde</th>
    <th colspan="" >Descrição do Item</th>
    
    
        
</tr>

<tr align="center">
    

    
<td>&nbsp;<?php echo $linha[item] ?>
</td>
    
    <td><input size="5" maxlength="10" type="text" name="qtde_exp[]">
        <input type="hidden" name="id_item[]" value="<?php echo $linha[id_itens];?>">
        <input type="hidden" name="id_ne[]" value="<?php echo $_GET[id_ne];?>">
        
                    <?php echo $_POST[qtde_exp]; ?>
                    <?php 
                        //if ($erro_qtde_emp){
                          //  echo "<font color=red>*** Data inserida erroneamente. Insira novamente</font>";
                        //}
                        //echo "<font color=blue>   Ex.: 25/12/11</font>";
                    ?>
                    
                </td>
    <td colspan="">&nbsp;<?php
    
    
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
  
    <!--<td><input type='button' value='Excluir'
               onclick='document.location.href="conf_itens_exc.php?apagar=<?php //echo $linha[item]; ?>"'>
    </td>-->
    
  
  
  <!--<tr>
      <td colspan="11" bgcolor="black"></td>
  </tr>-->
  <?php
//require "tab_cont_itens_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}



//require_once "rel_licita.php";

//echo '<br>';
/*
if($qtde_exp <> ""){
$cont = count($qtde_exp);

    for($i=0; $i<$cont; $i++){
    if($qtde_exp[$i] == "") continue;
    $sql= "INSERT INTO expedicao_qtdes (qtde_exp,id_item,id_ne) VALUES ('$qtde_exp[$i]','$id_item[$i]','$id_ne[$i]');";
    mysql_query($sql);
    }    
}
*/

?>
  
  
  
</tr>
  

    <tr>
        <td colspan="10" align="left"><input type="submit" value="Cadastrar" /></td>
          </tr>
            
              <!--<td>
                  <input type="hidden" name="id_exp" value="<?php //echo $_POST[id_exp]; ?>">
              </td>-->
          
            
                  <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                //if(!$erro and !empty($_POST)){
                  //  echo '<script language="javascript">document.cad_ne_exp.submit()</script>';
                //}
            
            ?>
            
        </form>  
    
    
    
  


    <tr>
        <td colspan="19">Total de itens: <?php echo $c ?></td>
        
    </tr>
</table><br>
  </table>
  <br><br>
</table>
