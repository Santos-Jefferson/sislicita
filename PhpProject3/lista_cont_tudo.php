<?php
require "conecta.php";
require_once "cabecalho_reduzido.php";
require_once "cabecalho_lote.php";
include "css.php";
include "lib_datas.php";


//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data_ass_cont';

$sql_gar = "SELECT prazo_gar,mod_gar,data_exp
                FROM contrato,notaempenho,expedicao
                    WHERE expedicao.id_ne = notaempenho.id_ne
                        AND notaempenho.id_lote = {$_GET[id_lote]}
                        AND contrato.id_lote = {$_GET[id_lote]} ";
                        
    
$sql = "SELECT *
            FROM contrato
                WHERE id_lote = {$_GET[id_lote]}
                    ORDER BY {$_GET[order]}";

$res = mysql_query($sql) or die("Erro seleção linha");
$res_gar = mysql_query($sql_gar) or die("Erro seleção linha_gar");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);
$linha_gar = mysql_fetch_assoc($res_gar);

//echo $linha_gar[data_exp];
//echo $linha_gar[prazo_gar];

?>

<table align="center" class="A" border="0" width="1010">
<table align="center" class="A" width="1010" border="1" cellpadding="3" cellspacing="0">
  <table align="center" class="A" width="1010" border="1" cellpadding="3" cellspacing="0">
   
   
      <tr>
          <td width="150">
              <b>DATA ASSINATURA:
          </td>
          <td width="" align="left">
              <?php
              $data = $linha[data_ass_cont];
              if (!isset($linha[data_ass_cont]))
                  echo " ";
              else echo date('d/m/Y', strtotime($data));
              ?>
              
          </td>
      </tr>
      <tr>
          <td>
              <b>NÚMERO CONTRATO:
          </td>
          <td align="left">
              <?php echo $linha[num_cont];
              if (isset($linha[id_contrato]))
              {
                  echo "<a href='altera_contrato.php?alterar=$linha[id_contrato]&codigo=$_GET[codigo]&lote=$_GET[lote]&orgao=$_GET[orgao]&data=$_GET[data]&hora=$_GET[hora]&licitante=$_GET[licitante]&id_lote=$_GET[id_lote]&id_itens=$linha[id_itens]&id_cod=$_GET[id_cod]'><img src='imagens/edit.png' border='0'/></a>";
              }
              ?>
              
          </td>
      </tr>
      
      <tr>
          <td>
              <b>PRAZO DE GARANTIA:
          </td>
          <td align="left">
              <?php 
                    if (!isset($linha[prazo_gar]))
                        echo " ";
                    else echo $linha[prazo_gar]." "."Meses"." ".$linha[mod_gar];?>
          </td>
      </tr>
      
      <tr>
          <td>
              <b>VIGÊNCIA DA GARANTIA:
          </td>
          <td align="left">
              <?php
                    if(!isset($linha_gar[data_exp])){
                        echo "Aguardar Data de Expedição";
                    }
                    else{
              
                        $vigencia_garantia = SomarData($linha_gar[data_exp],0,$linha[prazo_gar],0);
                        if ($vigencia_garantia >= date('Y/m/d'))
                        {
                            //echo date('d/m/Y');
                            echo date('d/m/Y', strtotime($vigencia_garantia))." - "."EM GARANTIA";
                        }
                        else if (!isset($linha[data_ass_cont]))
                        {
                            echo " ";
                        }
                        else
                        {
                            //echo date('d/m/Y');
                            echo date('d/m/Y', strtotime($vigencia_garantia))." - "."GARANTIA VENCIDA";
                        }
                    }
                ?>
              
          </td>
      </tr>
      
      <tr>
          <td>
              <b>VALE COMO EMPENHO:
          </td>
          <td align="left">
              <?php if ($linha[vale_emp] == "Não")
                    {
                        echo $linha[vale_emp]." - "."<b>Aguardar chegada do empenho";
                    }
                        else if ($linha[vale_emp] == "Sim")
                        {
                            echo $linha[vale_emp]." - "."<b>Cadastrar contrato como empenho no SISLICITA";
                        }
                        else echo " ";
                         
                                
                            
                       
                ?>
          </td>
      </tr>
      
      
  </table>
   
    