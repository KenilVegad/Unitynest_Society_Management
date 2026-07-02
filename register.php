<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get inputs
    $Role = $_POST['role'];
    $Username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $Password = trim($_POST['password']);

    // Role-specific fields
    $flatno = $_POST['flatno'] ?? null;
    $mobileno = $_POST['mobno'] ?? ($_POST['worker_mobno'] ?? $_POST['rental_mobno'] ?? null);
    $familymem = $_POST['fammem'] ?? null;
    $job_role = $_POST['job_role'] ?? null;
    $owner_name = $_POST['owner_name'] ?? null;

    // File upload handling
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $aadhaar_doc = $property_doc = $application_doc = null;

    // Upload Aadhaar for worker
    if ($Role === "worker" && isset($_FILES['aadhaar_doc']) && $_FILES['aadhaar_doc']['error'] === 0) {
        $aadhaar_doc = uniqid("aadhaar_") . "_" . basename($_FILES['aadhaar_doc']['name']);
        move_uploaded_file($_FILES['aadhaar_doc']['tmp_name'], $upload_dir . $aadhaar_doc);
    }

    // Upload Property doc for owner
    if ($Role === "owner" && isset($_FILES['property_doc']) && $_FILES['property_doc']['error'] === 0) {
        $property_doc = uniqid("property_") . "_" . basename($_FILES['property_doc']['name']);
        move_uploaded_file($_FILES['property_doc']['tmp_name'], $upload_dir . $property_doc);
    }

    // Upload Application form for rental
    if ($Role === "rental" && isset($_FILES['application_doc']) && $_FILES['application_doc']['error'] === 0) {
        $application_doc = uniqid("application_") . "_" . basename($_FILES['application_doc']['name']);
        move_uploaded_file($_FILES['application_doc']['tmp_name'], $upload_dir . $application_doc);
    }

    // DB connection
    $conn = mysqli_connect("localhost", "root", "", "usersregister");
    if (!$conn) { 
        
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL insert based on role
    mysqli_stmt_bind_param($stmt, "ssssssssssss",  // 12 's' types for 12 variables
    $Role, $Username, $email, $flatno, $mobileno, $familymem, $Password,
    $job_role, $owner_name,
    $aadhaar_doc, $property_doc, $application_doc
);


    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssssss",
        $Role, $Username, $email, $flatno, $mobileno, $Password,
        $job_role, $owner_name,
        $aadhaar_doc, $property_doc, $application_doc
    );
    

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Registration successful! Awaiting admin approval.');
                    window.location.href = 'login.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Registration failed. Please try again.');
                    window.location.href = 'login.html';
                  </script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
                alert('Database error.');
                window.location.href = 'login.html';
              </script>";
    }

    mysqli_close($conn);
}
?>