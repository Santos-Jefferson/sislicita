<?php
//funções para manipulação de datas

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


//$r = checa_data("", FALSE);

//if ($r !== FALSE) echo $r;
//else echo "Deu pau e bilou";


//Função que adiciona dias corridos a uma data.

function addDayIntoDate($date,$days) {
     $thisyear = substr ( $date, 0, 4 );
     $thismonth = substr ( $date, 4, 2 );
     $thisday =  substr ( $date, 6, 2 );
     $nextdate = mktime ( 0, 0, 0,$thismonth, $thisday + $days, $thisyear  );
     return strftime("%Y%m%d", $nextdate);
}

function subDayIntoDate($date,$days) {
     $thisyear = substr ( $date, 0, 4 );
     $thismonth = substr ( $date, 4, 2 );
     $thisday =  substr ( $date, 6, 2 );
     $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday - $days, $thisyear );
     return strftime("%Y%m%d", $nextdate);
}

/*$date = date("Ymd");
print date("Ymd");
print $date."<br>";
$nextdate = addDayIntoDate($date,30);    // Adiciona 15 dias
print $nextdate."<br>";
//$backdate = subDayIntoDate($date,30);    // Subtrair 30 dias
//print $backdate."<br>";




*/

function SomarData($data, $dias, $meses = 0, $ano = 0)
{
   //passe a data no formato yyyy-mm-dd
   $data = explode("-", $data);
   $newData = date("Y-m-d", mktime(0, 0, 0, $data[1] + $meses, $data[2] + $dias, $data[0] + $ano) );
   return $newData;
}
//$data_inicial = '2009-01-01';
//$nova_data = SomarData($data_inicial,7);
//echo $nova_data;

function SomarData2($data, $dias, $meses, $ano)
{
    //A data deve estar no formato dd/mm/yyyy
    $data = explode("/", $data);
    $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano) );
    return $newData;
}
/*
Exemplo de como usar:
 - echo SomarData2(”11/02/2009″, 1, 2, 1);
No exemplo acima estamos a adicionar 1 dia, 2 meses e 1 ano à data informada. O resultado então será “12/03/2010″
*/

/**
* Função para calcular o próximo dia útil de uma data
* Formato de entrada da $data: AAAA-MM-DD
*/
function proximoDiaUtil($data, $saida = 'd/m/Y') {
// Converte $data em um UNIX TIMESTAMP
$timestamp = strtotime($data);
 
// Calcula qual o dia da semana de $data
// O resultado será um valor numérico:
// 1 -> Segunda ... 7 -> Domingo
$dia = date('N', $timestamp);
// Se for sábado (6) ou domingo (7), calcula a próxima segunda-feira
if ($dia >= 6) {
$timestamp_final = $timestamp + ((8 - $dia) * 3600 * 24);
} else {
// Não é sábado nem domingo, mantém a data de entrada
$timestamp_final = $timestamp;
}
 
return date($saida, $timestamp_final);
}
 
?>





