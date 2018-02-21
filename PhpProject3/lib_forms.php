<?php
//funções para manipulação de formulários



/*Recebe: via $_GET a informação de UF e TIPO_DE_LICITAÇÃO
 *Processa: Verificar qual porcentagem será usada (se 17%, 20%, 27% ou 30%)
 *Retorna: A % no campo porc_lucro do formulário cad_itens.php
*/

function form_porc_lucro($uf,$tipo_licitacao){
    if (($tipo_licitacao] == 'RP') and ($uf == "Ceará - CE")){
        return $pl = 30;
            }
        elseif (($tipo_licitacao == 'RP') and !($uf == "Ceará - CE")){
            return $pl = 20;
            }
        elseif (($tipo_licitacao == 'AT') and ($uf == "Ceará - CE")){
            return $pl = 27;
            }
        elseif (($tipo_licitacao == 'AT') and !($uf == "Ceará - CE")){
            return $pl = 17;
            }   
            else {
                return $pl = "17";
                } 
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
