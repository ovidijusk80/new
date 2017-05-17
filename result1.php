<html>
<style type="text/css">
  table {
    border: 1px solid #ccc;
    width: 100%;
    margin:0;
    padding:0;
    border-collapse: collapse;
    border-spacing: 0;
  }

  table tr {
    border: 1px solid #ddd;
    padding: 10px;
  }

  table th, table td {
    padding: 10px;
    text-align: center;
  }

  table th {
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 1px;
  }

  @media screen and (max-width: 600px) {

    table {
      border: 0;
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
</style>
<body>
<style type="text/css">
    @media screen and (max-width: 480px) {

    input{
    width: 100%
    }
div {
  text-align: center;
}
</style>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//var_dump($_POST);
$ccode =$_POST["ccode"];
$imone = $_POST["imone"];
//var_dump($imone);
$error=0;
$QTYcheck = $_POST["QTY"];
$UNITIDcheck = $_POST["UNITID"];
$ska20idimokiekis =$_POST["skaidimokiekis"];
$skaidimodaugiklis =$_POST["skaidimodaugiklis"];
$spausdintuvas =$_POST["spausdintuvas"];
$skaldimosuma=$skaidimokiekis*$skaidimodaugiklis;
$symbolreplace = array(',');
$skaidimokiekis =str_replace($symbolreplace,".",$skaidimokiekis);
if(is_numeric($skaidimokiekis)==false || is_numeric($skaidimodaugiklis)==false)
{
$error=1;
echo "<script>
alert('Rastos Raides Arba Simboliai Arba Paliktas Tuscias');
window.location.href='company1.php';
</script>";
}

else if($skaldimosuma>$QTYcheck){
$error=1;
echo 
"<script>
alert('Skaidimo Kiekis Per Didelis Or Lygus Kiekiui');
window.location.href='company1.php';
</script>";
}
else if($skaidimokiekis*$skaidimodaugiklis<=0){
$error=1;
echo 
"<script>
alert('Ivestas Skaidimo Kiekis Yra Neigiamas Arba Lygus 0');
window.location.href='company1.php';
</script>";
}
else if(($QTYcheck<=0) || ($UNITIDcheck=="vnt") || ($UNITIDcheck=="vnt.") || ($UNITIDcheck=="Kompl") || ($UNITIDcheck=="Kompl.")){
$error=1;
echo 
"<script>
alert('Skaidimas Negalimas');
window.location.href='company1.php';
</script>";
}



// CONNECT TO DATA BASE

//header('Content-Type: text/html;charset=ISO-8859-1'); 
error_reporting(E_ALL);
ini_set("display_errors", 1);
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);



if ($stmt = mysqli_prepare($conn, "SELECT * FROM axdev.jourtrans WHERE id=?")) {

    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "s", $ccode);

    /* execute query */
    mysqli_stmt_execute($stmt);
		$result = $stmt->get_result();

 while ($myrow = $result->fetch_assoc()) {
    $id=$myrow['id'];
    $JOURNALTYPE=$myrow['JOURNALTYPE'];
    $JOURNALID= $myrow['JOURNALID'];
    $INVENTTRANSID = $myrow['INVENTTRANSID'];
    $ITEMID =$myrow['ITEMID'];
    $ITEMNAME= $myrow['ITEMNAME'];
 	$QTY = $myrow['QTY'];
 	$UNITID = $myrow['UNITID'];
 	$PACKQTY = $myrow['PACKQTY'];
    $INVENTSERIALID =  $myrow['INVENTSERIALID'];
    $ORDERID = $myrow['ORDERID'];
    $ORDERID = $myrow['ORDERID'];
    $INVENTLOCATIONID = $myrow['INVENTLOCATIONID'];
    $INVENTLOCATIONIDTO = $myrow['INVENTLOCATIONIDTO'];
    $FILEID = $myrow['FILEID'];
    $EMPLID = $myrow['EMPLID'];
    $CREATEDATETIME = $myrow['CREATEDATETIME'];
    $REFID = $myrow['REFID'];
    $DELETED = $myrow['DELETED'];
    $CUSTOMERREF = $myrow['CUSTOMERREF'];
    $SALESNAME = $myrow['SALESNAME'];
    $ITEMBARCODE = $myrow['ITEMBARCODE'];
    $NETWEIGHT = $myrow['NETWEIGHT'];
    $TARAWEIGHT = $myrow['TARAWEIGHT'];    
    $TAXPACKAGINGQTY = $myrow['TAXPACKAGINGQTY'];
    $PRODPOOLID = $myrow['PRODPOOLID'];
    $REQUISITIONORDER = $myrow['REQUISITIONORDER'];
    $CUSTPURCHASEORDERFORMNUM = $myrow['CUSTPURCHASEORDERFORMNUM'];
    $CUSTOMER = $myrow['CUSTOMER'];
    $EXTERNALITEMID = $myrow['EXTERNALITEMID'];
    $EXTERNALITEMNAME = $myrow['EXTERNALITEMNAME'];
    $CONFIRMATIONNO = $myrow['CONFIRMATIONNO'];
    $ORDERNO = $myrow['ORDERNO'];
    $CLIENTNAME = $myrow['CLIENTNAME'];
    $CLIENTADDRESS = $myrow['CLIENTADDRESS'];
    $DELIVERYADDRESS = $myrow['DELIVERYADDRESS'];
    $LOADINGADDRESS = $myrow['LOADINGADDRESS'];
    $SHIPMENTID = $myrow['SHIPMENTID'];    
    $ROUTEFINISHED = $myrow['ROUTEFINISHED'];
    $CREATEBOMJOUR = $myrow['CREATEBOMJOUR'];
    $POSTBOMJOUR = $myrow['POSTBOMJOUR'];
    $APPNAME = $myrow['APPNAME'];
    $DATAAREAID = $myrow['DATAAREAID'];
    $SERVERDATE = $myrow['SERVERDATE'];
    $WAITING = $myrow['WAITING'];
    $ITEMOLDID = $myrow['ITEMOLDID'];
    $DELDATE = $myrow['DELDATE'];
    $IP = $myrow['IP'];
    $COUNTGROUPID = $myrow['COUNTGROUPID'];
    $BATCHID = $myrow['BATCHID']; 
    $POSITION = $myrow['POSITION']; 
    $SSCC = $myrow['SSCC']; 
    $TOKEN = $myrow['TOKEN']; 
    $PRODGO = $myrow['PRODGO']; 
    $CONFIRMEMPLID = $myrow['CONFIRMEMPLID']; 
    $CONFIRMDATETIME = $myrow['CONFIRMDATETIME']; 
    }

    /* close statement */
    mysqli_stmt_close($stmt);
}

$parentid= $id;
if ($REFID==""){
	$JOURNALID = $ccode;
	//echo "EMPTY", $JOURNALID ;
}
else {
	$JOURNALID = $REFID;
	//echo "NOT EMPTY", $JOURNALID;
	//var_dump($JOURNALID);
}

//  qty check
if ($stmt = mysqli_prepare($conn, "SELECT SUM(QTY) as 'QTY' FROM axdev.jourtrans WHERE REFID=?")) {
    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "s", $ccode);
    /* execute query */
    mysqli_stmt_execute($stmt);
		$result = $stmt->get_result();
	//	$qtytake=0;
		$qtytake = 0;
 while ($myrow = $result->fetch_assoc()) {
$qtytake=$myrow['QTY'];
    }
    mysqli_stmt_close($stmt);
}
else {
	$qtytake=0;
}
//   qty check END
/*
echo $qtytake, " ESAMAS DB <br>";
echo $qtytake+$skaidimokiekis , " TURIMAS <br>";
*/
if ((($qtytake + ($skaidimokiekis*$skaidimodaugiklis))<=$QTY) && $error==0){
for ($i = 1 ; $i<=$skaidimodaugiklis; $i++){ 
/*    PLIUSAS    */

if($stmt = $conn->prepare("INSERT INTO axdev.jourtrans (JOURNALTYPE, JOURNALID, INVENTTRANSID, ITEMID, ITEMNAME, QTY, UNITID, PACKQTY, INVENTSERIALID, ORDERID, INVENTLOCATIONID, INVENTLOCATIONIDTO, FILEID, EMPLID, CREATEDATETIME, REFID, DELETED, CUSTOMERREF, SALESNAME, ITEMBARCODE, NETWEIGHT, TARAWEIGHT, TAXPACKAGINGQTY, PRODPOOLID, REQUISITIONORDER, CUSTPURCHASEORDERFORMNUM, CUSTOMER, EXTERNALITEMID, EXTERNALITEMNAME, CONFIRMATIONNO, ORDERNO, CLIENTNAME, CLIENTADDRESS, DELIVERYADDRESS, LOADINGADDRESS, SHIPMENTID, ROUTEFINISHED, CREATEBOMJOUR, POSTBOMJOUR, APPNAME, DATAAREAID, SERVERDATE, WAITING, ITEMOLDID, DELDATE, IP, COUNTGROUPID, BATCHID, POSITION, SSCC, TOKEN, PRODGO, CONFIRMEMPLID, CONFIRMDATETIME)  VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )")){

$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssss", $JOURNALTYPE, $JOURNALID, $INVENTTRANSID, $ITEMID, $ITEMNAME, $skaidimokiekis, $UNITID, $PACKQTY, $INVENTSERIALID, $ORDERID, $INVENTLOCATIONID, $INVENTLOCATIONIDTO, $FILEID, $EMPLID, $CREATEDATETIME, $parentid, $DELETED, $CUSTOMERREF, $SALESNAME, $ITEMBARCODE, $NETWEIGHT, $TARAWEIGHT, $TAXPACKAGINGQTY, $PRODPOOLID, $REQUISITIONORDER, $CUSTPURCHASEORDERFORMNUM, $CUSTOMER, $EXTERNALITEMID, $EXTERNALITEMNAME, $CONFIRMATIONNO, $ORDERNO, $CLIENTNAME, $CLIENTADDRESS, $DELIVERYADDRESS, $LOADINGADDRESS, $SHIPMENTID, $ROUTEFINISHED, $CREATEBOMJOUR, $POSTBOMJOUR, $APPNAME, $imone, $SERVERDATE, $WAITING, $ITEMOLDID, $DELDATE, $IP, $COUNTGROUPID, $BATCHID, $POSITION, $SSCC, $TOKEN, $PRODGO, $CONFIRMEMPLID, $CONFIRMDATETIME);
$stmt -> execute();
//echo "Pliusas Sukurtas <br>";
}else{
   var_dump("Klaida" + $stmt);
}
    mysqli_stmt_close($stmt);
/*    PLIUSO UZDARYMAS    */


//  ISRINKTI SUKURTO NAUJO DUOMENS ID 
if ($stmt = mysqli_prepare($conn, "SELECT * FROM axdev.jourtrans WHERE REFID=?")) {
    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "s", $parentid);
    /* execute query */
    mysqli_stmt_execute($stmt);
		$result = $stmt->get_result();
 while ($myrow = $result->fetch_assoc()) {
    $changingid=$myrow['id'];
    $TITEMID=$myrow['ITEMID'];
    $TITEMNAME=$myrow['ITEMNAME'];
    $TQTY=$myrow['QTY'];
    $TINVENTSERIALID=$myrow['INVENTSERIALID'];
    $TSERVERDATE = $myrow['SERVERDATE'];
    }
    mysqli_stmt_close($stmt);
}
//  ID ISRINKIMO END
$neigiamaskaldimokiekis= "-".$skaidimokiekis;
?>
<table>
        <thead>
        <tr>
            <th>C</th>
            <th>Prekes Nr.</th>
            <th>Aprasymas</th>
            <th>Kiekis</th>
            <th>Data ir Laikas</th>
            <th>Zurnalo ID</th>
            <th>Serijos Nr.</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-label="C :"><?php echo $changingid;?></td> 
            <td data-label="Prekes Nr. :"><?php echo $TITEMID;?></td>
            <td data-label="Aprasymas :"><?php echo $TITEMNAME;?></td>
            <td data-label="Kiekis :"><?php echo number_format((float)$TQTY, 3, '.', '');?></td>
            <td data-label="Data ir Laikas:"><?php echo $TSERVERDATE;?></td>
            <td data-label="Zurnalo ID:"><?php echo $JOURNALID;?></td>
            <td data-label="Serijos Nr. :"><?php 
            if(empty($TINVENTSERIALID)==true){
                echo"<br>";} 
            else{ echo $INVENTSERIALID;}?></td>           
        </tr>    
        </tbody>
    </table>


<?php
/*   MINUSAS    */
if($stmt = $conn->prepare("INSERT INTO axdev.jourtrans (JOURNALTYPE, JOURNALID, INVENTTRANSID, ITEMID, ITEMNAME, QTY, UNITID, PACKQTY, INVENTSERIALID, ORDERID, INVENTLOCATIONID, INVENTLOCATIONIDTO, FILEID, EMPLID, CREATEDATETIME, REFID, DELETED, CUSTOMERREF, SALESNAME, ITEMBARCODE, NETWEIGHT, TARAWEIGHT, TAXPACKAGINGQTY, PRODPOOLID, REQUISITIONORDER, CUSTPURCHASEORDERFORMNUM, CUSTOMER, EXTERNALITEMID, EXTERNALITEMNAME, CONFIRMATIONNO, ORDERNO, CLIENTNAME, CLIENTADDRESS, DELIVERYADDRESS, LOADINGADDRESS, SHIPMENTID, ROUTEFINISHED, CREATEBOMJOUR, POSTBOMJOUR, APPNAME, DATAAREAID, SERVERDATE, WAITING, ITEMOLDID, DELDATE, IP, COUNTGROUPID, BATCHID, POSITION, SSCC, TOKEN, PRODGO, CONFIRMEMPLID, CONFIRMDATETIME)  VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )")){

$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssss", $JOURNALTYPE, $JOURNALID, $INVENTTRANSID, $ITEMID, $ITEMNAME, $neigiamaskaldimokiekis, $UNITID, $PACKQTY, $INVENTSERIALID, $ORDERID, $INVENTLOCATIONID, $INVENTLOCATIONIDTO, $FILEID, $EMPLID, $CREATEDATETIME, $changingid, $DELETED, $CUSTOMERREF, $SALESNAME, $ITEMBARCODE, $NETWEIGHT, $TARAWEIGHT, $TAXPACKAGINGQTY, $PRODPOOLID, $REQUISITIONORDER, $CUSTPURCHASEORDERFORMNUM, $CUSTOMER, $EXTERNALITEMID, $EXTERNALITEMNAME, $CONFIRMATIONNO, $ORDERNO, $CLIENTNAME, $CLIENTADDRESS, $DELIVERYADDRESS, $LOADINGADDRESS, $SHIPMENTID, $ROUTEFINISHED, $CREATEBOMJOUR, $POSTBOMJOUR, $APPNAME, $DATAAREAID, $SERVERDATE, $WAITING, $ITEMOLDID, $DELDATE, $IP, $COUNTGROUPID, $BATCHID, $POSITION, $SSCC, $TOKEN, $PRODGO, $CONFIRMEMPLID, $CONFIRMDATETIME);
$stmt -> execute();
//echo "Minusas Sukurtas <br>";
}else{
   var_dump("Klaida" + $stmt);
}
    mysqli_stmt_close($stmt);
/*   MINUSO UZDARYMAS   */


// CLOSE FOR
}
/* close connection */
mysqli_close($conn);

// CLOSE ELSE (no error passed)
}
else{
echo 
"<script>
alert('Skaidyti Negalima DB Yra '+ $qtytake  +' Limitas Yra ' + $QTY);
window.location.href='company1.php';
</script>";
}

?>

</body>
</html>