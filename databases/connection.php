<?php
$conn = new mysqli("localhost", "root", "", "db_sig");

if ($conn->connect_error) {
    die("connection failed: " . $db->connect_error);
}
