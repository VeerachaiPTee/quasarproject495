<?php
function cors()
{
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);
    }
}

cors();

$request_data = json_decode(file_get_contents("php://input"));
$data = array();
$servername = "localhost";
$username = "Veerachai";
$password = "Vee1234567890";
$database = "account_sansai";

try {
        $connect = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 
    } catch(PDOException $e) {    
        echo "Connection failed: " . $e->getMessage();
    }
 
    if ($request_data->action == "select") {
        $username ="'". $request_data-> username."'"; 
        $password ="'". $request_data-> password."'"; 
        $query = "SELECT * 
                  FROM account 
                  WHERE username = $username AND password = $password
                ;";
        $statement = $connect->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } 
    if ($request_data->action == "selectfriend") {
        $query = "SELECT * 
                  FROM friend                   
                ;";
        $statement = $connect->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } 
    
    if ($request_data->action == "insert") {
        $data = array(
            ":username" => $request_data->username,
            ":password" => $request_data->password,
            ":email" => $request_data->email,
        );
        $query = "INSERT INTO account (username, password, email) 
                  VALUES(:username, :password, :email)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $output = array(" message " => " Insert Complete ");
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }
    if ($request_data->action == "addfriend") {
        $data = array(
            ":name" => $request_data->name,
            ":nickname" => $request_data->nickname,
            ":age" => $request_data->age,
            ":email" => $request_data->email,
            ":phone" => $request_data->phone,
        );
        $query = "INSERT INTO friend (name, nickname, age, email, phone) 
                  VALUES(:name, :nickname, :age, :email, :phone)";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $output = array(" message " => " Insert Complete ");
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    else if ($request_data->action == "delete") {
        $query = "DELETE FROM friend 
        WHERE f_id = $request_data->f_id";
        $statement = $connect->prepare($query);
        $statement->execute();
        $output = array("message" => "Delete Complete");
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    } 

    else if ($request_data->action == "update") {
        $data = array(
            ":username" => $request_data->username,
            ":password" => $request_data->password,
            ":email" => $request_data->email,
        );
        $query = "UPDATE account 
                  SET 
                      username=:username
                      password=:password
                      email=:email
                  WHERE id_ac = $request_data->id_ac
                  ;";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $output = array("message" => "Update Complete");
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    } 

    else if ($request_data->action == "edit") {
        $query = "SELECT * 
                  FROM account 
                  WHERE id_ac = $request_data->id_ac";
        $statement = $connect->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data['id_ac'] = $row['id_ac'];
            $data['username'] = $row['username'];
            $data['password'] = $row['password'];
            $data['email'] = $row['email'];
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } 
    ?>   