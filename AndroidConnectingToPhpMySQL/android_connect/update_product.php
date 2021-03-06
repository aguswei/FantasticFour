<?php

header('Content-type: application/json');
/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['pid']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
    
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // include db connect class
    //require_once __DIR__ . '/db_connect.php';

    // connecting to db
    //$db = new DB_CONNECT();
    
    
    //********************
	 $con = mysql_connect('devsrv.cs.csbsju.edu', 'fantastic4', 'androidfan4') or die(mysql_error());
	 $db = mysql_select_db('AndroidOrders',$con) or die(mysql_error()) or die(mysql_error());



	 //********************

    // mysql update row with matched pid
    $result = mysql_query("UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE pid = $pid",$con);
    mysql_close($con);		 
	 
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

function json_encode($data) {
      switch ($type = gettype($data)) {
            case 'NULL':
               return 'null';
            case 'boolean':
               return ($data ? 'true' : 'false');
            case 'integer':
            case 'double':
            case 'float':
               return $data;
            case 'string':
               return "'" . addslashes($data) . "'";
            case 'object':
               $data = get_object_vars($data);
            case 'array':
               $output_index_count = 0;
               $output_indexed = array();
               $output_associative = array();
               foreach ($data as $key => $value) {
                  $output_indexed[] = json_encode($value);
                  $output_associative[] = json_encode($key) . ':' . json_encode($value);
                  if ($output_index_count !== NULL && $output_index_count++ !== $key) {
                        $output_index_count = NULL;
                  }
               }
               if ($output_index_count !== NULL) {
                  return '[' . implode(',', $output_indexed) . ']';
               } else {
                  return '{' . implode(',', $output_associative) . '}';
               }
            default:
               return ''; // Not supported
      }
   }
?>
