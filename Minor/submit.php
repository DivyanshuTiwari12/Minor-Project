<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $aadhar = $_POST['aadhar'];
    $pan = $_POST['pan'];
    $tenthPercentage = $_POST['tenthPercentage'];
    $twelfthPercentage = $_POST['twelfthPercentage'];
    $uploadDir = 'uploads/';
    $aadharFile = $_FILES['aadharFile'];
    $panFile = $_FILES['panFile'];
    $tenthFile = $_FILES['tenthFile'];
    $twelfthFile = $_FILES['twelfthFile'];
    $uniqueAadharName = time() . '_' . uniqid() . '_' . basename($aadharFile['name']);
    $uniquePanName = time() . '_' . uniqid() . '_' . basename($panFile['name']);
    $uniqueTenthName = time() . '_' . uniqid() . '_' . basename($tenthFile['name']);
    $uniqueTwelfthName = time() . '_' . uniqid() . '_' . basename($twelfthFile['name']);
    $aadharFilePath = $uploadDir . $uniqueAadharName;
    $panFilePath = $uploadDir . $uniquePanName;
    $tenthFilePath = $uploadDir . $uniqueTenthName;
    $twelfthFilePath = $uploadDir . $uniqueTwelfthName;

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=user_verification", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO user_entries (name, gender, dob, aadhar, pan, tenthPercentage, twelfthPercentage, aadharFile, panFile, tenthFile, twelfthFile) 
                VALUES (:name, :gender, :dob, :aadhar, :pan, :tenthPercentage, :twelfthPercentage, :aadharFile, :panFile, :tenthFile, :twelfthFile)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':aadhar', $aadhar);
        $stmt->bindParam(':pan', $pan);
        $stmt->bindParam(':tenthPercentage', $tenthPercentage);
        $stmt->bindParam(':twelfthPercentage', $twelfthPercentage);
        $stmt->bindParam(':aadharFile', $aadharFilePath);
        $stmt->bindParam(':panFile', $panFilePath);
        $stmt->bindParam(':tenthFile', $tenthFilePath);
        $stmt->bindParam(':twelfthFile', $twelfthFilePath);

        $stmt->execute();

        if (move_uploaded_file($aadharFile['tmp_name'], $aadharFilePath) &&
            move_uploaded_file($panFile['tmp_name'], $panFilePath) &&
            move_uploaded_file($tenthFile['tmp_name'], $tenthFilePath) &&
            move_uploaded_file($twelfthFile['tmp_name'], $twelfthFilePath)) 
            {
            $lastInsertedId = $pdo->lastInsertId();
            $csvQuery = "SELECT * FROM user_entries WHERE id = :id";
            $csvStmt = $pdo->prepare($csvQuery);
            $csvStmt->bindParam(':id', $lastInsertedId);
            $csvStmt->execute();
            $userData = $csvStmt->fetch(PDO::FETCH_ASSOC);
            $csvFilePath = 'csv_files/user_entry_' . $lastInsertedId . '.csv';
            $outputFile = fopen($csvFilePath, 'w');
            $headers = ['ID', 'Name', 'Gender', 'Date of Birth', 'Aadhar', 'PAN', '10th Percentage', '12th Percentage', 'Aadhar File', 'PAN File', '10th File', '12th File'];
            fputcsv($outputFile, $headers);
            fputcsv($outputFile, $userData);
            fclose($outputFile);

            echo "Data inserted successfully! ";
        } 
        else {
            echo "Error uploading files.";
        }
    } catch (PDOException $e) {
        echo "Error inserting data: " . $e->getMessage();
    }
}
?>
