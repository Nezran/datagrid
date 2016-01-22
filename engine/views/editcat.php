<h2>Modifier vos catégories</h2>
<a href="index.php?method=editcat&action=addcat">Ajouter une nouvelle catégorie</a>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="updatecat">
<?php
//var_dump($this->datagrid->category[0]['id']);

foreach($this->datagrid->category as $key => $value){
    echo "<p>".$this->datagrid->category[$key]['id']."";
    echo "<input value=\"".$this->datagrid->category[$key]['name']."\" name=\"".$this->datagrid->category[$key]['id']."\">";
    echo "<a href=\"index.php?method=editcat&action=delcat&category_id=".$this->datagrid->category[$key]['id']."\">Supprimer</a></p>";
}
?>
    <input type="submit">
</form>
