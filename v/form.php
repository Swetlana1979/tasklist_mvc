<?php 
	if(!empty($_GET['login'])){
		echo"<h2> Здравствуйте новый пользователь ".$_GET['login'].", авторизуйтесь </h2>";
	} 
?>
<div class="container mregister">
	<div id="login">
	<h1>Авторизация</h1>
	<form action="index.php?c=User&&act=login" id="registerform" method="post" name="registerform">
		<p><label for="user_pass">Имя пользователя<br>
		<input class="input" id="login" name="login"size="20" type="text" value="<? echo $_GET['login']?>"></label></p>
		<p><label for="user_pass">Пароль<br>
		<input class="input" id="password" name="password"size="32"   type="password" value="<? echo $_GET['password']?>"></label></p>
		<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Войти"></p>
	</form>
	</div>
</div>