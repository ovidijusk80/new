
<html lang="UTF-8">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<script type="text/javascript">
 function  testavimas(){
var skaidimokiekis= document.getElementById("skaidimokiekis").value;
var skaidimodaugiklis = document.getElementById("skaidimodaugiklis").value;
var returnvalue =parseInt(skaidimokiekis)*parseInt(skaidimodaugiklis);

var errorperdidelis ="Skaidimo Kiekis Per Didelis";
var errorneigiamasornull = "Ivestas Skaidimo Kiekis Yra Neigiamas Arba Lygus 0";
var errorraides = "Tark Skaidimo Kiekio Ar Daugiklio Ivestos Raides Arba Simboliai";
var errornegali = "Skaidimas Negalimas";

 var UNITID = document.getElementById("UNITID").textContent;
 var QTY = document.getElementById("QTY").textContent;
 var ccode = document.getElementById("ccode").textContent;

 if ((UNITID==="vnt") || (UNITID==="vnt.") || (UNITID==="Kompl") || (UNITID==="Kompl.")){
alert(errornegali+ " Prekes Typas '"+ UNITID + "'");
window.location.href='company1.php';
return false;

 }
 /*|| !!skaidimokiekis  || !!skaidimodaugiklis*/
  else if(skaidimokiekis<=0  || skaidimodaugiklis<=0){
alert(errorneigiamasornull);
document.getElementById("skaidimokiekis").value="";
document.getElementById("skaidimodaugiklis").value="1";
return false;
 }

else if (isNaN(skaidimokiekis) || isNaN(skaidimodaugiklis)){
  alert(errorraides);
  document.getElementById("skaidimokiekis").value="";
  document.getElementById("skaidimodaugiklis").value="1";
  return false;
}

else if (QTY<returnvalue){
alert(errorperdidelis);
document.getElementById("skaidimokiekis").value="";
document.getElementById("skaidimodaugiklis").value="1";
return false;
}


}
</script>
	<style>
  .relative{
    
    position: relative;

  }
  .absolute{
    
    position:absolute;
    
  }
   @media screen and (min-width: 661px) {

		body {
			font-family: Monaco, Courier New, monospace;
		}
		.r {
			text-align: right;
		}


		table {
			border-spacing: 0;
		}

		th {
			background: #2D2E40;
			color: #FFF;
		}
/**/
		th, td {
			padding: 3px 20px;
		}
    table , th , td{
      border:1px solid;
      border-left: 1px solid;
      border-collapse: collapse;
    }
	</style>
<style type="text/css">
  
  @media screen and (max-width: 660px) {
      .absolute{
    position:absolute;
    width: 95%;
  }
    table , th , tr{
      border:1px solid;
    }
table{
  width: 100%;
}
    table thead {
      display: none;
    }

    table tr {
      margin-bottom: 10px;
      display: block;
      border-bottom: 2px solid #ddd;
    }

    table td {
      display: block;
      text-align: right;
      font-size: 13px;
      border-bottom: 1px dotted #ccc;
    }
/**/
    table td:last-child {
      border-bottom: 0;
    }

    table td:before {
      content: attr(data-label);
      float: left;
      text-transform: uppercase;
      font-weight: bold;
    }
    div input, select{
        width:100%;
    }
  }
  /**/
</style>
<body>

<?php 
header('Content-Type: text/html;charset=ISO-8859-1'); 
error_reporting(E_ALL);
ini_set("display_errors", 1);
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
$ccode =$_POST["ccode"];
$imone =$_POST["imone"];
$letters = array('C', 'c');
$ccode =str_replace($letters,"",$ccode);

if(is_numeric($ccode)==false or $ccode<0){
echo 
"<script>
var imone ='$imone';
alert('Blogas C Kodas');
window.location.href='index1.php?Company='+imone;
</script>";
}

if ($stmt = mysqli_prepare($conn, "SELECT * FROM axdev.jourtrans WHERE id=?")) {
    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "s", $ccode);
    /* execute query */
    mysqli_stmt_execute($stmt);
		$result = $stmt->get_result();

 while ($myrow = $result->fetch_assoc()) {
    $id=$myrow['id'];
    $ITEMNAME= $myrow['ITEMNAME'];
    $ITEMID =$myrow['ITEMID'];
    $INVENTSERIALID =  $myrow['INVENTSERIALID'];
    $QTY = $myrow['QTY'];
    $UNITID = $myrow['UNITID'];
    $REFID = $myrow['REFID'];
    $JOURNALID = $myrow['JOURNALID'];
    }
    /* close statement */
    mysqli_stmt_close($stmt);
}
if ($ccode!=$id) {
echo 
"<script>
var imone ='$imone';
alert('Blogas C Kodas');
window.location.href='index1.php?Company='+imone;
</script>";
}
if ($stmt = mysqli_prepare($conn, "SELECT SUM(QTY) as 'QTY' FROM axdev.jourtrans WHERE REFID=?")) {
    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "s", $ccode);
    /* execute query */
    mysqli_stmt_execute($stmt);
    $result = $stmt->get_result();
  //  $qtytake=0;
    $qtytake = 0;
 while ($myrow = $result->fetch_assoc()) {
$qtytake=$myrow['QTY'];
    }
    mysqli_stmt_close($stmt);
}
else {
  $qtytake=0;
}
if ($qtytake<0){
  $QTYminus=$QTY;
}
  else {
$QTYminus=$QTY-$qtytake;}
/* close connection */
?>

