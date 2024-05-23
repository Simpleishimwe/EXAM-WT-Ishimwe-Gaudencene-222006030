<?php
include('connection.php');

// Check if Product_Id is set
if (isset($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
//product (id,barcode,category_id, name,cost,quantity,total_cost,created_at
  // Prepare statement with parameterized query to prevent SQL injection (security improvement)
  $stmt = $connection->prepare("SELECT * FROM trainees WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $a = $row['id'];
    $b = $row['name'];
    $c = $row['address'];
    $d = $row['telephone'];
  } else {
    echo "trainee not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update trainee table</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update products form -->
    <h2><u>Update Form of trainee</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="name">name:</label>
    <input type="text" name="name" value="<?php echo isset($b) ? $b : ''; ?>">
    <br><br>

    <label for="address">address:</label>
    <input type="text" name="address" value="<?php echo isset($c) ? $c : ''; ?>">
    <br><br>

    <label for="telephone">telephone:</label>
    <input type="number" name="telephone" value="<?php echo isset($d) ? $d : ''; ?>">
    <br><br>

    <input type="submit" name="up" value="Update">

  </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $name = $_POST['name'];
  $address = $_POST['address'];
  $telephone = $_POST['telephone'];

  // Update the trainee in the database (prepared statement again for security)
  $stmt = $connection->prepare("UPDATE trainees SET name=?, address=?, telephone=? WHERE  id=?");
  $stmt->bind_param("sssi", $name, $address, $telephone,$id);
  $stmt->execute();

  // Redirect to product.php
  header('Location: trainees.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
