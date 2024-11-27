<?php
$steps=0;
// load dependencies
require '../vendor/autoload.php'; //cambié la ruta

++$steps;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create log
$log = new Logger("LogWorkerDB");
// define logs location
$log->pushHandler(new StreamHandler("../logs/WorkerDB.log", Level::Info)); // Tuve que cambiar de Error a Info
++$steps;

//ddbb connection, read from miConf.ini
$db = [
    "host" => "127.0.0.1",
    "port" => "3306",
    "user" => "root",
    "pwd" => "123456789",
    "db_name" => "workerdb",
];
++$steps;

try {
    $mysqli = new mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]); //4 db
    // write info message with "Connection successfully"
    if ($mysqli-> connect_error) {
        $log->error("Error connection db: " . $mysqli->connect_error);
        throw new mysqli_sql_exception("Connection failed: " . $mysqli->connect_error);
    }
    
    $log->info("Connection Succefully");
    ++$steps;

    // Create operation
    $sql_sentence = "INSERT INTO worker(dni,name,surname,salary,phone) 
            VALUES('71111111D','Juan','González',20000,'93500202')";

    try {
        $result = $mysqli->query($sql_sentence);
        // write info message with "Record inserted successfully"
        //TODO
        ++$steps;
    } catch (mysqli_sql_exception $e) {
        //  write error message with "Error inserting a record"
        //TODO
    }
} catch (mysqli_sql_exception $e) {
    //  write error message with "Error connection db: + details parameters config"
    //TODO
}
echo "steps executed correctly: " . $steps;
