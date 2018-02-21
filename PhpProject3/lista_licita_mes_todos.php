<?php

require "conecta.php";
require "constantes_metas.php";
//require_once "cabecalho_geral.php";
include "css.php";

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
 $('#conteudo').hide();
 $('#mostrar').click(function(event){
 event.preventDefault();
 $("#conteudo").show("slow");
 });
 $('#ocultar').click(function(event){
 event.preventDefault();
 $("#conteudo").hide("slow");
 });
 });
</script>

<table width="1010" align="center" class="A" border="1" cellpadding="2" cellspacing="0">
<tr class="">
    <td colspan="8" bgcolor="lightyellow">
    <center><h2><font color="">METAS DO MÊS - <?php echo (date('m/Y'));?>
    </td>
</tr>     

        <!--<td colspan="5"><h3><center><font color="red"><a href="#" id="mostrar">EXIBIR PRÊMIOS DO MÊS</a> | <a href="#" id="ocultar">OCULTAR PRÊMIOS DO MÊS</a></blink></td>-->

</tr>
<tr class="">
        <td colspan="" align="center"><b><font color="blue">LICITANTE</td>
        <td colspan="" align="center"><b><font color="blue">LUCRO ADJUDICADO</td>
        <td colspan="" align="center"><b><font color="blue">QTDE PARTICIPADAS</td>
        <td colspan="" align="center"><b><font color="blue">QTDE RO POSITIVO</td>
        <td colspan="" align="center"><b><font color="blue">META LUCRO</td>
        <td colspan="" align="center"><b><font color="blue">META QTDE</td>
        <td colspan="" align="center"><b><font color="blue">BONUS META</td>
        <td colspan="" align="center"><b><font color="blue">CAMPEÃO META</td>
                
        
</tr>
<?php
        require "lista_licita_mes_marcos.php";
        require "lista_licita_mes_dyuli.php";
        
?>

<tr class="">
    
        <td colspan="" align="center"><font color="">Dyuliane</td>
        <td colspan="" align="center"><font color="">
                        <?php
                            $number = $lucrogeral_at_dyuli+$lucrogeral_dyuli+(($lucrogeral_at_marcos+$lucrogeral_marcos)/2);
                            echo "R$" .number_format($number,2, ',','.');
                        ?>
        </td>
        <td colspan="" align="center"><font color=""><?php echo $c; ?></td>
        <td colspan="" align="center"><font color=""><?php echo $c_ro_dyuli;?></td>
        
        <td colspan="" align="center"><font color="">
        <?php
            $sql = "Select * from usuarios where usuario='dyuliane'";
            $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
            $usuarios = mysql_fetch_assoc($res); 

            //echo $c;
            //echo $usuarios[meta_qtde];
            //echo $number;
            if ($number>($usuarios[montante_adj])){
                $OK_ADJ="<font color='limegreen'>OK";
                $bonusmetaadj=1;
            }
            else{
                $OK_ADJ="<font color='orangered'>NÃO ATINGIDO";
                
            }
            
            echo $OK_ADJ;
            
        ?>
    </td>
    <td colspan="" align="center"><font color="">
        <?php
                    //echo "$_POST[licitante]";
           $sql = "Select * from usuarios where usuario='dyuliane'";
           $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
           $usuarios = mysql_fetch_assoc($res); 

           //echo $c;
           //echo $usuarios[meta_qtde];
           if ($c>=($usuarios[meta_qtde])and $c_ro_dyuli>='15'){
               $OK_QTDE="<font color='limegreen'>OK";
               $bonusmetaqtde=1;
           }
           else{
               $OK_QTDE="<font color='orangered'>NÃO ATINGIDO";
               
           }
            echo $OK_QTDE;
            
        ?>
    </td>
    
    <td colspan="" align="center"><font color="">
                        <?php
                            if(($bonusmetaadj==1) and ($bonusmetaqtde==1)){
                                $number = 325+(((($lucrogeral_at_dyuli+$lucrogeral_at_marcos)*1.5/100))+($lucrogeral_dyuli+$lucrogeral_marcos)*0.5/100);
                                echo "R$" .number_format($number,2, ',','.');
                            }
                            elseif(((($bonusmetaqtde==1)and($lucrogeral_at_dyuli+$lucrogeral_dyuli+(($lucrogeral_at_marcos+$lucrogeral_marcos)/2))<32500)and($lucrogeral_at_dyuli+$lucrogeral_dyuli+(($lucrogeral_at_marcos+$lucrogeral_marcos)/2))>=17000)){
                                $number = 225;
                                echo "R$" .number_format($number,2, ',','.');
                            }   
                            else{
                                echo "<font color='orangered'>NÃO ATINGIDO";
                            }
                        ?>
        </td>
        <td colspan="" align="center"><font color="">
                        <?php
                            if(($bonusmetaadj==1) and ($bonusmetaqtde==1)){
                                $number = 325+(((($lucrogeral_at_dyuli+$lucrogeral_at_marcos)*2/100))+($lucrogeral_dyuli+$lucrogeral_marcos)*0.5/100);
                                echo "R$" .number_format($number,2, ',','.');
                            }
                            else{
                                echo "<font color='orangered'>NÃO ATINGIDO";
                            }
                            $bonusmetaadj=0;
                            $bonusmetaqtde=0;
                        ?>
        </td>
