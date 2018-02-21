<?php


$data_atual = date('Y-m-d');
$v = split('[/.-]', $data_atual);
//echo "$v[0]";

// se o GET[order] for vazio, então será preenchido com um valor padrão
if(empty($_GET[order])) $_GET[order] = 'data';
if(empty($_GET[order2])) $_GET[order2] = 'hora';

    $sql = "SELECT *
                FROM codigo inner join lote
                WHERE codigo.id_cod=lote.id_cod
                        and codigo.licitante='Marcos.cruz'
                        and codigo.tipo_licitacao='RP'
                        and lote.adj_data !='0000-00-00'
                        and lote.validade_rpfinal >= '$v[0]-$v[1]-00'
                        and lote.adj_data <= '$v[0]-$v[1]-31'
                            
                            ORDER BY codigo.data";
    
    $sql_ro = "SELECT * FROM codigo,lote,itens2 WHERE
                codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote
                            and itens2.ro_item='Sim'
                                and lote.colocacao !='Cancelada/Suspensa'
                                and lote.colocacao !='Desclassificado'
                                and lote.colocacao !='Reaberto'
                                and lote.colocacao !='Rescindido contrato/ata'
                                and lote.colocacao !=''
                                and (YEAR(codigo.data) = '$v[0]')
                                and (MONTH(codigo.data) = '$v[1]')
                                and codigo.licitante='marcos.cruz'
                                group by lote.id_lote";
    
    $res_ro = mysql_query($sql_ro) or die("Erro seleção - linha - RO qtde ");
    $c_ro = 0; //total de registros
    //pega a primeira linha do resultado
    $linha_ro = mysql_fetch_assoc($res_ro);
    while($linha_ro){
        $c_ro++;
        $linha_ro = mysql_fetch_assoc($res_ro);
    }
    $c_ro_marcos=$c_ro;
    
    

$res = mysql_query($sql) or die("Erro seleção - linha - meta ");
$c = 0; //total de registros
//pega a primeira linha do resultado
$linha = mysql_fetch_assoc($res);


//enquanto houver linha
while($linha){
    $c++;                   //incrementa o total de linhas;
    

            $sql2 = "SELECT * FROM codigo,lote,itens2
                    WHERE codigo.id_cod='{$linha[id_cod]}' and lote.id_lote='{$linha[id_lote]}' and codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote ORDER BY orgao ASC, codigo ASC, lote ASC";

                //echo "$sql";
                //die;
                $res2 = mysql_query($sql2) or die("erro sql2");
                $linha2 = mysql_fetch_assoc($res2);
                $vo = 0;
                $ll = 0;

                while ($linha2){
               
                    $vo += $linha2[vofertado];
                    $ll += $linha2[lucro_liquido];
                    //$linha2 = mysql_fetch_assoc($res2);
                    $linha2 = mysql_fetch_assoc($res2);
                }
                $lucrogeral_marcos += $ll/$linha[validade_rp];
                $vogeral_marcos += $vo;
                

    //pega a próxima linha
    $linha = mysql_fetch_assoc($res);

    }

$sql = "SELECT *
            FROM codigo inner join lote
            WHERE codigo.id_cod=lote.id_cod
                    and codigo.licitante='Marcos.cruz'
                    and ((codigo.tipo_licitacao='AT') or (codigo.tipo_licitacao='DL') or (codigo.tipo_licitacao='CC'))
                    and (YEAR(lote.adj_data) = '$v[0]')
                    and (MONTH(lote.adj_data) = '$v[1]')
                    and lote.adj_data !='0000-00-00'
                        
                        ORDER BY codigo.data";



$res = mysql_query($sql) or die("Erro seleção - linha - meta ");
//$v = 0; //conterá a somatória dos valores
$c = 0; //total de registros
//pega a primeira linha do resultado
$linha_at = mysql_fetch_assoc($res);

//enquanto houver linha
while($linha_at){
    $c++;                   //incrementa o total de linhas;
    //$v += $linha[valor];    //incrementa a $v o campo valor
 
            $sql2 = "SELECT * FROM codigo,lote,itens2
                    WHERE codigo.id_cod='{$linha_at[id_cod]}' and lote.id_lote='{$linha_at[id_lote]}' and codigo.id_cod=lote.id_cod and lote.id_lote=itens2.id_lote and ((codigo.tipo_licitacao='AT') or (codigo.tipo_licitacao='DL') or (codigo.tipo_licitacao='CC')) ORDER BY orgao ASC, codigo ASC, lote ASC";


                //echo "$sql";
                //die;
                $res2 = mysql_query($sql2) or die("erro sql2");
                $linha2 = mysql_fetch_assoc($res2);
                $vo_at = 0;
                $ll_at = 0;

                while ($linha2){
               
                    $vo_at += $linha2[vofertado];
                    $ll_at += $linha2[lucro_liquido];
                    //$linha2 = mysql_fetch_assoc($res2);
                    $linha2 = mysql_fetch_assoc($res2);
                }
                $lucrogeral_at_marcos += $ll_at;
                $vogeral_at_marcos += $vo_at;
                
          

    $linha_at = mysql_fetch_assoc($res);
}
    //echo "$_POST[licitante]";
    $sql = "Select * from usuarios where usuario='Marcos.cruz'";
    $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
    $usuarios = mysql_fetch_assoc($res); 

    //echo $c;
    //echo $usuarios[meta_qtde];
    if ($number>($usuarios[montante_adj])){
        $OK_ADJ="<font color='limegreen'>OK";
    }
    else{
        $OK_ADJ="<font color='orangered'>NÃO ATINGIDO";
    }

                    
                   
                    $sql = "SELECT *
                                    FROM codigo inner join lote
                                    WHERE codigo.id_cod=lote.id_cod
                                            and codigo.licitante='Marcos.cruz'
                                            and (YEAR(codigo.data) = '$v[0]')
                                            and (MONTH(codigo.data) = '$v[1]')
                                            and lote.colocacao !=''
                                            and lote.colocacao !='Cancelada/Suspensa'
                                            and lote.colocacao !='Desclassificado'
                                            and lote.colocacao !='Reaberto'
                                            and lote.colocacao !='Rescindido contrato/ata'
                                                GROUP BY codigo.codigo
                                                ORDER BY codigo.data";
                                            $res = mysql_query($sql) or die("Erro seleção - linha - meta ");
                    
                        $linha = mysql_fetch_assoc($res);
                        //$v = 0; //conterá a somatória dos valores
                        $c = 0; //total de registros
                        while($linha){
                            $c++;
                                $linha = mysql_fetch_assoc($res);
                                
                        }
                       
    //echo "$_POST[licitante]";
    $sql = "Select * from usuarios where usuario='Marcos.cruz'";
    $res = mysql_query($sql) or die("Erro seleção - usuarios - meta ");
    $usuarios = mysql_fetch_assoc($res); 

    //echo $c;
    //echo $usuarios[meta_qtde];
    if ($c>($usuarios[meta_qtde])){
        $OK_QTDE="<font color='limegreen'>OK";
    }
    else{
        $OK_QTDE="<font color='orangered'>NÃO ATINGIDO";
    }


?>