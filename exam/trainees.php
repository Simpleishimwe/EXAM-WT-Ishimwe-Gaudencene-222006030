<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>trainees Page</title>
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
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT US</a>
    <li style="display: inline; margin-right: 10px;"><a href="./trainees.php">TRAINEES</a>
        <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">SIGN OUT</a>
      <div class="dropdown-contents">
      <!-- Links inside the dropdown menu -->
      <a href="logout.php">Logout</a>
      </div>

  </li>
  </li>
    </li><br><br>
    
  </ul>

</header>
<section>
<h1>trainees Form</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="id">Id:</label>
        <input type="number" id="id" name="id"><br><br>

        <label for="name">name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="address">address:</label>
        <input type="text" id="address" name="address" required><br><br>

    
        <label for="telephone">telephone:</label>
        <input type="number" id="telephone" name="telephone" required><br><br>

        <input type="submit" name="add" value="Insert">

    </form>

    <?php
    // Connection details
    include('connection.php');


    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO trainees (id, name, address, telephone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id,$name,$address, $telephone);

        // Set parameters from POST data with validation (optional)
        $id = intval($_POST['id']); // Ensure integer for ID
        $name = htmlspecialchars($_POST['name']); // Prevent XSS
        $address = htmlspecialchars($_POST['address']); // Prevent XSS
        $telephone = filter_var($_POST['telephone']); 
        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New trainee record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>

<?php
// Connection details
include('connection.php');

// SQL query to fetch data from category table
$sql = "SELECT * FROM trainees";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>trainnes table</title>
    <style>
        table {
            width: 80%;
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
    <center><h2>Table of trainees</h2></center>
    <table border="3">
        <tr>
          
            <th>Id</th>
            <th>trainees names</th>
            <th>address</th>
            <th>telephone</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        include('connection.php');


        // Prepare SQL query to retrieve customer.
        $sql = "SELECT * FROM trainees";
        $result = $connection->query($sql);

        // Check if there are any product
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cuid = $row['id']; // Fetch the Id
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['telephone'] . "</td>
                    <td><a style='padding:4px' href='delete_trainees.php?id=$cuid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_trainees.php?id=$cuid'>Update</a></td> 
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
    <b><marquee><h2>UR CBE BIT grp 3 &copy, 2024 & reg</h2></marquee></b>
  </center>
</footer>
</body>
</html>