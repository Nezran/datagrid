<h1>Page d'accueil de l'application</h1>

<table border="1">
	<caption>Table 1</caption>
	<thead>
	<tr>
		<?php
			for($i = 0; $i <= count($this->column) - 1; $i++ ){
				echo "<th>";
				echo $this->column[$i];
				echo "</th>";
			}

		?>
	</tr>
	</thead>
	<tbody>
	<?php

	foreach ($this->data as $key) {
		# code...
		echo "<tr>";
		echo "<td>".$key->id."</td>";
		echo "<td>".$key->title."</td>";
		echo "<td>".$key->category."</td>";
		echo "<td>".$key->description."</td>";
		echo "</tr>";
	}

	
	?>

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</tbody>
</table>
