<?php

//print_r($_GET);die;

 //if(session_status() === PHP_SESSION_NONE) {
    session_start();
//}
if(!empty($_GET['bookid']) && !empty($_GET['bookname']))
{
$_SESSION["bookshop"]["bookid"]=$_GET['bookid'];
$_SESSION["bookshop"]["bookname"]=$_GET['bookname'];
//$abc=$_SESSION["bookshop"]["bookid"];

}
$err="Please get your order done";
if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
{
   

    require_once("mysqli_connect.php");
    $errors=false;
    $err="";
   
    if (empty($_POST['firstname'])) {
        $err.='<p>You forgot to enter your  first name.</p>';
        $errors=true;
	} else {
		$n =mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    }
    if (empty($_POST['lastname'])) {
        $err.='<p>You forgot to enter your  lastname.</p>';
        $errors=true;
	} else {
		$e = mysqli_real_escape_string($dbc,trim($_POST['lastname']));
    }
    if (empty($_POST['payment'])) {
        $err.='<p>You forgot to enter your  payment mode.</p>';
        $errors=true;
	} else {
		$p = mysqli_real_escape_string($dbc,trim($_POST['payment']));
    }

    
    if($errors==true)
    {
        $err.= '<p>error in submitting... please fill the blanks</p>';
    }
    else
    {
        //echo $_SESSION["bookshop"]["bookid"];
        $q = 'INSERT INTO bookinventoryorder (orderbookid,  orderfirstname, orderlastname,orderpaymode)
                                 VALUES ('.$_SESSION["bookshop"]["bookid"].',"'.$n.'", "'.$e.'", "'.$p.'")';
		//$r = @mysqli_query($dbc, $q); // Run the query.
        //print_r($q);exit;
		if (@mysqli_query($dbc, $q)) { 
            $err="";
            $err.='<p>Sucessfull</p>';
            $u='UPDATE BOOKINVENTORY SET BOOKQUANTITY=BOOKQUANTITY-1 WHERE BOOKID='.$_SESSION["bookshop"]["bookid"].'';
            $r1 = @mysqli_query($dbc, $u);
        }
        else{
            print_r($r);exit;
            $err.= 'error';
        }

        mysqli_close($dbc); 


        
    }
    //session_destroy();
}
?>





<!doctype html>
<HTML>
<head>
	<meta charset="utf-8">
	<title>Book store</title>
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" >
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<script src="script.js"></script>

</head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header"><a class="navbar-brand" href="#">Order Your Book</a></div>
		<div id="navbar" class="collapse navbar-collapse">
	
		</div>
    </div>
    
</nav>
<div class="form-style-8">
<form action="cart.php" method="post"  enctype="multipart/form-data">

<input type="text" name="bookname" value="<?php echo "BUYING: ".$_SESSION["bookshop"]["bookname"];?>" readonly/>
<input type="text" name="firstname" placeholder="Enter Full Name" />
    <input type="text" name="lastname" placeholder="Enter Last name" />
    <input type="text" name="payment1" placeholder="Enter Payment mode"  disabled/>
    <input type="radio" id="debit" name="payment" value="debit" checked="checked">
	<label for="debit">Debit</label><br>
	<input type="radio" id="credit" name="payment" value="credit">
	<label for="credit">Credit</label><br>
	<input type="radio" id="COD" name="payment" value="COD">
	<label for="COD">COD</label><br>
    <input type="submit" name="submit" value="Submit" />
    <a class="backbtn" href="index.php">Back</a> 
</div>

<div  class="form-style-8">
<h3><?php 
echo isset($err)?$err:"" ;
?></h3>
</div>
</BODY>
</HTML>
<!-- 
<p> Book Name: <label> <?php// echo $_SESSION["bookshop"]["bookname"]; 
?></label></p>
<div><div>First Name:</div> <input type="text" name="firstname" size="15" maxlength="20" ></div>
<p>Last Name: <input type="text" name="lastname" size="20" maxlength="20" > </p>   
<p>Payment Option: <input type="text" name="payment" size="20" maxlength="20" > </p>  
<p><input type="submit" name="submit" value="Submit"></p>
<P><a href="index.php">Back</a></p>
</form> -->