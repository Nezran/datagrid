<h2>Modifier vos catégories</h2>
<a href="index.php?method=editcat&action=addcat" style="width: 100%;float: left;margin: 0 0 0 20px"><img style="max-width: 18px" src="assets/img/new.png">Ajouter une nouvelle catégorie</a>
<form action="index.php?method=editcat" method="post" class="form-data">
    <input type="hidden" name="action" value="updatecat">
<?php
//var_dump($this->datagrid->category[0]['id']);

foreach($this->datagrid->category as $key => $value){
    echo "<p>".$this->datagrid->category[$key]['id']." &nbsp;";
    echo "<input value=\"".$this->datagrid->category[$key]['name']."\" name=\"".$this->datagrid->category[$key]['id']."\">";
    echo "<a href=\"index.php?method=editcat&action=delcat&category_id=".$this->datagrid->category[$key]['id']."\"><img src=\"assets/img/del.png\"></a></p>";
}
?>
    <input type="submit">
</form>