<div class="absolute">

<div class="relative">
<table>
        <thead>
        <tr>
            <th>C</th>
            <th>Prekes Nr.</th>
            <th>Aprasymas</th>
            <th>Kiekis</th>
            <th>Ref ID</th>
            <th>Serijos Nr.</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-label="C :"><?php echo $id;?></td> 
            <td data-label="Prekes Nr. :"><?php echo $ITEMID;?></td>
            <td data-label="Aprasymas :"><?php echo $ITEMNAME;?></td>
            <td data-label="Kiekis :"><?php echo number_format((float)$QTYminus, 3, '.', ''), "/", number_format((float)$QTY, 3, '.', '');?></td>
            <td data-label="Ref ID. :"><?php 
            if(empty($REFID)==true){
                echo"<br>";} 
            else{ echo $REFID;}?></td>
            <td data-label="Serijos Nr. :"><?php 
            if(empty($INVENTSERIALID)==true){
                echo"<br>";} 
            else{ echo $INVENTSERIALID;}?></td>           
        </tr>    
        </tbody>
    </table>

<br>

<!-- for transferring variable to another php file-->
<div id="UNITID" style="display: none;">
    <?php 
        echo htmlspecialchars($UNITID);                                        
    ?>
</div>
<div id="QTY" style="display: none;">
    <?php 
        echo htmlspecialchars($QTY);                                 
    ?>
</div>
<div id="ccode" style="display: none;">
    <?php 
        echo htmlspecialchars($ccode);                                 
    ?>
</div>
<div id="imone" style="display: none;">
    <?php 
        echo htmlspecialchars($imone);                                 
    ?>
</div>
<!--  -->
<div id="scroll">
<!-- FORMA   onsubmit="return testavimas(this)"-->
<form action="result1.php" method="post" accept-charset="utf-8">
<input type="hidden" name="ccode" value="<?php echo $ccode;?>">
<input type="hidden" name="QTY" value="<?php echo $QTY;?>">
<input type="hidden" name="imone" value="<?php echo $imone;?>">
<input type="hidden" name="UNITID" value="<?php echo $UNITID;?>">
<div>
Skaidimo Kiekis  <br><input type="number" step="any" name="skaidimokiekis" id="skaidimokiekis" required="true"  autofocus><br>

Skaidimo Daugiklis <br> <input type="number" name="skaidimodaugiklis" id="skaidimodaugiklis"  value="1" required="true"><br>

Spausdintuvas<br>
<select name="spausdintuvas" id="spausdintuvas">
<option>A</option>
<option>B</option>
</select><br>
</div>
<input  type="submit" value="Pateikti" onclick="return testavimas()">
</form>
<!-- Forma END -->
<!--   INFO TABLE   -->
</div>
</div>
	<table>
		<thead>                     
        <tr> 
            <th>C</th>
            <th>Prekes Nr.</th>
            <th>Aprasymas</th>
            <th>Kiekis</th>
		        <th>Zurnalo Nr.</th>
            <th>Ref ID</th>
            <th>Serijos Nr.</th>
		       <th>Data</th>
		       <th>Imone</th>
		</tr>
		</thead>
		<tbody>
<?php 

  if ($stmt = mysqli_prepare($conn, "SELECT * FROM axdev.jourtrans WHERE id=? or id=? or JOURNALID=? or REFID=?")) {
    mysqli_stmt_bind_param($stmt, "ssss", $JOURNALID, $REFID, $ccode,$ccode);
    mysqli_stmt_execute($stmt);
    $result = $stmt->get_result();

 while ($myrow = $result->fetch_assoc()) {

    $Tid=$myrow['id'];
    $TITEMID=$myrow['ITEMID'];
    $TITEMNAME=$myrow['ITEMNAME'];
    $TQTY=$myrow['QTY'];
    $TJOURNALID = $myrow['JOURNALID'];
    $TREFID = $myrow['REFID'];
    $TINVENTSERIALID=$myrow['INVENTSERIALID'];
    $TSERVERDATE = $myrow['SERVERDATE'];
    $TDATAAREAID = $myrow['DATAAREAID'];
?>
		<tr>
<td data-label="C :"><?php echo $Tid;?></td>
<td data-label="Prekes Nr. :"><?php echo $TITEMID;?></td>
<td data-label="Aprasymas :"><?php echo $TITEMNAME;?></td>
<td data-label="Kiekis :"><?php echo number_format((float)$TQTY, 3, '.', '');?></td>
<td data-label="Zurnalo Nr. :"><?php echo $TJOURNALID;?></td>
<td data-label="Ref ID :"><?php 
            if(empty($TREFID)==true){
                echo"<br>";} 
            else{ echo $TREFID;}?></td>
<td data-label="Serijos Nr. :"><?php 
            if(empty($TINVENTSERIALID)==true){
                echo"<br>";} 
            else{ echo $TINVENTSERIALID;}?></td>
<td data-label="Data :"><?php echo $TSERVERDATE;?></td>
<td data-label="Imone :"><?php echo $TDATAAREAID;?></td>
		</tr>
		<?php
    }
    /* close statement */
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>
	</tbody>
	</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <script src="../js/jquery.stickytableheaders.js"></script>
  <script>
    $("table").stickyTableHeaders();
  </script>
<!--dont place anything below this '</div>'  only above-->
  </div>
<!--dont place anything below this-->
</body>
</html>












