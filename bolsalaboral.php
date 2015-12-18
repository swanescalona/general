<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template1.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name=viewport content="width=device-width, initial-scale=1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Sazón oaxaqueño</title>
<link href="_styles/bolsa.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<style type="text/css">
td img {
	display: block;
}
td img {
	display: block;
}
</style>
<link href="_styles/general.css" rel="stylesheet" type="text/css" />
<link href="_styles/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
$(document).ready(function(){
	$("#navegador li").click(function(){
		location.href = $(this).find("a").attr("href");
	});
});
</script>
<!-- InstanceBeginEditable name="head" -->
<?php
function dbcon($server,$user,$pass,$base,$query,$type){
//dbcon('localhost','root','','beltran','SELECT * FROM webpages',0);
//$type, 'array' | 'valor' | 'none'
	$link = mysql_connect($server, $user, $pass);
	mysql_set_charset("utf8");
	mysql_select_db($base);
	$result = mysql_query($query);
	switch ($type) {
	case 'array':
		$array = array();
		//$array = mysql_fetch_array($result, MYSQL_BOTH);
		//MYSQL_ASSOC, MYSQL_NUM, y MYSQL_BOTH. 
		while ($row = mysql_fetch_array ($result, MYSQL_NUM)) {
			array_push($array, $row);
		}
		mysql_free_result($result);
		break;
	case 'valor':
	   $array = mysql_result($result, 0);
	   mysql_free_result($result);
	   break;
	case 'none':
	   $array = true;
	   break;
	}
	mysql_close($link);
	return $array;
}

$receta = (!is_null($_REQUEST['receta']) ? htmlspecialchars(mysql_real_escape_string($_REQUEST['receta']), ENT_QUOTES) : 1);
$qryBolsa = "SELECT ID, `post_title`, `post_content` FROM `wp_posts` INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id INNER JOIN wp_terms ON wp_term_relationships.term_taxonomy_id = wp_terms.term_id WHERE wp_posts.post_status = 'publish' AND wp_terms.name='Bolsa de Trabajo' LIMIT 1";
$bolsaDatos = dbcon('localhost','25128','El pollito p10','wordpress_swan_test',$qryBolsa,0);
?>
<title>Sazón oaxaqueño - Bolsa de trabajo </title>
<!-- InstanceEndEditable -->
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5&appId=283884004956884";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="topNav">
  <div id="logo"><a href="/"><img src="_images/logo.png" alt="Sazón Oaxaqueño" /></a></div>
  <div id="navegador">
    <ul>
      <li> <a href="nosotros.html">Nosotros</a> </li>
      <li><a href="index.html#productos">Productos</a></li>
      <li><a href="tiendas.html">Tiendas</a></li>
      <li><a href="recetas.php">Recetas</a></li>
    </ul>
  </div>
</div>
<!-- InstanceBeginEditable name="contenido" -->
<div>
<h3>Bolsa de trabajo</h3>
<?
if(is_array($bolsaDatos)){
   echo('<p>'.$bolsaDatos[0][2].'</p>');
}
?>
</div><!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
