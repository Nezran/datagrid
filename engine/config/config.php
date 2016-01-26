<?php
return array(
	'db' => array(
		'host'		=> 'localhost',
		'user'		=> 'root',
		'password'	=> '',
		'dbname'	=> 'datagrid',
	),
	'schema' => array(
		// Votre table qui contient vos données
		'table_data'		=> 'article',
		// L'id de votre table avec les données
		'table_data_id'		=> 'id',
		// La clé étrangère qui sera lié à la table catégorie
		'table_data_categoryid' => 'category_id',
		// Le nom de votre table categorie
		'table_category'	=> 'category',
		// L'id de la table category
		'table_category_id'	=> 'id',
		// Le champ de votre table categorie qui contient le nom de la catégorie
		'table_category_name' => 'name',
	),
);
?>
