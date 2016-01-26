<h2>Ajouter une entrée</h2>
<form action="index.php?method=showdata" method="post" class="form-data">
	<input type="hidden" name="action" value="insertdata">
<?php
			for($i = 0; $i <= count($this->datagrid->column) - 1; $i++ ){
				echo "<div class=\"form-line\">";
				echo "<p>";
				if($this->datagrid->column[$i] == $this->datagrid->query->database->config['schema']['table_data_categoryid']){
					echo "category";
				}else{
					if($this->datagrid->column[$i] !=  $this->datagrid->query->database->config['schema']['table_data_id']){
						echo $this->datagrid->column[$i];
					}
					
				}
				echo "</p>";
				$col = $this->datagrid->column[$i];
				if($col == $this->datagrid->query->database->config['schema']['table_data_categoryid']){
					echo "<select name=\"category_id\">";
					for ($c=0; $c <= count($this->datagrid->category) - 1; $c++) { 
							echo "<option value=\"".$this->datagrid->category[$c][$this->datagrid->query->database->config['schema']['table_category_id']]."\">".$this->datagrid->category[$c][$this->datagrid->query->database->config['schema']['table_category_name']]."</option>";
					}
					echo "</select>";					
				}else{
					if($this->datagrid->column[$i] != $this->datagrid->query->database->config['schema']['table_data_id']){
						echo "<input value=\"\" type=\"\" name=\"".$this->datagrid->column[$i]."\">";
					}
				}
				echo "</div>";
			}
		?>
		<input type="submit" value="mettre à jour">
</form>