</tr>

<?php
$vo=0;
$ll=0;
$vo_at=0;
$ll_at=0;
$vogeral_dyuli=0;
$vogeral_at_dyuli=0;
$lucrogeral_dyuli=0;
$lucrogeral_at_dyuli=0;
        require "lista_licita_mes_elton.php";
        
?>

<tr class="">
        <td colspan="" align="center"><font color="">Elton</td>
        <td colspan="" align="center"><font color="">
                        <?php
                            $number = $lucrogeral_at_elton+$lucrogeral_elton+(($lucrogeral_at_marcos+$lucrogeral_marcos)/2);
                            echo "R$" .number_format($number,2, ',','.');
                        ?>
        </td>
        <td colspan="" align="center"><font color=""><?php echo $c; ?></td>
        <td colspan="" align="center"><font color=""><?php echo $c_ro_elton;?></td>
        <td colspan="" align="center"><font color="">
        <?php
            $sql = "Select * from usuarios where usuario='elton'";
            $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
            $usuarios = mysql_fetch_assoc($res); 

            //echo $c;
            //echo $usuarios[meta_qtde];
            //echo $number;
            if ($number>($usuarios[montante_adj])){
                $OK_ADJ="<font color='limegreen'>OK";
                $bonusmetaadj=1;
            }
            else{
                $OK_ADJ="<font color='orangered'>NÃO ATINGIDO";
            }
            
            echo $OK_ADJ;
        ?>
    </td>
    <td colspan="" align="center"><font color="">
        <?php
                    //echo "$_POST[licitante]";
           $sql = "Select * from usuarios where usuario='elton'";
           $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
           $usuarios = mysql_fetch_assoc($res); 

           //echo $c;
           //echo $usuarios[meta_qtde];
           if ($c>=($usuarios[meta_qtde])and $c_ro_elton>='15'){
               $OK_QTDE="<font color='limegreen'>OK";
               $bonusmetaqtde=1;
           }
           else{
               $OK_QTDE="<font color='orangered'>NÃO ATINGIDO";
           }
            echo $OK_QTDE;
        ?>
    </td>
    
    <td colspan="" align="center"><font color="">
                        <?php
                            if(($bonusmetaadj==1) and ($bonusmetaqtde==1)){
                                $number = 325+(((($lucrogeral_at_elton+$lucrogeral_at_marcos)*1.5/100))+($lucrogeral_elton+$lucrogeral_marcos)*0.5/100);
                                echo "R$" .number_format($number,2, ',','.');
                            }
                            elseif(((($bonusmetaqtde==1)and($lucrogeral_at_elton+$lucrogeral_elton+(($lucrogeral_at_marcos+$lucrogeral_marcos)/2))<32500)and($lucrogeral_at_elton+$lucrogeral_elton+(($lucrogeral_at_marcos+$lucrogeral_marcos)/2))>=17000)){
                                $number = 225;
                                echo "R$" .number_format($number,2, ',','.');
                            }   
                            else{
                                echo "<font color='orangered'>NÃO ATINGIDO";
                            }
                        ?>
        </td>
        <td colspan="" align="center"><font color="">
                        <?php
                            if(($bonusmetaadj==1) and ($bonusmetaqtde==1)){
                                $number = 325+(((($lucrogeral_at_elton+$lucrogeral_at_marcos)*2/100))+($lucrogeral_elton+$lucrogeral_marcos)*0.5/100);
                                echo "R$" .number_format($number,2, ',','.');
                            }
                            else{
                                echo "<font color='orangered'>NÃO ATINGIDO";
                            }
                            $bonusmetaadj=0;
                            $bonusmetaqtde=0;
                        ?>
        </td>
</tr>

<?php
$vo=0;
$ll=0;
$vo_at=0;
$ll_at=0;
$vogeral_elton=0;
$vogeral_at_elton=0;
$lucrogeral_elton=0;
$lucrogeral_at_elton=0;
        require "lista_licita_mes_marcos.php";
