<?php
include('../config/db.php');

$id = $_POST['id'];
$response = $_POST['response'];

$sql = "UPDATE feedback SET response='$response' WHERE id=$id";

$conn->query($sql);

header("Location: dashboard.php");
?>