<tr>
        <td colspan="2" align="left" bgcolor="red" class="A" scope="col">
            Este lote já consta cadastrado para este código de licitação. Favor verificar!!!
            <input type='button' value='Novo'
               onclick='document.location.href="cad_lote.php?id_cod=<?php echo $_POST[id_cod]; ?>&codigo=<?php echo $_POST[codigo]; ?>"'>
            <input type='button' value='Listar'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>
        
        </td>
        
            
    </tr>