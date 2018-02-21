<?php
require "cabecalho_reduzido.php";
require "conecta.php";

if (isset($_POST[baixa_contas])){
    foreach($_POST[baixa_contas] as $b){
        $s = "UPDATE contas_pagar_receber SET obs_contas='baixado' WHERE id_contas='$b'";    
        mysql_query($s) or die ("Erro baixando");
        
    }
    header ("location:lista_cad_contas_pagar_receber.php");
    die;
}


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<tr>
        <td colspan="3" align="left" bgcolor="#FFFF00" class="A" scope="col">
            <b>NENHUMA CONTA SELECIONADA!
            
            <input type='button' value='Voltar'
               onclick='document.location.href="lista_cad_contas_pagar_receber.php"'>
            </td>
        
            
    </tr>
