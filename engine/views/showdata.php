<h2>Vos données</h2>

<?php
echo "<pre>";
//var_dump($this->datagrid->url['where']);
//var_dump($GLOBALS);
echo "</pre>";

echo "<br>";

//". !empty($this->datagrid->url['where'])? $this->datagrid->url['where']:''."
echo "<div class=\"bloc-filter\">";
if(($this->url['p'] - 2) >= 1){
    echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" . $this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=" . ($this->datagrid->url['p'] - 1) ."\">&laquo</a>";
}
echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" . $this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=1\">1</a>";

for ($pa = 1; $pa <= $this->datagrid->query->nbrpage; $pa++) {
    if(($pa <= $this->url['p'] + 2) && ($pa >= $this->url['p'] - 2)){
        if($pa != $this->datagrid->query->nbrpage && $pa != 1) {
            if($this->url['p'] == $pa){
                echo "<a class=\"page-link current\">".$pa."</a>";
            }else{
                echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" . $this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=" . $pa . "\">" . $pa . "</a>";
            }
        }
    }
}
echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" . $this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=" . $this->datagrid->query->nbrpage . "\">" . $this->datagrid->query->nbrpage . "</a>";
if(($this->url['p'] +2) <= $this->datagrid->query->nbrpage){
    echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" . $this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=" . ($this->datagrid->url['p'] + 1) ."\">&raquo</a>";
}
echo "</div>";
?>
<div class="bloc-filter">
    <p style="float: left;display: block;">Nombre par page</p>
<form metod="get" action="index.php" style="float: right;">
    <select name="tot" id="tot">
        <?php
        foreach ($this->validetot as $key => $value) {
            echo "<option ";
            if ($this->url['tot'] == $value) {
                echo "selected";
            }
            echo " value=\"" . $value . "\">" . $value . "</option>";
        }
        ?>
    </select>
</form>
</div>
<div class="bloc-filter">
<a href="index.php?method=add">Ajouter une nouvelle entrée <img src="assets/img/new.png"></a>
</div>
<div class="bloc-filter">
<a href="index.php?method=editcat">Modifier les catégories</a>
</div>
<table class="data">

    <thead>
    <?php
    //var_dump($this->datagrid);
    for ($i = 0; $i <= count($this->datagrid->column) - 1; $i++) {
        echo "<th>";
        if ($this->datagrid->column[$i] == 'category_id') {
            echo "category";
        } elseif($this->url['ordercolumn'] == $this->datagrid->column[$i]) {
            if($this->datagrid->url['order'] == 'desc'){
                echo "<a href=\"index.php?ordercolumn=" . $this->datagrid->column[$i] . "&order=asc&tot=" . $this->datagrid->url['tot'] . "&p=1\">" . $this->datagrid->column[$i] . "</a>";
            }else{
                echo "<a href=\"index.php?ordercolumn=" . $this->datagrid->column[$i] . "&order=desc&tot=" . $this->datagrid->url['tot'] . "&p=1\">" . $this->datagrid->column[$i] . "</a>";
            }
        }else{
            echo "<a href=\"index.php?ordercolumn=" . $this->datagrid->column[$i] . "&order=asc&tot=" . $this->datagrid->url['tot'] . "&p=1\">" . $this->datagrid->column[$i] . "</a>";
        }
        echo "</th>";


    }
    echo "<th>maj</th>";
    ?>
    </thead>
    <tbody>
    <?php
    echo "<tr>";
    echo "<form method=\"GET\" action=\"index.php\">";
    echo "<input hidden name=\"method\" value=\"showdata\">";
    echo "<input hidden name=\"action\" value=\"search\">";
    echo "<input hidden name=\"tot\" value=\"".$this->datagrid->url['tot']."\">";
    for ($i = 0; $i <= count($this->datagrid->column) - 1; $i++) {
        echo "<td>";
        if ($this->datagrid->column[$i] == 'category_id') {
            echo "<select name=\"category_id\" style=\"height: 39px;margin-top: 1px;\">";
            echo "<option value=\"\">Toute</option>";
            foreach ($this->datagrid->category as $key => $value) {

                echo "<option value=\"" . $this->datagrid->category[$key]['id'] . "\">" . $this->datagrid->category[$key]['name'] . "</option>";
            }
            echo "</select>";
        } else {
            echo "<input value=\"\" type=\"text\" placeholder=\"Recherche : ".$this->datagrid->column[$i]."\" name=\"" . $this->datagrid->column[$i] . "\"></td>";
        }

    }
    echo "<td><input type=\"submit\"></td>";
    echo "</form>";
    echo "</tr>";

    for ($i = 0; $i <= count($this->datagrid->data) - 1; $i++) {
        $in = 0;
        echo "<tr>";
        while ($in != count($this->datagrid->column)) {
            $column = $this->datagrid->column[$in];

            if ($column == 'category_id') {
                for ($c = 0; $c <= count($this->datagrid->category) - 1; $c++) {
                    if ($this->datagrid->category[$c]['id'] == $this->datagrid->data[$i]->$column) {
                        echo "<td>" . $this->datagrid->category[$c]['name'] . "</td>";
                    }
                }
            } else {
                echo "<td>" . $this->datagrid->data[$i]->$column . "</td>";
            }
            $in++;
        }
        echo "<td class=\"backyellow\"><a href=\"index.php?method=update&article_id=" . $this->datagrid->data[$i]->id . "\"><img src=\"assets/img/edit.png\"></a><a href=\"index.php?action=del&article_id=" . $this->datagrid->data[$i]->id . "\" onclick=\"return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));\"><img src=\"assets/img/del.png\"></a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<script>
    jQuery(function ($) {
        $('#tot').on('change', function (e) {
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
