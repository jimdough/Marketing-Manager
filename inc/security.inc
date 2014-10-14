<?PHP
session_start();

if (!isset($_SESSION['id'])) {
     header("Location:/default.php");
     die();     // just to make sure no scripts execute
}

?>