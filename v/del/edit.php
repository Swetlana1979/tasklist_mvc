<?/*Шаблон редактирование записи
=======================
*/?>
	<a href="index.php">Главная</a> 
	<h1>Пользователь номер <?echo $id_user?></h1>
	<?php if($error) { ?>
		<b style="color: red;">Заполните все поля!</b>
	<? } ?>
	<form action="index.php?act=edit&id=<?echo $id_user?>" method="post">
		<div class="n">
		    <label for="name">ФИО:</label>
		</div>
		<div class="enter">
		    <input type="text" name="name" id="name" value="<?echo "".$a_name?>"/></div>
		<br/>
		<br/>
		<?php
		if($a_gender=="m"){
		    $m="selected";
		    $j="";
		}else{
		    $j="selected";
		    $m="";
			}
		?>
		<div class="n"><label for="gender">Пол:</label></div>
		    <div class="enter">
		        <select name="gender">
		            <option  <?echo $m?> value="m">м</option>
			        <option <?echo $j?> value="j">ж</option>
			    </select>
			</div>
		<br/>
		<br/>
		<div class="n">
		    <label for="datepicker">Дата рождения(ДД.ММ.ГГГГ):</label>
		</div>
		<div class="enter">
		    <input type="text" name="datepicker" id="datepicker" value="<?echo $a_date?>"/>
		</div><!--<input type="text" name="date" id="date" value="<?//echo $a_date?>"/>-->
		<br/>
		<br/>
		<div class="n">
		    <label for="phone">Номер телефона(8(хххх)хх-хх-хх):</label>
		</div>
		<div class="enter">
		    <input type="text" name="phone" id="phone" value="<?echo $a_phone?>"/>
		</div>
		<br/>
		
		<br/>
		<input type="submit" id="sub" value="Сохранить" class="button"/>
	</form>
	
    
	
