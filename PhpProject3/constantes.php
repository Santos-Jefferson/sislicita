<?php
//valores sedex para envio de docs e contratos/atas em cada estado do Brasil - conforme tabela Correios
$vsedex_rj_mg_ms = 36.53;
$vsedex_pr = 14.20;
$vsedex_rs_sc_sp = 28.54;
$vsedex_df_es_mt = 42.27;
$vsedex_go_to = 45.80;
$vsedex_ba = 49.22;
$vsedex_al_se = 53.50;
$vsedex_ac_am_ce_ma_pa_pb_pe_pi_rn_ro = 58.85;
$vsedex_ap = 63.24;
$vsedex_rr = 69.12;

//Valor aproximado de custos de cartório ao enviar docs de habilitação 
$cart=100;

//CALCULO FRETE - BASE CORREIOS
//CALCULO LOCAL - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_local_0a1 = 8.37;
$vf_pac_local_1a5 = 12.58;
$vf_pac_local_5a10 = 15.46;
$vf_pac_local_10a20 = 21.98;
$vf_pac_local_20a30 = 30.04;
$vf_seg_local = 1/100;
$vf_adic_local = 4.77;
                                        
//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 1(SP,SC,RS) - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f1_0a1 = 10.82;
$vf_pac_f1_1a5 = 16.24;
$vf_pac_f1_5a10 = 23.46;
$vf_pac_f1_10a20 = 38.84;
$vf_pac_f1_20a30 = 55.70;
$vf_seg_f1 = 1/100;
$vf_adic_f1 = 8.86;
                                        
//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 2(MG,MS,RJ - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f2_0a1 = 12.02;
$vf_pac_f2_1a5 = 18.06;
$vf_pac_f2_5a10 = 27.42;
$vf_pac_f2_10a20 = 46.82;
$vf_pac_f2_20a30 = 67.55;
$vf_seg_f2 = 1/100;
$vf_adic_f2 = 10.70;
                     
//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 3(DF,ES,MT) - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f3_0a1 = 13.32;
$vf_pac_f3_1a5 = 20.01;
$vf_pac_f3_5a10 = 30.39;
$vf_pac_f3_10a20 = 51.89;
$vf_pac_f3_20a30 = 74.86;
$vf_seg_f3 = 1/100;
$vf_adic_f3 = 11.86;

//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 4(GO,TO) - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f4_0a1 = 14.74;
$vf_pac_f4_1a5 = 22.19;
$vf_pac_f4_5a10 = 36.37;
$vf_pac_f4_10a20 = 65.34;
$vf_pac_f4_20a30 = 94.92;
$vf_seg_f4 = 1/100;
$vf_adic_f4 = 14.79;
                     
//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 5(BA) - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f5_0a1 = 16.56;
$vf_pac_f5_1a5 = 24.94;
$vf_pac_f5_5a10 = 40.87;
$vf_pac_f5_10a20 = 73.43;
$vf_pac_f5_20a30 = 106.68;
$vf_seg_f5 = 1/100;
$vf_adic_f5 = 16.63;
                                        
//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 6(AL,SE) - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f6_0a1 = 17.64;
$vf_pac_f6_1a5 = 26.57;
$vf_pac_f6_5a10 = 43.53;
$vf_pac_f6_10a20 = 78.22;
$vf_pac_f6_20a30 = 113.63;
$vf_seg_f6 = 1/100;
$vf_adic_f6 = 17.71;

//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 7(AC,AM,CE,MA,PA,PB,PE,PI,RN,RO) - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f7_0a1 = 19.74;
$vf_pac_f7_1a5 = 29.44;
$vf_pac_f7_5a10 = 51.19;
$vf_pac_f7_10a20 = 94.71;
$vf_pac_f7_20a30 = 138.22;
$vf_seg_f7 = 1/100;
$vf_adic_f7 = 21.76;
                                        
//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 8(AP) - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f8_0a1 = 21.62;
$vf_pac_f8_1a5 = 32.23;
$vf_pac_f8_5a10 = 56.06;
$vf_pac_f8_10a20 = 103.71;
$vf_pac_f8_20a30 = 151.35;
$vf_seg_f8 = 1/100;
$vf_adic_f8 = 25.21;
                     
//CALCULO FRETE - BASE CORREIOS
//CALCULO FAIXA 9(RR) - FRETE SISLICITA - TABELA CORREIOS ABRIL 2012.
$vf_pac_f9_0a1 = 22.87;
$vf_pac_f9_1a5 = 34.10;
$vf_pac_f9_5a10 = 59.31;
$vf_pac_f9_10a20 = 109.72;
$vf_pac_f9_20a30 = 160.13;
$vf_seg_f9 = 1/100;
$vf_adic_f9 = 25.21;


//TAXA PEDÁGIO PARA TODOS OS ESTADOS
//taxa 01
$vf_pegadio_01 = 3.66;
//taxa 02
$vf_pegadio_02 = 2.67;


//CALCULO REGIÃO 1 (AC,AM,AP,PA,RO,RR,CE,MA,TO) - FRETE SISLICITA - TABELA TRANSPAULO 2012.
//valor cubado 0 a 30
$vf_tr_r1_vc1 = 80.50;
//valor cubado 31 a 50
$vf_tr_r1_vc2 = 100.63;
//valor cubado 50 a 100
$vf_tr_r1_vc3 = 120.75;
//valor cubado acima de 100
$vf_tr_r1_vc4 = 0.805;

