<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "submitted_docs"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $documentType = $_POST['documentType'];
    $file = $_FILES['fileUpload'];

    if ($file['error'] === 0) {
       
        $fileName = uniqid('', true) . "-" . basename($file['name']);
        $targetDir = "uploads/";
        $targetFile = $targetDir . $fileName;
        $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
        $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                
                $stmt = $conn->prepare("INSERT INTO documents (document_type, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $documentType, $targetFile);

                if ($stmt->execute()) {
                    echo "Document uploaded successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
        echo "Error: " . $file['error'];
    }
}
$conn->close();
?>
