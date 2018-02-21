 <tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
        <td>&nbsp;<a href="cad_licita.php?codigo=<?php echo $linha[id_cod] ?>"><?php echo $linha[codigo]                          ?></a></td>
        <td>&nbsp;<a href="cad_itens2.php?lote=<?php echo $linha[id_lote] ?>"><?php echo $linha_lote[lote]                          ?></a></td>
        <td>&nbsp;<?php echo $linha[orgao]                             ?></td>
        <td>&nbsp;<?php echo $linha[data]                               ?></td>
        <td>&nbsp;<?php echo $linha[hora]                               ?></td>
        <td>&nbsp;<?php echo $linha[licitante]                               ?></td>
 </tr>