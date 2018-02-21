<tr>
        <!--<td>&nbsp;<?php// echo $linha[id_cadastro]                        ?></td>-->
        <td>&nbsp;<?php echo $linha[codigo]                          ?></td>
        <td>&nbsp;<?php echo $linha[lote]                          ?></td>
        <td>&nbsp;<?php echo $linha[orgao]                             ?></td>
        <td>&nbsp;<?php echo $linha[data]                               ?></td>
        <td>&nbsp;<?php echo $linha[hora]                               ?></td>
        <td>&nbsp;<?php echo $linha[licitante]                               ?></td>
        <td align="center"><input type="checkbox" name="alterar[]" value="<?php echo $linha[id_lote] ?>"</td>
</tr>