<?php

include('connection.php');

$stmt= $conn->prepare("SELECT * FROM products  WHERE category='ip11sr'  LIMIT 4");

$stmt->execute();


$featured_products = $stmt->get_result();//[]

?>