<?php
require "cabecalho_reduzido.php";
require "conecta.php";
        
// comando para testar variáveis que vem do formulário
//print_r($_REQUEST);

//se é um alterar cadastro, utiliza a instrução UPDATE, se for cadastro novo, INSERT.
        //isset = existe ou não existe (se existe post[cod], então faz update. se não existe, faz cadastro novo
$sql = "SELECT * FROM cad_concorrencia_adj WHERE id_lote = '{$_POST[id_lote]}'";
$sql2 = "SELECT * FROM cad_concorrencia_2adj WHERE id_lote = '{$_POST[id_lote]}'";
$res = mysql_query($sql) or die("erro cad_concorrencia_adj");
$res2 = mysql_query($sql2) or die("erro cad_concorrencia_2adj");

if (mysql_num_rows($res)){
    
    require_once "validacao_cad_concorrencia.php";
    die;
   
 }
 else if ($_POST[colocacao] == "Arquivado")
    {
    $sql = "INSERT into cad_concorrencia_adj (emp_adj,mar_adj,mod_adj,val_adj,id_lote)
                       VALUES ('{$_POST[emp_adj]}','{$_POST[mar_adj]}','{$_POST[mod_adj]}','{$_POST[val_adj]}','{$_POST[id_lote]}'
                               )";
    }

if (mysql_num_rows($res2)){
    
    require_once "validacao_cad_concorrencia.php";
    die;
   
 }
   else if ($_POST[colocacao] == "A receber Ata/Contrato")
    {
    $sql2 = "INSERT into cad_concorrencia_2adj (emp_2adj,mar_2adj,mod_2adj,val_2adj,id_lote)
                       VALUES ('{$_POST[emp_2adj]}','{$_POST[mar_2adj]}','{$_POST[mod_2adj]}','{$_POST[val_2adj]}','{$_POST[id_lote]}'
                               )";
    }

//echo $sql;die;
mysql_query($sql) or die("Erro gravando!!!");
mysql_query($sql2) or die("Erro gravando!!!");

//require_once "$lugar";


//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//die;
//header mexe com cabeçahos do APACHE, não pode haver HTML antes do HEADER, pois o mesmo pode não funcionar.
//header ("location:precad_licita.php");

        
?>
    <tr>
        <td colspan="2" align="left" bgcolor="#FFFF00" class="A" scope="col">
            OK, Licitação cadastrada com sucesso!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_o.php"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>
            <input type='button' value='RO POSITIVO'
               onclick='document.location.href="ro_positivo.php"'>
        </td>
        
            
    </tr>

    