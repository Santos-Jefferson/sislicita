<tr>
        <td colspan="2" align="left" bgcolor="red" class="A" scope="col">
            CONTRATO já consta cadastrado. Favor verificar!!!
            <input type='button' value='VOLTAR'
               onclick='document.location.href="cad_contrato.php?id_cod=<?php echo $_POST[id_cod] ?>&id_lote=<?php echo $_POST[id_lote]?>"'>
            <input type='button' value='CONTRATOS'
               onclick='document.location.href="gera_relatorio_cont.php?id_cod=<?php echo $_POST[id_cod] ?>&id_lote=<?php echo $_POST[id_lote]?>"'>
            <!--<input type='button' value='Listar'
               onclick='document.location.href="lista_licita_tudo.php?codigo=<?php echo $_REQUEST[codigo] ?>"'>
            <input type='button' value='Listagem Geral'
               onclick='document.location.href="lista_licita_tudo.php"'>-->
        </td>
        
            
    </tr>
    