<tr>
    <td colspan="" align="center" class="A"><strong>CADASTROS COMPLETOS - LICITAÇÕES</td>
    <td colspan="2" align="center"><input type='button' value='Menu Principal' onclick='document.location.href="cabecalho.php"'></td>
</tr>
<tr>
        <td colspan="1" align="left" class="A" >
            
            <input type='button' value='Cadastrar Licitação' class='botao'
               onclick='document.location.href="cad_codigo.php"'>
            <input type='button' value='Listar Licitações' class='botao'
               onclick='document.location.href="lista_licita_tudo.php"'>
            <input type='button' value='Gerar Relatório' class='botao'
               onclick='document.location.href="selec_relatorio.php"'>
            <input type='button' value='Licitações HOJE' class='botao'
               onclick='document.location.href="lista_licita_hoje.php?hoje=<?php echo date('Y-m-d'); ?>"'>
            <input type='button' value='Notas de Empenho' class='botao'
               onclick='document.location.href="selec_relatorio_ne.php"'>
            <input type='button' value='Contratos' class='botao'
               onclick='document.location.href="gera_relatorio_cont.php"'>
            </td>
        
        <td colspan="2" align="center" class="A" scope="col">
        <form action="
            <?php
                if (isset($_GET[exc])) echo "lista_precad_exc.php";
                    elseif (isset($_GET[alt])) echo "lista_precad_alt.php";
                    else echo "lista_licita_tudo.php";?>" method="GET">
                Buscar: <input type="text" name="codigo" maxlength="10" size="10">
            <input type="submit" value="Buscar" class='botao'>
        </form>
        </td>
</tr>

</table>