<?php
 
/*
 * Following code will list all the forms
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all forms from forms table
$result = mysql_query("SELECT *FROM forms") or die(mysql_error());

//add session time access param afterwards
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // forms node
    $response["forms"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $form = array();
        $form["fid"] = $row["fid"];
        $form["title"] = $row["title"];
        $form["xml"] = $row["xml"];
        $form["updated_at"] = $row["updated_at"];
 
        // push single form into final response array
        array_push($response["forms"], $form);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no forms found
    $response["success"] = 0;
    $response["message"] = "No forms found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
