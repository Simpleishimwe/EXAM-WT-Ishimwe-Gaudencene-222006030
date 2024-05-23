
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;

      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>
   <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  
<header>
   

</head>

<body bgcolor="skyblue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/logo4.jpg" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./HOME.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./ABOUT US.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./CONTACT US.html">CONTACT US</a>
    <li style="display: inline; margin-right: 10px;"><a href="./category.php">Category</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./product.php">Product</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./product_in.php">Product_in</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./product_out.php">Product_out</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./shop.php">Shop</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
  </ul>

</header>
<section>
<h1>Product Form</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="id">Id:</label>
        <input type="number" id="Cus_Id" name="Cus_Id"><br><br>

        <label for="barcode">Barcode:</label>
        <input type="text" id="Ft_Nm" name="Ft_Nm" required><br><br>

        <label for="category_id">category_id:</label>
        <input type="text" id="ctid" name="ctid" required><br><br>

    
        <label for="name">Name:</label>
        <input type="text" id="dscp" name="dscp" required><br><br>

        <label for="cost">Cost:</label>
        <input type="text" id="cst" name="cst" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="text" id="qnty" name="qnty" required><br><br>

        <label for="total_cost">Total_cost:</label>
        <input type="text" id="tc" name="tc" required><br><br>

        <label for="created_at">Created_at:</label>
        <input type="date" id="crt" name="crt" required><br><br>

          <input type="submit" name="add" value="Insert">

    </form>

    <?php
    // Connection details
    include('db_connection.php');


    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO product (id,barcode,category_id, name,cost,quantity,total_cost,created_at) VALUES (?, ?, ?, ? ,?, ?,?,?)");
        $stmt->bind_param("isssssss", $id,$barcode,$category_id, $name,$cost, $quantity,$total_cost, $created_at);

        // Set parameters from POST data with validation (optional)
        $id = intval($_POST['Cus_Id']); // Ensure integer for ID
        $barcode = htmlspecialchars($_POST['Ft_Nm']); // Prevent XSS
        $category_id = htmlspecialchars($_POST['ctid']); // Prevent XSS
        $name = filter_var($_POST['dscp']); 
        $cost = htmlspecialchars($_POST['cst']); // Prevent XSS
        $quantity = htmlspecialchars($_POST['qnty']); // Prevent XSS
        $total_cost = htmlspecialchars($_POST['tc']); // Prevent XSS
        $created_at = htmlspecialchars($_POST['crt']); // Prevent XSS
        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>

<?php
// Connection details
include('db_connection.php');

// SQL query to fetch data from category table
$sql = "SELECT * FROM product";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of category</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of category</h2></center>
    <table border="5">
        <tr>
          
            <th>Id</th>
            <th>Barcode</th>
            <th>Category_id</th>
            <th>Name</th>
            <th>cost</th>
            <th>Quantity</th>
            <th>Total_cost</th>
            <th>Created_at</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        include('db_connection.php');


        // Prepare SQL query to retrieve customer.
        $sql = "SELECT * FROM product";
        $result = $connection->query($sql);

        // Check if there are any product
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cuid = $row['id']; // Fetch the Id
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['barcode'] . "</td>
                    <td>" . $row['category_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['cost'] . "</td>
                    <td>" . $row['quantity'] . "</td>
                    <td>" . $row['total_cost'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                    <td><a style='padding:4px' href='delete_product.php?id=$cuid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_product.php?id=$cuid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
    </section>

  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 & reg, Designer by: @MUSARE JOSEPH</h2></b>
  </center>
</footer>
</body>
</html>