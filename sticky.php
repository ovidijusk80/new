<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<!-- STICKY STYLE  START-->
<style>
  .relative{
    position: relative;
  }
  .absolute{
    position:absolute;
  }
		.sticky body {
			font-family: Monaco, Courier New, monospace;
		}
		.r {
			text-align: right;
		}


		.sticky table {
			border-spacing: 0;
		}

		.sticky th {
			background: #2D2E40;
			color: #FFF;
		}

		.sticky th, td {
			padding: 3px 20px;
		}
    .sticky table , th , td{
      border:1px solid;
      border-left: 1px solid;
      border-collapse: collapse;
    } 
	</style>
<!-- STICKY STYLE END-->
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
$ccode = '177460481';

if ($stmt = mysqli_prepare($conn, "SELECT * FROM axdev.jourtrans WHERE id=?")) {

    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "s", $ccode);

    /* execute query */
    mysqli_stmt_execute($stmt);
		$result = $stmt->get_result();

 while ($myrow = $result->fetch_assoc()) {

      // var_dump($myrow);

//echo $myrow['ITEMID'];
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
?>

<!-- TEVINIS FAILO ISTRAUKIMAS IS DB  NAUDOJAMI 2 DIV PRIES STICKY LENTELE -->
<div class="absolute">
<div class="relative">

<!-- TEVINIS TABLE -->
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
            <td data-label="Kiekis :"><?php number_format((float)$QTY, 3, '.', '');?></td>
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
<!-- TEVINIS TABLE END-->
<br>
<!-- FORMA  -->
<form action="result1.php" method="post" >

Skaidimo Kiekis  <br><input name="skaidimokiekis" id="skaidimokiekis" required="true" autofocus><br>

Skaidimo Daugiklis <br> <input name="skaidimodaugiklis" id="skaidimodaugiklis" required="true" value="1"><br>

Spausdintuvas<br>
<select name="spausdintuvas" id="spausdintuvas">
<option>A</option>
<option>B</option>
</select><br>


<input  type="submit" onclick="return testavimas()">
</form>

<!--           INFO TABLE SU VAIKAIS IR TEVAIS -->                             -->
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
</body>
</html>












