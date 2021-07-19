<?php include("principal.html");?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> PRODUTO </title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<script>
			function ValidarNome(pNome) {
				if (pNome == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarCodigo(pCodigo) {
				if (pCodigo == "" || pCodigo <= 0) {
					return false;
				} else{
					return true;
				}
			}
			function ValidarFab(pFab) {
				if (pFab == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarCat(pCat) {
				if (pCat == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarTipo(pTipo) {
				if (pTipo == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarPreco(pPreco) {
				if (pPreco == "" || pPreco <= 0) {
					return false;
				} else{
					return true;
				}
			}
			function ValidarQuant(pQuant) {
				if (pQuant == "" || pQuant < 0) {
					return false;
				} else{
					return true;
				}
			}
			function ValidarPeso(pPeso) {
				if (pPeso == "" || pPeso <= 0) {
					return false;
				} else{
					return true;
				}
			}
			function ValidarDesc(pDesc) {
				if (pDesc == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarImg(pImg) {
				if (pImg == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarInc(pInc) {
				if (pInc == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarAtivo(pAtivo) {
				if (pAtivo == "") {
					return false;
				} else{
					return true;
				}
			}

			function ValidaForm() {
				let obj2Form = document.getElementById("cadastro");
				console.log("objForm2: " + document.getElementById("cadastro").innerText);
				let nome = document.getElementById("nome").value;
				let codigoBarra = document.getElementById("codigoBarra").value;
				let fabricante = document.getElementById("fabricante").value;
				let categoria = document.getElementById("categoria").value;
				let tipo = document.getElementById("tipo").value;
				let preco = document.getElementById("preco").value;
				let quantEstoque = document.getElementById("quantEstoque").value;
				let peso = document.getElementById("peso").value;
				let descricao = document.getElementById("descricao").value;
				let imagem = document.getElementById("imagem").value;
				let dataInclusao = document.getElementById("dataInclusao").value;
				let ativo = document.getElementById("ativo").value;

				let erro = 1;
				let msgErro = "";
			
				if (!ValidarNome(nome)) {
					msgErro += "nome nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarCodigo(codigoBarra)) {
					msgErro += "Código de Barra invalido \n";
					erro = 0;
				}
				if (!ValidarFab(fabricante)) {
					msgErro += "Fabricante nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarCat(categoria)) {
					msgErro += "Categoria invalido \n";
					erro = 0;
				}
				if (!ValidarTipo(tipo)) {
					msgErro += "Tipo nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarPreco(preco)) {
					msgErro += "Preço invalido \n";
					erro = 0;
				}
				if (!ValidarQuant(quantEstoque)) {
					msgErro += "Quantidade em estoque nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarPeso(peso)) {
					msgErro += "Peso invalido \n";
					erro = 0;
				}
				if (!ValidarDesc(descricao)) {
					msgErro += "Descrição nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarInc(dataInclusao)) {
					msgErro += "Data de Inclusão invalido \n";
					erro = 0;
				}
				if (!ValidarAtivo(ativo)) {
					msgErro += "Ativo nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarImg(imagem)) {
					msgErro += "Imagem invalido \n";
					erro = 0;
				}
				
				if(erro == 1){
					EnviarForm();
				} else{
					document.getElementById("mensagem").innerText = msgErro;
					let modal = document.querySelector('.modalIncluir2');
					modal.style.display='block';
				}
			}

			function EnviarForm() {
				let xmlHttp = new XMLHttpRequest();
				let nome = document.getElementById("nome").value;
				let codigoBarra = document.getElementById("codigoBarra").value;
				let fabricante = document.getElementById("fabricante").value;
				let categoria = document.getElementById("categoria").value;
				let tipo = document.getElementById("tipo").value;
				let preco = document.getElementById("preco").value;
				let quantEstoque = document.getElementById("quantEstoque").value;
				let peso = document.getElementById("peso").value;
				let descricao = document.getElementById("descricao").value;
				let imagem = document.getElementById("imagem").value;
				let dataInclusao = document.getElementById("dataInclusao").value;
				let ativo = document.getElementById("ativo").value;

				xmlHttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							console.log("Retornou: " + this.responseText);
							document.getElementById("msgErro").value = this.responseText;
						}
				}
					xmlHttp.open("GET", "http://localhost/3DAW/AV2/incluir.php?nome=" + nome +
							"&codigoBarra=" + codigoBarra + "&fabricante=" + fabricante + "&categoria=" + categoria + "&tipo=" + tipo + "&preco=" + preco + "&quantEstoque=" + quantEstoque + "&peso=" + peso
							+ "&descricao=" + descricao + "&imagem=" + imagem + "&dataInclusao=" + dataInclusao + "&ativo=" + ativo, true);

					xmlHttp.send();
					console.log("Requisição enviada.");

					document.getElementById('nome').value='';
					document.getElementById('codigoBarra').value='';
					document.getElementById('fabricante').value='';
					document.getElementById('categoria').value='';
					document.getElementById('tipo').value='';
					document.getElementById('preco').value='';
					document.getElementById('quantEstoque').value='';
					document.getElementById('peso').value='';
					document.getElementById('descricao').value='';
					document.getElementById('imagem').value='';
					document.getElementById('dataInclusao').value='';
					document.getElementById('ativo').value='';

					let modal = document.querySelector('.modalIncluir1');
					modal.style.display='block';
			}

			function Sair1(){
				let modal = document.querySelector('.modalIncluir1');
				modal.style.display='none';
			}
			function Sair2(){
				let modal = document.querySelector('.modalIncluir2');
				modal.style.display='none';
				document.getElementById("mensagem").innerText = "";
			}

		</script>
    </head>
    <body>
        <br><br>
		<div style="text-align:center;">
			<p> Cadastrar Produto </p>
			<form action="" id="cadastro">
				Nome: <input type="text" id="nome">
				<br><br>
				Código de barras: <input type="text" id="codigoBarra">
				<br><br>
				Fabricante: <input type="text" id="fabricante">
				<br><br>
				Categoria: <input type="text" id="categoria">
				<br><br>
				Tipo: <input type="text" id="tipo">
				<br><br>
				Preço: <input type="text" id="preco">
				<br><br>
				Quantidade em estoque: <input type="text" id="quantEstoque">
				<br><br>
				Peso(gramas): <input type="text" id="peso">
				<br><br>
				descrição: <input type="text" id="descricao">
				<br><br>
				Imagem: <input type="text" id="imagem">
				<br><br>
				Data de inclusão: <input type="text" id="dataInclusao">
				<br><br>
				Ativo: <input type="text" id="ativo">
				<br><br>
				<br><br>
				<input type="button" value="Incluir Produto" onclick="ValidaForm();">
			</form>
		</div>
		<div class="modalIncluir1">
			<p> Produto incluído com sucesso </p>
			<input type="button" value="OK" onclick="Sair1();">
        </div>
		<div class="modalIncluir2">
			<p> Produto não incluído </p>
			<p id="mensagem"> </p>
			<input type="button" value="OK" onclick="Sair2();">
        </div>
    </body>
</html>