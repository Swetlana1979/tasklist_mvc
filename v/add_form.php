<div class = "container">
	<h2>Добро пожаловать, <span><?php echo $_SESSION['session_login'];?>! </span></h2>
	<p><a href = "index.php?act=logout">Выйти</a> из системы</p>
	<h1>Task list</h2>
	<div id = 'add'>
		<form id = 'add_description' name = 'add_description' action = "index.php?act=add" method = "post">
			<input type = 'text' name = 'description' id = 'description'>
			<input type = 'submit' id = 'add_desc' name = 'add_desc'  class = 'sub' value = "ADD TASK"></form>
			<form id = 'del_all' name = 'del_all' action = "index.php?act=delete_ready" method = "post"> <input type = 'submit' id = 'del' name = 'sub' class = 'sub' value = "REMOVE ALL">
			<input type = 'submit' id = 'ready' name='sub' class='sub' value="READY ALL">
		</form>
	</div>
</div>