//valor  seguro 1
$vf_tr_r1_seg1 = 0.5/100;
//valor  seguro 2
$vf_tr_r1_seg2 = 0.3/100;

//CALCULO REGIÃO 2 (GO,DF,MT,MS) - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
//valor cubado 0 a 30
$vf_tr_r2_vc1 = 40.25;
//valor cubado 31 a 50
$vf_tr_r2_vc2 = 48.88;
//valor cubado 50 a 100
$vf_tr_r2_vc3 = 57.50;
//valor cubado acima de 100
$vf_tr_r2_vc4 = 0.345;

//valor  seguro 1
$vf_tr_r2_seg1 = 0.2/100;
//valor  seguro 2
$vf_tr_r2_seg2 = 0.2/100;

//CALCULO REGIAL 3 (MG,ES,SP,RJ) - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
//valor cubado 0 a 30
$vf_tr_r3_vc1 = 35.65;
//valor cubado 31 a 50
$vf_tr_r3_vc2 = 41.98;
//valor cubado 50 a 100
$vf_tr_r3_vc3 = 48.30;
//valor cubado acima de 100
$vf_tr_r3_vc4 = 52.90;

//valor  seguro 1
$vf_tr_r3_seg1 = 0.2/100;
//valor  seguro 2
$vf_tr_r3_seg2 = 0.2/100;
//valor  outros 1
$vf_tr_r3_out1 = 0.44;
//valor  outros 2
$vf_tr_r3_out2 = 0.2/100;
//valor  outros 3
$vf_tr_r3_out3 = 0.15/100;
//valor  outros 4
$vf_tr_r3_out4 = 0.15/100;
//valor  outros 5
$vf_tr_r3_out5 = 1.088;

                             
//CALCULO REGIAL 4 (PR,SC,RS) - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
$vf_tr_r4_vc1 = 24.73;
//valor cubado 31 a 50
$vf_tr_r4_vc2 = 28.46;
//valor cubado 50 a 100
$vf_tr_r4_vc3 = 32.20;
//valor cubado acima de 100
$vf_tr_r4_vc4 = 52.90;

//valor  seguro 1
$vf_tr_r4_seg1 = 0.2/100;
//valor  seguro 2
$vf_tr_r4_seg2 = 0.2/100;
//valor  outros 1
$vf_tr_r4_out1 = 0.44;
//valor  outros 2
$vf_tr_r4_out2 = 0.2/100;
//valor  outros 3
$vf_tr_r4_out3 = 0.15/100;
//valor  outros 4
$vf_tr_r4_out4 = 0.15/100;
//valor  outros 5
$vf_tr_r4_out5 = 1.088;

                                             
//CALCULO REGIAL 5 (AL,BA,CE,MA,PB,PE,PI,RN,SE) - FRETE SISLICITA - TABELA TRANSPAULO 2012.                       
$vf_tr_r5_vc1 = 43.76;
//valor cubado 31 a 50
$vf_tr_r5_vc2 = 56.94;
//valor cubado 50 a 100
$vf_tr_r5_vc3 = 89.87;
//valor cubado acima de 100
$vf_tr_r5_vc4 = 0.659;

//valor  seguro 1
$vf_tr_r5_seg1 = 0.2/100;
//valor  seguro 2
$vf_tr_r5_seg2 = 0.2/100;

//DIFERENCIAL DE ALIQUOTA ENTRE OS ESTADOS - CALCULANDO SOMENTE O VALOR DEVIDO
//PARA O ESTADO DE DESTINO. (antigo) PORCENTAGEM APLICADA SOBRE O VALOR OFERTADO
// PARA OS SEGUINTES ESTADOS QUE FAZEM COBRANÇA NO SEFAZ (CE,MT,MS)
$porc_ce_mt_ms = 10;

//ESTADOS QUE SÃO 10%, DESTINO 60% = 6%
$difaliq_ac = 6;
$difaliq_al = 6;
$difaliq_am = 6;
$difaliq_ap = 6;
$difaliq_ba = 6;
$difaliq_ce = 6;
$difaliq_df = 6;
$difaliq_es = 6;
$difaliq_go = 6;
$difaliq_ma = 6;
$difaliq_ms = 6;
$difaliq_mt = 6;
$difaliq_pa = 6;
$difaliq_pb = 6;
$difaliq_pe = 6;
$difaliq_pi = 6;
$difaliq_rn = 6;
$difaliq_ro = 6;
$difaliq_rr = 6;
$difaliq_se = 6;
//$difaliq_sp = 6;
$difaliq_to = 6;

//ESTADOS QUE SÃO 6%, DESTINO 60% = 3,6%
$difaliq_mg = 3.6;
$difaliq_sp = 3.6;

//ESTADOS QUE SÃO 5%, DESTINO 60% = 3%
$difaliq_rs = 3;
$difaliq_sc = 3;

//ESTADO QUE É 7%, DESTINO 60% = 4,2%
$difaliq_rj = 4.2;

//PORCENTAGEM APLICADA PARA LUCRO SOBRE O CUSTO APROXIMADO NAS LICITAÇÕES
$porc_lucro = 21/100;
$porc_lucro2 = 15/100;
$porc_lucro3= 12/100;

//PORCENTAGEM DO IMPOSTO DO SIMPLES NACIONAL VIGENTE/ATUAL
$porc_sn = 5.93;

//LUCRO LIQUIDO MÍNIMO EM PREGÕES AT/DL e RP
$lucro_min_at_dl = 350;
$lucro_min_rp = 1000;