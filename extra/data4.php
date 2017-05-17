<!DOCTYPE html>
<!--[if lt IE 8]><html lang="en" class="legacy"><![endif]-->
<!--[if gte IE 8]><!--><html lang="en"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title>border-collapse Demo</title>
    <style type="text/css">
      table { border-collapse: collapse; width: 901px; }
      th,
      td { font-size: 22px; border: 1px solid #000; background-color: #fff; padding:5px; }
    </style>
  </head>
  <body style="padding:50px">
    <h1>border-collapse Demo</h1>
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
    <script src="../js/jquery.stickytableheaders.min.js"></script>
      <script src="../js/jquery.stickytableheaders.js"></script>
  <script>

    $(document).ready(function () {
      // adding filler rows
      for(var i = 0; i < 3; i++){
        $('tbody tr').clone().appendTo('table');
      }

      $("html:not(.legacy) table").stickyTableHeaders();
    });

  </script>

  </body>
</html>