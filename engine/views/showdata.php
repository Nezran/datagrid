<h1>Page d'accueil de l'application</h1>

<table border="1">
	<caption>Table 1</caption>
	<thead>
		<?php
		var_dump($this->datagrid);
			for($i = 0; $i <= count($this->datagrid->column) - 1; $i++ ){
				echo "<th>";
				if($this->datagrid->column[$i] == 'category_id'){
					echo "category";
				}else{
					echo $this->datagrid->column[$i];
				}
				echo "</th>";
			}
			echo "<th>maj</th>";
		?>
	</thead>
	<tbody>
	<?php
		for($i = 0; $i <= count($this->datagrid->data) - 1; $i++ ){
			$in = 0;
			echo "<tr>";		
			while($in != count($this->datagrid->column)){
				$column = $this->datagrid->column[$in];

				if($column == 'category_id'){
					for ($c=0; $c <= count($this->datagrid->category) - 1; $c++) { 
						if($this->datagrid->category[$c]['id'] == $this->datagrid->data[$i]->$column){
							echo "<td>".$this->datagrid->category[$c]['name']."</td>";
						}
					}					
				}else{
					echo "<td>".$this->datagrid->data[$i]->$column."</td>";
				}
				$in++;
			}
			echo "<td><a href=\"index.php?method=update&article_id=".$this->datagrid->data[$i]->id."\">Update</a> - <a href=\"index.php?method=del&article_id=".$this->datagrid->data[$i]->id."\">Delete</a></td>";
			echo "</tr>";
		}	
	?>	
	</tbody>
</table>
