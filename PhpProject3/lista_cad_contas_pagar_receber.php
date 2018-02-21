<?php
require "conecta.php";
//require_once "cabecalho_reduzido_sem_teste.php";
//require_once "cabecalho_geral.php";
require_once "cad_contas_pagar_receber.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data_venc';
//if(empty($_GET[ascdesc])) $_GET[ascdesc] = 'ASC';
//if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "SELECT * FROM contas_pagar_receber WHERE obs_contas ='' ORDER BY {$_GET[order]} {$_GET[ascdesc]}";
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha contas");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

?>

<script language="JavaScript">


function abrir(URL) {
 
  var width = 1100;
  var height = 450;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
<table width="1010" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
    <!--</table>-->
<!--<table width="1020" align="center" class="A" border="1" cellpadding="2" cellspacing="0">-->
    <tr class="forms">
            <th colspan="11" bgcolor="yellow" align="center">CONTAS A PAGAR / RECEBER</th>
        </tr>
    <tr>
        <!--<td colspan="2">
            <input type='button' value='Cadastrar Contas' class='botao'
               onclick='document.location.href="cad_contas_pagar_receber.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Relatórios Contas' class='botao'
               onclick='document.location.href="cad_entrada_prod.php"'>
            
        </td>-->
        
        <td colspan="10">
             <form action="lista_cad_contas_filtro.php" method="POST" name="lista_cad_contas_filtro">
                 <b>FILTRAR POR CATEGORIA:
                    <select id="lista_tipo" name="lista_tipo">
                        <?php
            
                            $nome_marca_query="SELECT cat_contas FROM contas_pagar_receber WHERE obs_contas ='' group by cat_contas ORDER BY cat_contas ASC ";
                            $nome_marca_result=mysql_query($nome_marca_query) or die ("Falha ao recuperar o TIPO_PROD da base de dados: ".mysql_error());
                            echo "<option>$_POST[lista_tipo]</option>";

                            while ($nome_marca_row=mysql_fetch_array($nome_marca_result)) {
                            $nome_marca=$nome_marca_row[cat_contas];
                                echo "<option>
                                    $nome_marca
                                </option>";
                            }
                        ?>
                    </select>
            <input type="submit" value="Filtrar" name="filtrar" class='botao' />
            </form>
        </td>
    </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th width="" align="center"><a href="lista_cad_contas_pagar_receber.php?order=data_emissao&ascdesc=DESC"><img src="imagens/cima.png"></a>DATA EM<a href="lista_cad_contas_pagar_receber.php?order=data_emissao&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="" align="center"><a href="lista_cad_contas_pagar_receber.php?order=data_venc&ascdesc=DESC"><img src="imagens/cima.png"></a>DATA VENC<a href="lista_cad_contas_pagar_receber.php?order=data_venc&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="" align="center"><a href="lista_cad_contas_pagar_receber.php?order=num_doc&ascdesc=DESC"><img src="imagens/cima.png"></a>NUM DOC<a href="lista_cad_contas_pagar_receber.php?order=num_doc&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="" align="center"><a href="lista_cad_contas_pagar_receber.php?order=tipo_contas&ascdesc=DESC"><img src="imagens/cima.png"></a>TIPO CONTA<a href="lista_cad_contas_pagar_receber.php?order=tipo_contas&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="" align="center"><a href="lista_cad_contas_pagar_receber.php?order=banco_contas&ascdesc=DESC"><img src="imagens/cima.png"></a>BANCO<a href="lista_cad_contas_pagar_receber.php?order=banco_contas&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="" align="center"><a href="lista_cad_contas_pagar_receber.php?order=desc_contas&ascdesc=DESC"><img src="imagens/cima.png"></a>DESC/HIST<a href="lista_cad_contas_pagar_receber.php?order=desc_contas&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="" align="center"><a href="lista_cad_contas_pagar_receber.php?order=cl_forn_contas&ascdesc=DESC"><img src="imagens/cima.png"></a>CLI/FORN<a href="lista_cad_contas_pagar_receber.php?order=cl_forn_contas&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="" align="center"><a href="lista_cad_contas_pagar_receber.php?order=cat_contas&ascdesc=DESC"><img src="imagens/cima.png"></a>CATEGORIA<a href="lista_cad_contas_pagar_receber.php?order=cat_contas&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="80" align="center"><a href="lista_cad_contas_pagar_receber.php?order=valor_contas&ascdesc=DESC"><img src="imagens/cima.png"></a>VALOR<a href="lista_cad_contas_pagar_receber.php?order=valor_contas&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="55">AÇÃO</th>
        </tr>
        
        <form action="grava_baixa_contas.php" method="post">
<?php
//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    
    if ($linha[valor_contas]<0){
    $vd += $linha[valor_contas];    //incrementa a $v o campo valor
    }
    else{
    $vc += $linha[valor_contas];    //incrementa a $v o campo valor
    }
    $vs += $linha[valor_contas];
    ?>
    
     <tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
         <td align="center">&nbsp;<?php echo date('d/m/Y', strtotime($linha[data_emissao]))                        ?></a></td>
         <td align="center">&nbsp;<?php echo date('d/m/Y', strtotime($linha[data_venc]))                        ?></a></td>
         <td align="center">&nbsp;<?php echo $linha[num_doc]                          ?></a>
         <td align="center" align="left">&nbsp;<?php echo $linha[tipo_contas]                          ?></a>
         <td align="center" align="left">&nbsp;<?php echo $linha[banco_contas]                          ?></a>
         <td align="center">&nbsp;<?php echo $linha[desc_contas]                          ?></a>
         <td align="center">&nbsp;<?php echo $linha[cl_forn_contas]                          ?></a>
         <td align="center">&nbsp;<?php echo $linha[cat_contas]                          ?></a>
         <td align="right">&nbsp;
             <?php
                if ($linha[tipo_op_contas]=="A Receber"){
                    echo "<font color=blue>R$"." ".number_format($linha[valor_contas],2, ',','.');
                    }
                        else{
                            echo "<font color=red>R$"." ".number_format($linha[valor_contas],2, ',','.');
                    
                        }
                
              ?></a>
         
         
             <td align="center" width="40">
                 
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha[licitante]) == ($usuario)){
                
                echo "<a href='altera_contas.php?alterar=$linha[id_contas]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_contas_exc.php?apagar=$linha[id_contas]&desc_contas=$linha[desc_contas]'><img src='imagens/delete.png' border='0'/></a>";
                echo "<a href='conf_contas_exc.php?apagar=$linha[id_contas]&desc_contas=$linha[desc_contas]'><img src='imagens/delete.png' border='0'/></a>";
                
            }
            
            elseif (($usuario == "admin") or ($usuario == "adm")){
                echo "<a href='altera_contas.php?alterar=$linha[id_contas]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_contas_exc.php?apagar=$linha[id_contas]&desc_contas=$linha[desc_contas]'><img src='imagens/delete.png' border='0'/></a>";
                echo "<input type=checkbox name='baixa_contas[]' value='$linha[id_contas]'>";
                
            }
            ?>
        
        </td>
        
               
        
                             
         
            
            
            <!--&nbsp;<input type='button' value='Alterar'
               onclick='document.location.href="altera_licita.php?alterar=<?php //echo $linha[id_cod]; ?>"'> / 
                                 <input type='button' value='Excluir'
               onclick='document.location.href="conf_licita_exc.php?apagar=<?php //echo $linha[id_cod]; ?>&codigo=<?php// echo $linha[codigo];?>"'>
        </td>-->
 </tr>
<?php

        

    
    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"


//require "tab_cont_lotes_tudo.php";

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);
}
//echo '<br>';
//require_once "rel_licita.php";
?>
    <tr>
        <td colspan="6"></td>
        <td colspan="2" align="right"><font color='blue'>A Receber: <?php echo "R$"." ".number_format($vc,2, ',','.');?></td>
    </tr>
    <tr>
        <td colspan="6"></td>
        <td colspan="2" align="right"><font color='red'>A Pagar: <?php echo "R$"." ".number_format($vd,2, ',','.');?></td>
    </tr>
    <tr>
        <td colspan="6"></td>
        <td colspan="2" align="right"><b>Saldo: <?php if ($vs<0){
                                                    echo "<font color='red'>R$"." ".number_format($vs,2, ',','.');
                                                    }
                                                    else{
                                                        echo "<font color='blue'>R$"." ".number_format($vs,2, ',','.');
                                                        }
                                                    ?></td>
        <td colspan="2" align="center"><input type="submit" name="submit" value="Baixar Selecionados" class="botao" /></td>
        
        </form>
        

        
    </tr>
    <tr>
        <td colspan="">Total de registros: <?php echo $c ?></td>
        
    </tr>