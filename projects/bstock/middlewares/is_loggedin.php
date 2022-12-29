<?php
if (!isset($_SESSION['myId'])) {
    header('location: index.php');
}