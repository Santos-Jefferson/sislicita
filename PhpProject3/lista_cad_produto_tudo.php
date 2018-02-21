<?php
require "conecta.php";
//require_once "cabecalho_reduzido_sem_teste.php";
require_once "cabecalho_geral.php";
//require_once "cabecalho_geral.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'tipo_prod';
if(empty($_GET[order2])) $_GET[order2] = 'marca_prod';
if(empty($_GET[order3])) $_GET[order3] = 'desc_prod';
//if(empty($_GET[ascdesc])) $_GET[ascdesc] = 'ASC';
//if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "SELECT * FROM cad_produto ORDER BY {$_GET[order]} {$_GET[ascdesc]}, {$_GET[order2]} {$_GET[ascdesc]}, {$_GET[order3]} {$_GET[ascdesc]}";
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha prod");

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
            <th colspan="11" bgcolor="yellow" align="center">PRODUTOS - SANTOS & MAYER</th>
        </tr>
    <tr>
        <td colspan="7">
            <input type='button' value='Cadastrar Novo Produto' class='botao'
               onclick='document.location.href="cad_produto.php?usuario=<?php echo "$user_logged"; ?>"'>
            <input type='button' value='Entrada/Saída Notas Fiscais' class='botao'
               onclick='document.location.href="cad_entrada_prod.php"'>
            <input type='button' value='Relatório de Cotação' class='botao'
               onclick='document.location.href="lista_compra_cotacao_subitens.php"'>
        </td>
        <td colspan="4">
            <form action="lista_cad_produto_filtro.php" method="POST" name="lista_cad_produto_filtro">
            FILTRAR TIPO:
                    <select id="lista_tipo" name="lista_tipo">
                        <?php
            
                            $nome_marca_query="SELECT nome_tipo_prod FROM bd_tipo_prod ORDER BY nome_tipo_prod ASC";
                            $nome_marca_result=mysql_query($nome_marca_query) or die ("Falha ao recuperar o TIPO_PROD da base de dados: ".mysql_error());
                            echo "<option>$_POST[lista_tipo]</option>";

                            while ($nome_marca_row=mysql_fetch_array($nome_marca_result)) {
                            $nome_marca=$nome_marca_row[nome_tipo_prod];
                                echo "<option>
                                    $nome_marca
                                </option>";
                            }
                        ?>
                    </select>
            <input type="submit" value="Filtrar" class='botao' />
            </form>
        </td>
    </tr>
        
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th width="" align="center">CÓD. MAESTRO</th>
            <th width="100" align="center"><a href="lista_cad_produto_tudo.php?order=tipo_prod&ascdesc=DESC"><img src="imagens/cima.png"></a>TIPO<a href="lista_cad_produto_tudo.php?order=tipo_prod&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="90" align="center"><a href="lista_cad_produto_tudo.php?order=marca_prod&ascdesc=DESC"><img src="imagens/cima.png"></a>MARCA<a href="lista_cad_produto_tudo.php?order=marca_prod&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th colspan="3" width="90" align="center"><a href="lista_cad_produto_tudo.php?order=desc_prod&ascdesc=DESC"><img src="imagens/cima.png"></a>MODELO/DESCRIÇÃO<a href="lista_cad_produto_tudo.php?order=desc_prod&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th width="60" align="center"><a href="lista_cad_produto_tudo.php?order=qtde_estoque&ascdesc=DESC"><img src="imagens/cima.png"></a>QTDE<a href="lista_cad_produto_tudo.php?order=qtde_estoque&ascdesc=ASC"><img src="imagens/baixo.png"></a></th>
            <th align="center">UNIDADE</th>
            <th align="center">P/N</th>
            <th width="100" align="center">VALOR UN. CUSTO</th>
            <th>AÇÃO</th>
        </tr>
<?php
//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $v += $linha[qtde_estoque]*$linha[valor_custo_forn];    //incrementa a $v o campo valor
    ?>
    
     <tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
         <td align="center"><?php echo $linha[id_cad_prod]                          ?></a></td>
         <td align="center"><?php echo $linha[tipo_prod]                          ?></a>
         <td align="center"><?php echo $linha[marca_prod]                          ?></a>
         <td colspan="3" align="left">&nbsp;<?php echo $linha[desc_prod]                          ?></a>
         <td align="center"><?php echo $linha[qtde_estoque]                          ?></a>
         <td align="center"><?php echo $linha[un_prod]                          ?></a>
         <td align="center"><a href="javascript:abrir('info_prod.php?part_number=<?php echo $linha[part_number];?>');"><?php echo $linha[part_number]?></a>
         <td align="right"><?php echo "R$"." ".number_format($linha[valor_custo_forn],2, ',','.');?></a>
             <td align="center" width="40">
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha[licitante]) == ($usuario)){
                
                echo "<a href='altera_prod.php?alterar=$linha[id_cad_prod]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_prod_exc.php?apagar=$linha[id_cad_prod]&desc_prod=$linha[desc_prod]'><img src='imagens/delete.png' border='0'/></a>";
            }
            
            elseif (($usuario == "admin") or ($usuario == "adm")){
                echo "<a href='altera_prod.php?alterar=$linha[id_cad_prod]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_prod_exc.php?apagar=$linha[id_cad_prod]&desc_prod=$linha[desc_prod]'><img src='imagens/delete.png' border='0'/></a>";
                
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
        <td colspan="9">Total de registros: <?php echo $c ?></td>
        <td colspan="2" align="right">Total: <?php echo "R$"." ".number_format($v,2, ',','.');?></td>
    
    <br>
    </tr><br>