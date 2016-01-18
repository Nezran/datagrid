<h1>Page d'accueil de l'application</h1>


<?php
echo "<pre>";
//var_dump($this->validetot);
echo "</pre>";

for($pa=1; $pa <= $this->datagrid->query->nbrpage;$pa++){
	echo "<a href=\"index.php?ordercolumn=".$this->url['ordercolumn']."&order=".$this->datagrid->url['order']."&tot=".$this->datagrid->url['tot']."&p=".$pa."\">".$pa."</a>";

}
?>
<br>
<form metod="get" action="index.php">
	<select name="tot" id="tot">
		<?php
		foreach($this->validetot as $key => $value){
			echo "<option ";
			if($this->url['tot'] == $value){
				echo "selected";
			}
			echo " value=\"".$value."\">".$value."</option>";
		}
		?>
	</select>
</form>
<table border="1">
	<a href="index.php?method=add">Ajouter une nouvelle entrée</a>
	<caption>Table 1</caption>
	<thead>
		<?php
		//var_dump($this->datagrid);
			for($i = 0; $i <= count($this->datagrid->column) - 1; $i++ ){
				echo "<th>";
				if($this->datagrid->column[$i] == 'category_id'){
					echo "category";
				}else{
					echo "<a href=\"index.php?ordercolumn=".$this->datagrid->column[$i]."&order=".$this->datagrid->url['order']."&tot=".$this->datagrid->url['tot']."&p=".$this->url['p']."\">".$this->datagrid->column[$i]."</a>";
				}echo "</th>";


			}
			echo "<th>maj</th>";
		?>
	</thead>
	<tbody>
	<?php
	echo "<tr>";
		for($i = 0; $i <= count($this->datagrid->column) - 1; $i++ ) {
			echo "<td>";
			if ($this->datagrid->column[$i] == 'category_id') {
				echo "<select>";
				echo "<option value=\"\">Toute</option>";
				foreach ($this->datagrid->category as $key => $value) {

					echo "<option value=\"" . $value . "\">" . $this->datagrid->category[$key]['name'] . "</option>";
				}
				echo "</select>";
			} else {
				echo "<input type=\"text\" name=\"".$this->datagrid->column[$i]."\">";
			}
		}
	echo "</tr>";

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

<script>
	jQuery(function($){
		$('#tot').on('change', function(e){
			this.form.submit()
		});
	});
	/*jQuery(function($){
		$("#tot").change(function(e){

			window.location.href += "?tot="+$('#tot').val();
			e.preventDefault();
			console.log(window.location);
		});
	});*/
</script>
