<?php
ob_start();
session_start();

function view($name,$data = []){
    extract($data);

    return require "includes/views/{$name}.view.php";
}
function pdf($name,$data = []){
    extract($data);

    return require "includes/{$name}.php";
}

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

function getuserfield($field) {
    global $connection;
    $query = "SELECT {$field} FROM users WHERE id ='". $_SESSION['user_id']."'" ;
    if ($query_run = mysqli_query($connection,$query)){
        $result = $query_run->fetch_assoc()[$field];
        return $result;
    } else {
    }
}

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed.");
    }
}

function manifest ($id){
    global $connection;

    $query = 'SELECT * ';
    $query .= 'FROM manifest ';
    $query .= "WHERE id = {$id}";
    $manifest_result = mysqli_query($connection,$query);
    confirm_query($manifest_result);
    return $manifest_result;
}

function get_manifest_no ($id){
    global $connection;

    $query = 'SELECT manifest_no ';
    $query .= 'FROM manifest ';
    $query .= "WHERE id = {$id}";
    $manifest_no_result = mysqli_query($connection,$query);
    confirm_query($manifest_no_result);
    return $manifest_no_result;
}

function manifest_details ($id){
    global $connection;

    $query = 'SELECT * ';
    $query .= 'FROM manifest_details ';
    $query .= "WHERE id = {$id}";
    $manifest_details_result = mysqli_query($connection,$query);
    confirm_query($manifest_details_result);
    return $manifest_details_result;
}

function customer ($id){
    global $connection;

    $query = 'SELECT * ';
    $query .= 'FROM customers ';
    $query .= "WHERE id = {$id}";
    $customer_result = mysqli_query($connection,$query);
    confirm_query($customer_result);
    return $customer_result;
}

function pod ($id){
    global $connection;

    $query = 'SELECT * ';
    $query .= 'FROM pod ';
    $query .= "WHERE id = {$id}";
    $pod_result = mysqli_query($connection,$query);
    confirm_query($pod_result);
    return $pod_result;
}

function user ($id){
    global $connection;

    $query = 'SELECT * ';
    $query .= 'FROM users ';
    $query .= "WHERE id = {$id}";
    $user_result = mysqli_query($connection,$query);
    confirm_query($user_result);
    return $user_result;
}

function getAllUsers($pdo){
    $statement = $pdo->prepare('SELECT * FROM users');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS,'User');
}

function quantity($id) {
    global $connection;

    $query = "SELECT SUM(qty) FROM manifest_details WHERE manifest_no = {$id}";
    $qty_result = mysqli_query($connection,$query);
    confirm_query($qty_result);
    return $qty_result;
}

function weight($id) {
    global $connection;

    $query = "SELECT SUM(weight) FROM manifest_details WHERE manifest_no = {$id}";
    $weight_result = mysqli_query($connection,$query);
    confirm_query($weight_result);
    return $weight_result;
}

function overnight($id) {
    global $connection;

    $query = "SELECT SUM(weight) FROM manifest_details WHERE manifest_no = {$id} AND type = 'EXP'";
    $overnight_result = mysqli_query($connection,$query);
    confirm_query($overnight_result);
    return $overnight_result;
}

function budget($id) {
    global $connection;

    $query = "SELECT SUM(weight) FROM manifest_details WHERE manifest_no = {$id} AND type = 'BDG'";
    $budget_result = mysqli_query($connection,$query);
    confirm_query($budget_result);
    return $budget_result;
}

function consol($id) {
    global $connection;

    $query = "SELECT SUM(weight) FROM manifest_details WHERE manifest_no = {$id} AND type = 'CON'";
    $consol_result = mysqli_query($connection,$query);
    confirm_query($consol_result);
    return $consol_result;
}

function economy($id) {
    global $connection;

    $query = "SELECT SUM(weight) FROM manifest_details WHERE manifest_no = {$id} AND type = 'ECO'";
    $economy_result = mysqli_query($connection,$query);
    confirm_query($economy_result);
    return $economy_result;
}


?>