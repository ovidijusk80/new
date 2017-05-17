<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>box-sizing: border-box</title>
	<style>
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

		th, td {
			padding: 3px 20px;
		}

		* {
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
		}
	</style>
</head>
<body>
	<h1>box-sizing: border-box;</h1>
	<table>
		<thead>
        <tr>
		<th>ID</th>
		<th>TITEMID</th>
		<th>TITEMNAME</th>
		<th>TQTY</th>
		<th>TJOURNALID</th>
		<th>TREFID</th>
		<th>TINVENTSERIALID</th>
		<th>TSERVERDATE</th>
		<th>TDATAAREAID</th>
		</tr>
		</thead>
		<tbody>
		

<?php 
header('Content-Type: text/html;charset=ISO-8859-1'); 
error_reporting(E_ALL);
ini_set("display_errors", 1);
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
$ccode ="177460481";

  if ($stmt = mysqli_prepare($conn, "SELECT * FROM axdev.jourtrans WHERE id=? or id=? or JOURNALID=? or REFID=?")) {
    mysqli_stmt_bind_param($stmt, "ssss", $JOURNALID, $REFID, $ccode,$ccode);
    mysqli_stmt_execute($stmt);
    $result = $stmt->get_result();
//var_dump($JOURNALID);
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
<td><?php echo $Tid;?></td>
<td><?php echo $TITEMID;?></td>
<td><?php echo $TITEMNAME;?></td>
<td><?php echo number_format((float)$TQTY, 3, '.', '');?></td>
<td><?php echo $TJOURNALID;?></td>
<td><?php echo $TREFID;?></td>
<td><?php echo $TINVENTSERIALID;?></td>
<td><?php echo $TSERVERDATE;?></td>
<td><?php echo $TDATAAREAID;?></td>
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
