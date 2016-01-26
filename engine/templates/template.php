<html>
<head>

    <link href="assets/style/template.css" rel="stylesheet" type="text/css"/>
    <script type="application/javascript" src="assets/script/jquery-2.2.0.min.js"></script>
    <script type="application/javascript" src="assets/script/script.js"></script>


</head>


<body>



<?php
if(isset($this->datagrid->query->alert)){
    echo "<div class=\"alert\">";
    echo "<a class=\"close\" href=\"#\">×</a>";
    echo "<strong>Succès ! </strong>";
    echo $this->datagrid->query->alert;
    echo "</div>";
}
?>
</div>
<div class="title">
<span class="line-left"></span><a href="index.php"><h1>Datagrid</h1></a><span class="line-right"></span>
</div>
<br>
<header>
    <div>
        <a href="index.php"><img src="assets/img/home.png">Accueil</a>
        <a href="index.php?method=editcat"> <img src="assets/img/edit.png"> Modifier les catégories</a>
        <a href="index.php?method=add"> <img src="assets/img/new.png"> Ajouter une nouvelle entrée</a>
    </div>
</header>
    <div class="content">
    <?php echo $content; ?>
    </div>
</body>


</html>

<script>
    jQuery(function ($) {
        $('.alert .close').on('click', function (e) {
            $( ".alert" ).hide("fast");
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

