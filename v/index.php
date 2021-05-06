    <?include_once('add_form.php')?>
    <h1>Список задач</h1>
   
	
	<?if(!empty($task)){?>
		<div class='container'><table><tr><td>№</td><td>description</td><td>created_at</td><td>status</td></tr>
		<? foreach($task as $key=>$value){
			echo $value;
		}
		?>		
		</table>
		</div>
	<?}?>	
    
    <br>
    

			
			
			
			
			
	        
			
