<?php
require '../db.php';

// if (isset($_POST['signup'])) {
  $username = $_POST['username'];
  $password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
  );

  try {
    $sql = "SELECT studentID 
            FROM student 
            WHERE studentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $sql = "INSERT INTO users (username, password) 
              VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ss', $username, $password);
      $stmt->execute();
      http_response_code(201);
      echo json_encode(['message'=>'Success']);
      // echo 'Success';
    }
    else {
      http_response_code(400);
      echo json_encode(['message'=>'Student ID not found.']);
      // echo 'Student ID not found.';
    }
  }
  catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message'=>'Server error.']);
    // echo $e->getMessage();
  }
// }
?>