    
	<?if(empty($_SESSION['session_login'])){
		include_once('form.php');
	} else {
		include_once('add_form.php');
	}
	?>
   
   	<?if(!empty($task)){?>
	    
		<div class='container'>
		 <table><tr><td>№</td><td>description</td><td>created_at</td><td>status</td><td></td></tr>
		<? foreach($task as $key=>$value){
			echo $value;
		}
		?>		
		</table>
		</div>
	<?}?>	
    
    <br>
    

			
			
			
			
			
	        
			
