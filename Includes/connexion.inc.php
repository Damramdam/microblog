<?php
$pdo = new PDO('mysql:host=localhost;dbname=damien-commard', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);