<h2>Vos données</h2>

<?php
echo "<pre>";
var_dump($this->datagrid->query->database->config['schema']['table_data']);
echo "</pre>";

echo "<br>";
echo "<div class=\"bloc-filter\">";
echo "<p>Nombre total d'entrée : <b>";
print_r($this->datagrid->query->totaldata['nbrarticle']."</b></p>");
echo "</div>";
echo "<div class=\"bloc-filter\">";
if(($this->url['p'] - 2) >= 1){
    echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" . $this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=" . ($this->datagrid->url['p'] - 1) ."\">&laquo</a>";
}
if($this->url['p'] == '1') {
    echo "<a class=\"page-link current\">1</a>";
}else {
    echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" .$this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=1\">1</a>";
}
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
if($this->url['p'] == $this->datagrid->query->nbrpage) {
    echo "<a class=\"page-link current\">" . $this->datagrid->query->nbrpage . "</a>";
}else{
    echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" . $this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=" . $this->datagrid->query->nbrpage . "\">" . $this->datagrid->query->nbrpage . "</a>";
}
if(($this->url['p'] +2) <= $this->datagrid->query->nbrpage){
    echo "<a class=\"page-link\" href=\"index.php?ordercolumn=" . $this->url['ordercolumn'] . "&order=" . $this->datagrid->url['order'] . "&tot=" . $this->datagrid->url['tot'] . "&p=" . ($this->datagrid->url['p'] + 1) ."\">&raquo</a>";
}
echo "</div>";
?>
<div class="bloc-filter">
    <p style="float: left;display: block;">Nombre par page &nbsp; </p>
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

<table class="data">

    <thead>
    <?php
    for ($i = 0; $i <= count($this->datagrid->column) - 1; $i++) {
        echo "<th>";
        if ($this->datagrid->column[$i] == $this->datagrid->query->database->config['schema']['table_data_categoryid']) {
            echo "category";
        } elseif($this->url['ordercolumn'] == $this->datagrid->column[$i]) {
            if($this->datagrid->url['order'] == 'desc'){
                echo "<a href=\"index.php?ordercolumn=" . $this->datagrid->column[$i] . "&order=asc&tot=" . $this->datagrid->url['tot'] . "&p=1\">" . $this->datagrid->column[$i] . "<img style=\"margin:0;max-width:33px;float: right;\" src=\"assets/img/arrow_top.png\"></a>";
            }else{
                echo "<a href=\"index.php?ordercolumn=" . $this->datagrid->column[$i] . "&order=desc&tot=" . $this->datagrid->url['tot'] . "&p=1\">" . $this->datagrid->column[$i] . "<img style=\"margin:0;max-width:33px;float: right;\" src=\"assets/img/arrow_bottom.png\"></a>";
            }
        }else{
            echo "<a href=\"index.php?ordercolumn=" . $this->datagrid->column[$i] . "&order=asc&tot=" . $this->datagrid->url['tot'] . "&p=1\">" . $this->datagrid->column[$i] . "</a>";
        }
        echo "</th>";


    }
    echo "<th>Action</th>";
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
        if ($this->datagrid->column[$i] == $this->datagrid->query->database->config['schema']['table_data_categoryid']) {
            echo "<select name=\"category_id\" style=\"height: 39px;margin-top: 1px;\">";
            echo "<option value=\"\">Toute</option>";
            foreach ($this->datagrid->category as $key => $value) {
                if($this->datagrid->category[$key]['id'] == $this->url['category_id']){
                    echo "<option selected value=\"" . $this->datagrid->category[$key][$this->datagrid->query->database->config['schema']['table_category_id']] . "\">" . $this->datagrid->category[$key][$this->datagrid->query->database->config['schema']['table_category_name']] . "</option>";
                }else{
                    echo "<option value=\"" . $this->datagrid->category[$key][$this->datagrid->query->database->config['schema']['table_category_id']] . "\">" . $this->datagrid->category[$key][$this->datagrid->query->database->config['schema']['table_category_name']] . "</option>";
                }
            }
            echo "</select>";
        } else {
            echo "<input value=";
            if(isset($this->url[$this->datagrid->column[$i]])){
                echo "\"".$this->url[$this->datagrid->column[$i]]."\"";
            }else{
                echo "\"\"";
            }
            echo "type=\"text\" placeholder=\"Recherche : ".$this->datagrid->column[$i]."\" name=\"" . $this->datagrid->column[$i] . "\"></td>";
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
                        echo "<td>" . $this->datagrid->category[$c][$this->datagrid->query->database->config['schema']['table_category_name']] . "</td>";
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
