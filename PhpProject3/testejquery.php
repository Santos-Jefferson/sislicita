<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exibir e ocultar conteúdo com jQuery</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
 $('#conteudo').hide();
 $('#mostrar').click(function(event){
 event.preventDefault();
 $("#conteudo").show("fast");
 });
 $('#ocultar').click(function(event){
 event.preventDefault();
 $("#conteudo").hide("fast");
 });
 });
</script>

<p>

<a href="#" id="mostrar">Exibir conteúdo</a> |

<a href="#" id="ocultar">Ocultar conteúdo</a>

</p>
 

<div id="conteudo" style="background-color:; padding:5px; margin:0; width:300px;">


</div>
