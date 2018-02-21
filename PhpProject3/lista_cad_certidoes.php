<?php
require "conecta.php";
//require_once "cabecalho_reduzido_sem_teste.php";
//require_once "cabecalho_geral.php";
//require_once "cad_certidoes.php";
require_once "css.php";

//print_r ($usuario);
//print_r ($senha);
//die;

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data_venc';
//if(empty($_GET[ascdesc])) $_GET[ascdesc] = 'ASC';
//if(empty($_GET[order2])) $_GET[order2] = 'hora';

//if($usuario == "admin"){

    $sql = "SELECT * FROM cad_certidoes ORDER BY {$_GET[order]} ASC";
    //}
    //else{
    
      //  $sql = "SELECT * FROM codigo WHERE licitante = '$usuario' and codigo LIKE '%{$_GET[codigo]}%' ORDER BY {$_GET[order]} DESC, {$_GET[order2]} ASC";
    //}
    
$res = mysql_query($sql) or die("Erro seleção - linha certidões");

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
            <th colspan="11" bgcolor="yellow" align="center">CERTIDÕES</th>
        </tr>
        <tr class="">
            <!--<th>Cod_int</th>-->
            <th width="" align="center">TIPO EMISSÃO</th>
            <th width="" align="center">NOME CERTIDÃO</th>
            <th width="" align="center">DATA EMISSÃO/VENCIMENTO</th>
            <th width="" align="center">PRAZO VALIDADE</th>
            <th width="" align="center">LINK EMISSÃO</th>
            
            <th width="55">AÇÃO</th>
        </tr>
        
        <form action="grava_baixa_contas.php" method="post">
<?php
//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    
    
    ?>
    
     <tr bgcolor="
                <?php
                $data = date('d-m-Y', strtotime(date('Y-m-d')));
                $data_hoje = date('Y-m-d');
                $data_venc = $linha[data_venc];
                $data_venc_add = date('Y-m-d', strtotime('+'.$linha[prazo_val].' days', strtotime($data_venc)));
                $data_venc_sub7 = date('Y-m-d', strtotime('- 7 days', strtotime($data_venc_add)));
                $data_venc_sub1 = date('Y-m-d', strtotime('- 1 days', strtotime($data_venc_add)));
                
                
                
                        if ($data_hoje >= $data_venc_add){
                            echo red;
                        }
                            elseif (($data_hoje > $data_venc_sub7) and ($data_hoje < $data_venc_sub1)){
                                echo 'yellow';
                            }
                            elseif ($data_hoje < $data_venc_add){
                                echo 'ffffff';
                            }
                            //else echo 'ffffff';
                        
                ?>
                ">
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
         <td align="center" align="left">&nbsp;<?php echo $linha[tipo_emissao]                      ?></a>
         <td align="center" align="left">&nbsp;<?php echo $linha[nome_cert]                          ?></a>
         <td align="center">&nbsp;<?php echo date('d/m/Y', strtotime($linha[data_venc]))." -- ".date('d/m/Y', strtotime($data_venc_add))                        ?></a></td>
         <td align="center">&nbsp;<?php echo $linha[prazo_val]." Dias"                          ?></a>
         <td align="center">&nbsp;<a href="<?php if ($linha[tipo_emissao] == "Online"){ echo $linha[link_emissao];} else echo "cad_certidoes.php";?>" target="_blank">Clique para emitir</a>
             
             <td align="center" width="40">
                 
            
            <?php
            //print_r ($linha[licitante]);
            //die;
            //echo $usuario;
            if (($linha[licitante]) == ($usuario)){
                
                echo "<a href='altera_cad_certidoes.php?alterar=$linha[id_cad_certidoes]'><img src='imagens/edit.png' border='0'/></a>";
                echo "<a href='conf_certidoes_exc.php?apagar=$linha[id_cad_certidoes]'><img src='imagens/delete.png' border='0'/></a>";
                
                
            }
            
            elseif (($usuario == "admin") or ($usuario == "adm") or ($usuario == "dyuliane")){
               echo "<a href='altera_cad_certidoes.php?alterar=$linha[id_cad_certidoes]'><img src='imagens/edit.png' border='0'/></a>";
               echo "<a href='conf_certidoes_exc.php?apagar=$linha[id_cad_certidoes]'><img src='imagens/delete.png' border='0'/></a>";
                
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
        <td colspan="6">Total de registros: <?php echo $c ?></td>
        
    </tr>