?>
<!--
<tr class="">
        <td colspan="" align="center"><font color="">Marcos</td>
        <td colspan="" align="center"><font color="">
                        <?php
                            $number = $lucrogeral_at_marcos+$lucrogeral_marcos;
                            echo "R$" .number_format($number,2, ',','.');
                        ?>
        </td>
        <td colspan="" align="center"><font color=""><?php echo $c; ?></td>
        <td colspan="" align="center"><font color=""><?php echo $c_ro_marcos;?></td>
        <td colspan="" align="center"><font color="">
        <?php
            $sql = "Select * from usuarios where usuario='marcos.cruz'";
            $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
            $usuarios = mysql_fetch_assoc($res); 

            //echo $c;
            //echo $usuarios[meta_qtde];
            //echo $number;
            if ($number>($usuarios[montante_adj])){
                $OK_ADJ="<font color='limegreen'>OK";
                $bonusmetaadj=1;
            }
            else{
                $OK_ADJ="<font color='orangered'>NÃO ATINGIDO";
            }
            
            echo $OK_ADJ;
        ?>
    </td>
    <td colspan="" align="center"><font color="">
        <?php
                    //echo "$_POST[licitante]";
           $sql = "Select * from usuarios where usuario='marcos.cruz'";
           $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
           $usuarios = mysql_fetch_assoc($res); 

           //echo $c;
           //echo $usuarios[meta_qtde];
          if ($c>=($usuarios[meta_qtde])and $c_ro_marcos>='15'){
               $OK_QTDE="<font color='limegreen'>OK";
               $bonusmetaqtde=1;
           }
           else{
               $OK_QTDE="<font color='orangered'>NÃO ATINGIDO";
           }
            echo $OK_QTDE;
        ?>
    </td>
    
    <td colspan="" align="center"><font color="">
                        <?php
                            if(($bonusmetaadj==1) and ($bonusmetaqtde==1)){
                                $number = 325+($lucrogeral_at_marcos*1.5/100)+($lucrogeral_marcos*0.5/100);
                                echo "R$" .number_format($number,2, ',','.');
                            }
                            elseif(((($bonusmetaqtde==1)and($lucrogeral_at_marcos+$lucrogeral_marcos)<17000) and($lucrogeral_at_marcos+$lucrogeral_marcos)>=8000)){
                                $number = 225;
                                echo "R$" .number_format($number,2, ',','.');
                            }   
                            else{
                                echo "<font color='orangered'>NÃO ATINGIDO";
                            }
                            
                        ?>
        </td>
        <td colspan="" align="center"><font color="">
                        <?php
                            if(($bonusmetaadj==1) and ($bonusmetaqtde==1)){
                                $number = 325+($lucrogeral_at_marcos*2/100)+($lucrogeral_marcos*0.5/100);
                                echo "R$" .number_format($number,2, ',','.');
                            }
                            else{
                                echo "<font color='orangered'>NÃO ATINGIDO";
                            }
                            $bonusmetaadj=0;
                            $bonusmetaqtde=0;
                        ?>
        </td>
</tr>
-->

<?php
$vo=0;
$ll=0;
$vo_at=0;
$ll_at=0;
//$number=0;
$vogeral_marcos=0;
$vogeral_at_marcos=0;
$lucrogeral_marcos=0;
$lucrogeral_at_marcos=0;
        require "lista_licita_mes_monica.php";
?>
<!--
<tr class="">
        <td colspan="" align="center"><font color="">Monica</td>
        <td colspan="" align="center"><font color="">
                        <?php
                            $number = $lucrogeral_at_monica+$lucrogeral_monica;
                            echo "R$" .number_format($number,2, ',','.');
                        ?>
        </td>
        <td colspan="" align="center"><font color=""><?php echo $c; ?></td>
    <td colspan="" align="center"><font color="">
        <?php
            $sql = "Select * from usuarios where usuario='monica.amorim'";
            $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
            $usuarios = mysql_fetch_assoc($res); 

            //echo $c;
            //echo $usuarios[meta_qtde];
            //echo $number;
            if ($number>($usuarios[montante_adj])){
                $OK_ADJ="<font color='limegreen'>OK";
            }
            else{
                $OK_ADJ="<font color='orangered'>NÃO ATINGIDO";
            }
            
            echo $OK_ADJ;
        ?>
    </td>
    <td colspan="" align="center"><font color="">
        <?php
                    //echo "$_POST[licitante]";
           $sql = "Select * from usuarios where usuario='monica.amorim'";
           $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
           $usuarios = mysql_fetch_assoc($res); 

           //echo $c;
           //echo $usuarios[meta_qtde];
           if ($c>=($usuarios[meta_qtde])){
               $OK_QTDE="<font color='limegreen'>OK";
           }
           else{
               $OK_QTDE="<font color='orangered'>NÃO ATINGIDO";
           }
            echo $OK_QTDE;
        ?>
    </td>
</tr>-->
</table>
<div id="conteudo" style="background-color:; padding:5px; margin:20; width:;">

<?php
//require "premio_meta_mes_tabela.php";
?>

</div>

