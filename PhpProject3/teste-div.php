<title>Teste de Popup</title>
<script type="text/javascript">
	// abre a DIV
	function abreJanela(id){
	var obj = document.getElementById(id);
	obj.style.display='block';
}
	 
	// fecha a DIV
	function fechaJanela(id){
	var obj = document.getElementById(id);
	obj.style.display='none';
	}
	</script>
	<style type="text/css">
body {
	    background: #000000;
	}
	#popup {
	        font-family:Arial, Helvetica, sans-serif;
	        display:block;
	        position:absolute;
	        width:300px;
	        height:450px;
	        left:50%;
	        top:30px;
                border:1px solid #000000;
	        padding:6px;
	        color:#000000;
	        background: #fff;
	        z-index:300;
	       }
	#popup p{ line-height:18px}
	#popup a.fechar {
	                 color:#000033;
	                 text-align:right;
	                 float:right;
	                 text-decoration:none;
	                 font-family:Arial, Helvetica, sans-serif;
	                 width:20px;
	                 }
	#popup a:hover.fechar { color:#003399
	                      }
 
	</style>
	</head>
	 
	<body>
	 
	<a href="javascript:;" onclick="abreJanela('popup')">Abrir Popup</a>
	 
	<div id="popup">
	<a href="javascript:;" onclick="fechaJanela('popup')" class="fechar">X</a>
	<!--//aqui entra seu conteúdo-->
	<p>teste de mensagem</p>
	</div>
	</body>
