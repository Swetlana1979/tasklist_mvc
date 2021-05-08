    
	<?if(empty($_SESSION['session_login'])){
		include_once('form.php');
	} else {
		include_once('add_form.php');
	}
	?>
   
   
	
	<?if(!empty($task)){?>
	    
		<div class='container'>
		 <h1>Список задач</h1>
		<table><tr><td>№</td><td>description</td><td>created_at</td><td>status</td></tr>
		<? foreach($task as $key=>$value){
			echo $value;
		}
		?>		
		</table>
		</div>
	<?}?>	
    
    <br>
    

			
			
			
			
			
	        
			
