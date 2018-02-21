<script language="Javascript">
function cal_vtotcusto(){
<!--calcula o vtotcusto no campo do formulário automaticamente ao ser inserido qtde e vunitcusto-->
document.getElementById("res_vtotcusto").value = '0'
var res_qtde = parseFloat(document.getElementById("res_qtde").value);
var res_vunitcusto = parseFloat(document.getElementById("res_vunitcusto").value);
document.getElementById("res_vtotcusto").value = res_qtde * res_vunitcusto;

}
function cal_vimposto(){
<!--calcula o vimposto no campo do formulário automaticamente ao ser inserido os dados necessários para o calculo-->
document.getElementById("res_imposto").value = '0'
var res_vofertado = parseFloat(document.getElementById("res_vofertado").value);
//var res_vtotcusto = parseFloat(document.getElementById("res_vtotcusto").value);
//var res_vfrete = parseFloat(document.getElementById("res_vfrete").value);
//var res_porc_lucro = parseFloat(document.getElementById("res_porc_lucro").value);
//document.getElementById("res_imposto").value = (((((res_vtotcusto + res_vfrete)* res_porc_lucro/100)+(res_vtotcusto))*6)/100);
document.getElementById("res_imposto").value = (res_vofertado * (6.75/100));
}

function cal_custo_aprox(){
<!--calcula o custo_aprox no campo do formulário automaticamente ao ser inserido os dados necessários para o calculo-->
document.getElementById("res_custo_aprox").value = '0'
var res_vtotcusto = parseFloat(document.getElementById("res_vtotcusto").value);
var res_vfrete = parseFloat(document.getElementById("res_vfrete").value);
var res_imposto = parseFloat(document.getElementById("res_imposto").value);
document.getElementById("res_custo_aprox").value = res_vtotcusto + res_vfrete + res_imposto;
}

function cal_vminofertar(){
<!--calcula o vminofertar no campo do formulário automaticamente ao ser inserido os dados necessários para o calculo-->
document.getElementById("res_vminofertar").value = '0'
var res_custo_aprox = parseFloat(document.getElementById("res_custo_aprox").value);
var res_porc_lucro = parseFloat(document.getElementById("res_porc_lucro").value);
document.getElementById("res_vminofertar").value = (((res_custo_aprox * res_porc_lucro)/100)+(res_custo_aprox));
}

function cal_vitem(){
<!--calcula o vitem no campo do formulário automaticamente ao ser inserido os dados necessários para o calculo-->
document.getElementById("res_vitem").value = '0'
var res_vofertado = parseFloat(document.getElementById("res_vofertado").value);
var res_qtde = parseFloat(document.getElementById("res_qtde").value);
document.getElementById("res_vitem").value = (res_vofertado/res_qtde);
}

function cal_vminitem(){
<!--calcula o vitem no campo do formulário automaticamente ao ser inserido os dados necessários para o calculo-->
document.getElementById("res_vminitem").value = '0'
var res_vminofertar = parseFloat(document.getElementById("res_vminofertar").value);
var res_qtde = parseFloat(document.getElementById("res_qtde").value);
document.getElementById("res_vminitem").value = (res_vminofertar/res_qtde);
}

function cal_lucro_liq(){
<!--calcula o vitem no campo do formulário automaticamente ao ser inserido os dados necessários para o calculo-->
document.getElementById("res_lucro_liq").value = '0'
var res_vofertado = parseFloat(document.getElementById("res_vofertado").value);
var res_custo_aprox = parseFloat(document.getElementById("res_custo_aprox").value);
document.getElementById("res_lucro_liq").value = (res_vofertado - res_custo_aprox);
}

</script>