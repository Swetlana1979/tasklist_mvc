<a href="index.php">Главная</a> 
<br>
<h1>Пользователь номер <?echo $id_user?></h1>
    <div class="n">
	ФИО: <?echo $user['name']?>
    </div>
    <br/>
    <div class="n">Пол:<?echo ($user['gender']=='j')?'ж':'м'?></div>
    <br/>
    <div class="n">
	Дата рождения(ДД.ММ.ГГГГ):<?$mUser = M_User::Instance();
	$date=$mUser->reverse_date($user['date']);
	echo $date;?>
    </div>
    <br/>
    <div class="n">
	Номер телефона:<?echo $user['phone']?>
    </div>
		
