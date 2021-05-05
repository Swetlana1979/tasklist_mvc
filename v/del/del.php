<?php 
header('HTTP/1.1 200 OK'); 
header('Refresh: 10;URL="index.php"');

/*Шаблон удаление записи*/?>
<a href="index.php">Главная</a> 
<br>
<?echo "<h4>"."Запись номер ".$id_user." успешно удалена"."</h4>" ?>
