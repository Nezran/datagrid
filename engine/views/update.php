<h1>Modifier une entrée</h1>


<form action="index.php?method=showdata" method="post">
    <?php
    for ($i = 0; $i <= count($this->datagrid->column) - 1; $i++) {
        echo "<p>";
        if ($this->datagrid->column[$i] == 'category_id') {
            echo "category";
        } else {
            echo $this->datagrid->column[$i];
        }
        $col = $this->datagrid->column[$i];
        if ($col == 'category_id') {
            echo "<select name=\"category_id\">";
            for ($c = 0; $c <= count($this->datagrid->category) - 1; $c++) {
                if ($this->datagrid->category[$c]['id'] == $this->datagrid->detail[0]->category_id) {
                    echo "<option value=\"" . $this->datagrid->category[$c]['id'] . "\" selected>" . $this->datagrid->category[$c]['name'] . "</option>";
                } else {
                    echo "<option value=\"" . $this->datagrid->category[$c]['id'] . "\">" . $this->datagrid->category[$c]['name'] . "</option>";
                }
            }
            echo "</select>";
        } else {
            if ($this->datagrid->column[$i] == "id") {
                echo "<input value=\"" . $this->datagrid->detail[0]->$col . "\" type=\"\" name=\"" . $this->datagrid->column[$i] . "\" readonly>";
            } else {
                echo "<input value=\"" . $this->datagrid->detail[0]->$col . "\" type=\"\" name=\"" . $this->datagrid->column[$i] . "\">";
            }
        }
        echo "</p>";
    }
    ?>
    <input type="submit" value="mettre à jour">
</form>
