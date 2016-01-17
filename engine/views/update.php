<h1>Modifier une entrée</h1>

<form>
<?php
		var_dump($this->datagrid);
			for($i = 0; $i <= count($this->datagrid->column) - 1; $i++ ){
				echo "<p>";
				if($this->datagrid->column[$i] == 'category_id'){
					echo "category";
				}else{
					echo $this->datagrid->column[$i];
				}
				echo "</p>";
			}
			echo "<th>maj</th>";
		?>