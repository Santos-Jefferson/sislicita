<?php

require "conecta.php";
//require_once "cabecalho_reduzido.php";
//require_once "cabecalho_lote.php";

//print_r ($_REQUEST);
// se o GET[order] for vazio, então será preenchido com um valor padrão
//if(empty($_REQUEST[order])) $_REQUEST[order] = 'nome_subitem';
    
$sql = "SELECT * FROM subitens2 WHERE id_item = {$_REQUEST[id_item]} order by id_subitem";

$res = mysql_query($sql) or die("Erro seleção lista itens det tudo2");

$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros

//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);

//Faz os testes para poder fazer o inset na tabela com os itens abaixo discriminados
if (empty($linha[nome_subitem])){
if (($_GET[tipo_equip]=="MaestroInfo - Desktop Torre") or ($_GET[tipo_equip]=="MaestroInfo - Desktop Torre c/ Monitor")){
    
    //Assim que entra na página e faz os testes do IF, dá um refresh na página para fazer o INSERT na tabela.
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    
    $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,modelo_si,vunitcusto_si,forn_si,id_item)
                           VALUES ('1','PC MAESTRO','MAESTROINFO','PC MAESTRO ELITE','0.00','Maestro Informática','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,id_item)
                           VALUES ('1','Processador','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,id_item)
                           VALUES ('1','Placa-Mãe','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Memória','Kingston','Aldo Componentes Eletronicos','4GB - DDR4 - 2133MHZ - KVR21N15S8/4','115.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','HD','Seagate','Maestro Informática','Disco Rígido Seagate Desktop - 500GB - SataIII - 16MB - 7200 RPM - ST500DM002','160.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Gravador DVD/Blu-Ray','Lite-on','Aldo Componentes Eletronicos','iHAS120-04 - Gravador de DVD Lite-On iHAS120-04 SATA Preto','55.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Placa Vídeo','EVGA','Aldo Componentes Eletronicos','GT MAINSTREAM NVIDIA G210 1GB DDR3 64BITS 1200MHZ / 520MHZ 16 CUDA CORES VGA | DVI | HDMI LOW PROFILE','145.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Placa Wireless','TP-Link','Fagundez','TL-WN781ND (BR) - Adaptador PCI-Express TP-Link','40.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,id_item)
                           VALUES ('1','Fonte Atx','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Gabinete','PcTop','Ac3 Informática','Mod: 2323G 4 Baias 5/4 externas - 1 Baia 3/2 externa 2 portas Usb frontal Audio Frontal c/ Fonte ATX 200wts','90.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Leitor de Cartões','Mymax','Ac3 Informática','Leitor e Gravador de cartões - todos os tipos','15.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Teclado','Pisc','Fagundez','1875 - PADRAO STANDARD-USB','17.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Mouse','Pisc','Fagundez','1807 - OPTICO PRETO- USB, 800DPI, 2 botões, 1 scroll','6.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
         $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Cx Som','Pctop','Fagundez','Cxpp01, USB, amplificada','18.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Sist. Operacional','Microsoft','Maestro Informática','Windows 7 Professional 64bits Portugues','60.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Garantia','MaestroInfo','Maestro Informática','Conf. Especs','0.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        if ($_GET[tipo_equip]=="MaestroInfo - Desktop Torre c/ Monitor"){
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Monitor','AOC','Aldo Componentes Eletronicos','E970SWNL 18.5 pol. LED 1366X768 HD WIDESCREEN PRETO PIANO','355.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        }
}
if (($_GET[tipo_equip]=="MaestroInfo - Desktop Torre I3/AMD") or ($_GET[tipo_equip]=="MaestroInfo - Desktop Torre c/ Monitor I3/AMD")){
    
    //Assim que entra na página e faz os testes do IF, dá um refresh na página para fazer o INSERT na tabela.
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    
    $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,modelo_si,vunitcusto_si,forn_si,id_item)
                           VALUES ('1','PC MAESTRO','MAESTROINFO','PC MAESTRO ELITE','0.00','Maestro Informática','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Processador','AMD','Fagundez','FX 4300 3.8GHz 8MB CACHE TOTAL -  4 núcleos/4 threads - AM3+ FD4300WMHKBOX','350.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Placa-Mãe','AsRock','Marcia Mattos','N68-GS4 FX AMD Soquete AM3+','185.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Memória','Kingston','Aldo Componentes Eletronicos','KVR16LN11/4 4GB 1600MHZ DDR3L NON-ECC CL11 240-PIN UDIMM LOW VOLTAGE 1.35V','72.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','HD','Seagate','Maestro Informática','Disco Rígido Seagate Desktop - 500GB - SataIII - 16MB - 7200 RPM - ST500DM002','185.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Gravador DVD/Blu-Ray','Lite-on','Aldo Componentes Eletronicos','iHAS120-04 - Gravador de DVD Lite-On iHAS120-04 SATA Preto','55.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Placa Wireless','TP-Link','Fagundez','TL-WN781ND (BR) - Adaptador PCI-Express TP-Link','40.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Gabinete','PcTop','Ac3 Informática','Mod: 2323G 4 Baias 5/4 externas - 1 Baia 3/2 externa 2 portas Usb frontal Audio Frontal c/ Fonte ATX 200wts','90.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Teclado','Coletek','Fagundez','KB3201 USB PRETO Abnt2 Multimedia','18.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Mouse','Coletek','Fagundez','USB MS3203-2 PRETO, 800DPI, Ótico, 2 botões, 1 scroll','8.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Sist. Operacional','Microsoft','Maestro Informática','Windows 7 Professional 64bits Portugues','50.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        
        if ($_GET[tipo_equip]=="MaestroInfo - Desktop Torre c/ Monitor I3/AMD"){
        $sql_subitens = "INSERT into subitens2 (qtde_si,nome_subitem,marca_si,forn_si,modelo_si,vunitcusto_si,id_item)
                           VALUES ('1','Monitor','AOC','Aldo Componentes Eletronicos','E970SWNL 18.5 pol. LED 1366X768 HD WIDESCREEN PRETO PIANO','355.00','{$_GET[id_item]}'
                                   )";
        mysql_query($sql_subitens) or die("Erro gravando - pc maestro");
        }
}
               

}



//print_r ($_REQUEST);
//require_once "pes_rapida_cad_tudo.php";


//require "tab_cab_itens_tudo.php";



?>





<br><br>

<table align="center" class="A" width="1000" border="1" cellpadding="3" cellspacing="0">
    
    <tr>
        <td class="forms" colspan="9" bgcolor="LemonChiffon" align="center"><strong>LISTAGEM SUB-ITENS</td>
    </tr>
    
  <tr>
                <th>QTDE</th>
                <th>NOME-SUBITEM</th>
                <th>MARCA</th>
                <th width="990">MODELO/DESCRIÇÃO</th>
                <th>V.UNIT.CUSTO</th>
                <th>V.TOT.CUSTO</th>
                <th>FORNECEDOR</th>
                <th>RO?</th>
                <th>AÇÃO</th>
</tr>
      <?php

//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    $vtc += ($linha[qtde_si]*$linha[vunitcusto_si]);    //incrementa a $v o campo valor
    //$ca += $linha[custo_aprox];    //incrementa a $v o campo valor
    //$ll += $linha[lucro_liq];    //incrementa a $v o campo valor
    //$vo += $linha[vofertado];    //incrementa a $v o campo valor
    

    //mostra a linha
    //$linha agora é um vetor com as posições:
    //$linha[cod], $linha[nome], $linha[valor], etc...

//  Declarado aqui as variáveis que irão compor as colunas para utilizar na hora 
//  do pregão (criado as fórmulas para adicionar ao banco)
//  chama o arquivo que contem as variáveis
//require "var_formulas.php"

?>
      
 
<tr align="center">

<td>&nbsp;<?php echo $linha[qtde_si] ?></a>
    </td>
    
    
    <td>&nbsp;<?php echo $linha[nome_subitem] ?></td>
    
    
    <td>&nbsp;<?php echo $linha[marca_si] ?></td>
   
    
    <td>&nbsp;<?php echo "$linha[modelo_si]"; ?></td>
   
    
    <td>&nbsp;<?php 
                $number = "$linha[vunitcusto_si]";
                echo "R$" .number_format($number,2, ',','.');
                ?>
    </td>
    
    <td>&nbsp;<?php
                
                $number = $linha[vunitcusto_si]*$linha[qtde_si];
                echo "R$" .number_format($number,2, ',','.');
                ?>
    </td>
    <td>&nbsp;<?php echo $linha[forn_si] ?></td>
    <td>&nbsp;<?php echo $linha[ro_si] ?></td>
    
    <td align="center">
            
            <a href="altera_subitens2.php?alterar=<?php echo $linha[id_subitem]; ?>"><img src="imagens/edit.png" border="0"/></a>
            <a href="conf_subitens_exc2.php?apagar=<?php echo "[$linha[sub_itens] $linha[marca_si] $linha[modelo_si];]"; ?>&id_item=<?php echo $linha[id_item]; ?>&id_subitem=<?php echo $linha[id_subitem]; ?>"><img src="imagens/delete.png" border="0"/></a>
        </td>
    
   <!-- <td align="center">&nbsp;<input type='button' value='Alterar'
               onclick='document.location.href="altera_subitens.php?alterar=<?php //echo $linha[id_subitem]; ?>"'> / 
                                 <input type='button' value='Excluir'
               onclick='document.location.href="conf_subitens_exc.php?apagar=<?php //echo "[$linha[sub_itens] $linha[marca_si] $linha[modelo_si];]"; ?>&id_item=<?php echo $linha[id_item]; ?>&id_subitem=<?php echo $linha[id_subitem]; ?>"'>
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
  
  
  <tr>
      <td colspan="9" ><br></td>
  </tr>
  <tr>
    <th class="forms" colspan="5" scope="row">TOTAL:</th>
    <!--<td>R$</td>
    <td>&nbsp;</td>
    <td>R$</td>
    <td>R$</td>-->
    <td colspan="4" align="left" class=""><?php 
                $number = "$vtc";
                echo "R$" .number_format($number,2, ',','.');
                //echo $linha[vofertado]
                ?>
    </td>
  </tr>
    
    <!--
    <th align="right" class="forms" colspan="">
        APAGAR SUB-ITEM N°:
    </th>
    <form action="conf_sub_itens_exc.php" method="POST">
    <td align="center" class="apagar_itens" colspan="0">
        <input type="text" name="sub_item_exc" size="3" maxlength="3" value="">
    <td colspan="2" align="center" class="apagar_itens">
        <input type="submit" value="Apagar"> 
    </td>
    
  </tr>
    -->

    <tr>
        <td colspan="9">Total de sub-itens: <?php echo $c ?></td>
        
    </tr>
</table>
  <br><br>
</table><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
