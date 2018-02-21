<?php
$imposto = 6/100;
$linha[valor_tot_custo] = $linha[qtde]*$linha[valor_unit_custo];
$linha[imposto] = $linha[vofertado]*$imposto;
//$linha[vminitem] = ($linha[porcentagem_lucro]*$linha[custo_aprox])/100;
$linha[custo_aprox] = $linha[valor_tot_custo]+$linha[valor_frete]+$linha[imposto];    
$linha[lucro_liq] = $linha[vofertado]-$linha[custo_aprox];    
$linha[vminofertar] = $linha[custo_aprox]+($linha[custo_aprox]*$linha[porcentagem_lucro])/100;
$linha[vitem] = $linha[vofertado]/$linha[qtde];
$linha[vminitem] = $linha[vminofertar]/$linha[qtde];
?>