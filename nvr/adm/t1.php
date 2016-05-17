<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
try
{
    $this->dbh = new PDO('sqlite:users.sqlite'); // new PDO($dsn, $user, $password);
} catch (PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}
$Username =
$stmt = $this->dbh->prepare("SELECT * as count FROM users WHERE username = :username");
$stmt->bindParam(':username', $Username);
//$stmt->bindParam(':password', $this->Password);

try {
    $stmt->execute();
}
catch(PDOException $e)
{
    echo $e->getMessage();
}