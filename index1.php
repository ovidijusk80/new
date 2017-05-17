<html>
<body>
<style type="text/css">
    @media screen and (max-width: 480px) {

    input
    {
    width: 100%;
    }
div {
  text-align: center;
	}
</style>
<?php
$companylist = array("dgr","rdv", "dom", "dso", "dzo", "dte", "dme");


if (isset($_GET["Company"])){
    if(in_array($_GET["Company"], $companylist)){
	$imone =$_GET["Company"];
} else{
echo "<script>
alert('Tokia Imone Nera Pasirinkimuose');
window.location.href='http://127.0.0.1/a/demo/company1.php';
</script>";}
} else{
echo "<script>
alert('Tokia Imone Nera Pasirinkimuose');
window.location.href='http://127.0.0.1/a/demo/company1.php';
</script>";}
//var_dump($imone);

?>
<form action="data1.php" method="post">
<input type="hidden" name="imone" value="<?php echo $imone;?>">
<div>C Kodas: <input  type="text" name="ccode" id="ccode" autofocus required="true">
<input  type="submit" id="next"  name="Pateikti" value="Pateikti"></div>
</form>

</body>
</html>