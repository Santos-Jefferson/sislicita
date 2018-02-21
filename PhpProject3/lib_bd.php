<?php
//funções para manipulação de bancos de dados

function calcula_valor_minimo($custo_aprox, $vfrete, $vimposto)
    {
        $vmo = ($custo_aprox + $vfrete + $vimposto);
    }
    return $vmo;

/*
 *Recebe uma colocação do formulário de geração de relatórios e cria o 
 *relatório solicitado.  
 * 
 * Recebe:
 * $colocacao: colocação a ser validada para geração do relatório
 * 
 * Retorna:
 * A colocação é utilizada para dar um$ select no banco e gerar o relatório
 */




/*
 * Recebe uma data $d e retorna a data invertida
 * 
 * Retorno:
 * A data invertida
 */
function inverte_data($d){
    if      (strstr($d,"-") != FALSE) $a = explode('-', $d);
    elseif  (strstr($d,'/') != FALSE) $a = explode('/', $d);
    elseif  (strstr($d,'.') != FALSE) $a = explode('.', $d);
    
    return "{$a[2]}-{$a[1]}-{$a[0]}";
}

/*
 * Checa se a data é correta ou não
 * Recebe:
 * $data: data a ser validada
 * $requerido: se TRUE, então o campo é obrigatório. se FALSE campo é opcional.
 * 
 * Retorno:
 * A data checada é invertida, pronta para gravar no banco
 * FALSE se a data for incorreta
 * '' se a data for ''
 */
function checa_data($data,$requerido = TRUE){
    //se o campo for opcional e for ''(branco), retorna data zerada.
    if(!$requerido and empty($data)) return '0000-00-00';
    
    //faz a quebra da data em campos de vetror
    $a = split('[/.-]',$data);
    
    //tenho q ter agora 3 pedaços!
    if(count($a) != 3) return FALSE;
    
    //se continuar, checa se cada pedaço é um número
    if (!is_numeric($a[0]) or !is_numeric($a[1]) or !is_numeric ($a[2])) return FALSE;
    
    //testa se a posição ano do vetor $a está entre 1950 e 2050
    if ($a[2] < 1950 or $a[2] >2050 ) return FALSE;
    
    //usar checkdate para verificar se é válida em questões (bissexto)
    if (!checkdate($a[1],$a[0],$a[2])) return FALSE;
    
    //inverte a data chamando a função inverte_data
    return inverte_data($data);
    
}


$r = checa_data("", FALSE);

if ($r !== FALSE) echo $r;
else echo "Deu pau e bilou";

?>
