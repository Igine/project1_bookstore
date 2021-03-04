<?php
require_once('mysqli_connect.php');
$q1="SELECT * FROM bookinventory";
$r1 = @mysqli_query ($dbc, $q1);
$num=mysqli_num_rows($r1);
if($num>0)
{
    session_start();
    	// Fetch and print all the records:
        $html = "";
        while ($row = mysqli_fetch_assoc($r1)) {
           // $_SESSION["bookshop"]["bookid"]=$row['bookid'];
        //$_SESSION["bookshop"]["bookname"]=$row['bookname'];
        //$_SESSION["bookshop"]["quantity"]=$row['bookquantity'];
		$html .= '<tr>
        <td align="left" >' . $row['bookname'] . '</td>
        <td align="left">' . $row['bookauthor'] . '</td>
        <td align="left">' . $row['bookpublished'] . '</td>
        <td align="left">' . $row['bookprice'] . '</td>
        <td align="left">' . $row['bookquantity'] . '</td>
        <td align="left"> <a href="http://localhost:81/project1/cart.php?bookid='.$row['bookid'].'&bookname='.$row['bookname'].'">Add to cart</a></td>';
       
       // echo $row['bookid'];
        $html .= '</tr>';
        //header("Location:cart.php");
       
       
      
    }
    mysqli_free_result ($r1);
   
}
else{
    echo "no records found";
}
mysqli_close($dbc);
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Project 1</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" >
    

</head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header"><a class="navbar-brand" href="#">Book store</a></div>
		<div id="navbar" class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li class="active"><a href="index.php">Home</a></li>
			
        
		</ul>
		</div>
    </div>
    
</nav>
<table width="60%" style="margin:5%";>
	<thead>
	<tr>
		<th align="left">Name</th>
        <th align="left">Author</th>
        <th align="left">Published</th>
        <th align="left">Price</th>
        <th align="left">Quantity</th>
        <th align="left">Add toCart</th>
	</tr>
	</thead>
	<tbody>
                <?php echo $html; ?>
     </tbody>
    </table>
    </body>
</html>
