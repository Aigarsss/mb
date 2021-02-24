<?php

require 'config.php';

// Select stuff
$provider = "gmail";

$query = "SELECT * FROM SUBSCRIBERS WHERE provider = :provider";
$statement = $conn->prepare($query);
$statement->execute(["provider" => $provider]);

$emails = $statement->fetchAll();

foreach($emails as $email) {
    echo $email->email . "<br>";
}

?>