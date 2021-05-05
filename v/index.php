
    <?include_once('add_form.php')?>
    <h1>Список задач</h1>
    <ul>
	<? 
	
	function Reverse_date($date){
		$s = substr($date,3,1);
        $mass=explode('-',$date);
		$mass=array_reverse($mass);
		$date=implode('.',$mass);
		return $date;
	}
	
	function Output($arr){
		if(!empty($arr)){
			echo"<div class='container'><table><tr><td>№</td><td>description</td><td>created_at</td><td>status</td></tr>";
			for($i=0; $i<count($arr); $i++){
				$status=$arr[$i]['3'];
				$read_stat=($status=='готово')? "NO READY":"READY";
				$created_at=$arr[$i]['2'];
				$dateTime=explode(" ", $created_at);
				$time=$dateTime[1];
				$date=Reverse_date($dateTime[0]);
				$created_at=$date." ".$time;
				$str="<tr><form class=blok name='task_form".$i."' action='index.php?act=delete_ready' method='post'><td>".
				$arr[$i]['0']."</td><td>".$arr[$i]['1']."</td><td>".$created_at."</td><td>".$arr[$i]['3'].
				"</td></tr><tr><td>
				<input type='submit' name='sub' class='sub' value='".$read_stat."'></td><td>
				<input type='hidden' id='stat' name='stat' size='10' width='10' color='red' value='".$status."'></td><td>
				<input type='submit' name='sub' class='sub' value='DELETE'></td><td>
				<input type='hidden' name='num' value='".$arr[$i]['0']."'></td>
				</form></tr>";
				echo $str;				
			}
			echo"</table></div>";
		}
	}
	Output($task);
	?>		
    </ul>
    <br>
    <br>
    

			
			
			
			
			
	        
			
