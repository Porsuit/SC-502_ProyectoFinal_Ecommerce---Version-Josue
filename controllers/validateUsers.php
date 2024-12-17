<?php
// Include the database connection
include 'db_connect.php';

// Check if the form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;

    if ($email) {
        try {
            // Prepare a query to check for the email in the database
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch the result
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "User already exists with email: " . htmlspecialchars($email);
            } else {
                echo "No user found with email: " . htmlspecialchars($email);
            }
        } catch (PDOException $e) {
            // Handle query errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please provide an email address.";
    }
}
?>