<?php
require ("cabecalho_reduzido.php");
require ("cabecalho_lote.php");
require ("conecta.php");


if(empty($_GET[order])) $_GET[order] = 'codigo';

$sql_codigo = "select * from codigo WHERE codigo LIKE '%{$_GET[codigo]}%' or '%{$_GET[orgao]}%' ORDER BY {$_GET[order]}";
$res_codigo = mysql_query($sql_codigo) or die("erro - rel_licita.php-linha_codigo");
$linha_codigo = mysql_fetch_assoc($res_codigo);

$sql_lote = "select * from lote WHERE id_cod = {$_GET[id_cod]} and id_lote = {$_GET[id_lote]} and colocacao = 'Arrematado'";
$res_lote = mysql_query($sql_lote) or die("erro - rel_licita.php-linha_lote");
$linha_lote = mysql_fetch_assoc($res_lote);

$sql_itens = "select * from itens WHERE id_lote = {$_GET[id_lote]}";
$res_itens = mysql_query($sql_itens) or die("erro - rel_licita.php-linha_itens");
$linha_itens = mysql_fetch_assoc($res_itens);




    while($linha_codigo){
        echo "$linha_codigo[orgao] - ";
        echo "$linha_codigo[codigo] - ";
        echo "$linha_codigo[data] / $linha_codigo[hora] - ";
            $linha_codigo = mysql_fetch_assoc($res_codigo);
    }
    
    
    while($linha_lote){
        echo "$linha_lote[lote] - ";
            $linha_lote = mysql_fetch_assoc($res_lote);
    
    }
    
    while($linha_itens){
        $vo += $linha_itens[vofertado];
        $vll += $linha_itens[lucro_liq];
        $linha_itens = mysql_fetch_assoc($res_itens);
    }
    
    echo "$vo - ";
    echo "$vll";
    
    
    //$linha_codigo = mysql_fetch_assoc($res_codigo);
//}



   
?>
<tr>
    <th colspan="2" height="159" align="left" class="A" scope="col">
    
    <!-- o form deve conter a tag name="" para que possa ser submetido automatica-->
    <form action="<?php if ($erro or empty($_POST)) echo "cad_lote.php"; 
                            else echo "grava_lote.php"; ?>" method="POST" name="cad_lote">
        
       <table width="1020" border="1" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                
          <table width="1010" border="0" align="center" class="A" cellpadding="0" cellspacing="0">
            <tr>
                <td></td>
            </tr>
              <tr>
                <td colspan="2" align="center"><strong>CADASTRE AQUI OS LOTES DA SUA LICITAÇÃO<hr></td>
            </tr>
            <tr>
                <td><br><br></td>
            </tr>
            
            <tr>
                <td width="120" align="right">CÓDIGO LICITAÇÃO:</td>
                <td><input type="text" name="codigo" size="20" maxlength="20" value="<?php echo $_REQUEST[codigo]; ?>" disabled>
                </td>
            </tr>
            
            <tr>
                <td align="right">Lote/Grupo:</td>
                <td><input type="text" name="lote" size="20" maxlength="20" value="<?php echo $_POST[lote]; ?>">
                    <?php
                        if($erro_lote){
                            echo "<font color=red>*** Campo obrigatório</font>";
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                
                <td><input type="hidden" name="codigo" value="<?php echo $_REQUEST[codigo]; ?>">
                </td>
                <td><input type="hidden" name="id_cod" value="<?php echo $_REQUEST[id_cod]; ?>">
                </td> 
                
                
            </tr>
            
            <?php
                //em caso de não have erros, submete o formulário automaticamente!
                //tem que ser em java script
                if(!$erro and !empty($_POST)){
                    echo '<script language="javascript">document.cad_lote.submit()</script>';
                }
            
            ?>
            <tr>
                <td><br><br></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" align="left"><input type="submit" value="Cad. Lote" /></td>
                
            </tr>
        </form>  
</tr>
