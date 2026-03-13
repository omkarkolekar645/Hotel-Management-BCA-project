<?php
session_start();
include '../config.php';

// page redirect
$usermail = "";
$usermail = $_SESSION['usermail'];
if ($usermail == true) {

} else {
    header("location: http://localhost/hotelmanage_system/index.php");
}

// Handle Room Price Updates
if(isset($_POST['update_price'])) {
    $roomType = mysqli_real_escape_string($conn, $_POST['room_type']);
    $newPrice = mysqli_real_escape_string($conn, $_POST['new_price']);
    $updateSql = "UPDATE room SET price = '$newPrice' WHERE type = '$roomType'";
    mysqli_query($conn, $updateSql);
    // Refresh to show updated prices
    header("Location: manager_panel.php");
    exit();
}

// Handle Staff Updates
if(isset($_POST['update_staff'])) {
    $staffId = mysqli_real_escape_string($conn, $_POST['staff_id']);
    $newSalary = mysqli_real_escape_string($conn, $_POST['salary']);
    $newPhone = mysqli_real_escape_string($conn, $_POST['phone']);
    $updateStaffSql = "UPDATE staff SET salary = '$newSalary', phone = '$newPhone' WHERE id = '$staffId'";
    mysqli_query($conn, $updateStaffSql);
    // Refresh to show updated values
    header("Location: manager_panel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <!-- loading bar -->
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="../css/flash.css">
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>BlueBird - Manager Panel</title>
    <style>
        .manager-content {
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .section-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- mobile view -->
    <div id="mobileview">
        <h5>Admin panel doesn't show in mobile view</h4>
    </div>
  
    <!-- nav bar -->
    <nav class="uppernav">
        <div class="logo">
            <img class="bluebirdlogo" src="../image/bluebirdlogo.png" alt="logo">
            <p>BLUEBIRD</p>
        </div>
        <div class="logout">
        <a href="../logout.php"><button class="btn btn-primary">Logout</button></a>
        </div>
    </nav>
    <nav class="sidenav">
        <ul>
            <a href="admin.php" style="text-decoration: none; color: inherit;"><li class="pagebtn"><img src="../image/icon/dashboard.png">&nbsp&nbsp&nbsp Dashboard (Go Back)</li></a>
            <li class="pagebtn active"><i class="fa-solid fa-user-tie" style="margin-left: 5px; font-size: 1.2rem; color: #555;"></i>&nbsp&nbsp&nbsp Manager Controls</li>
        </ul>
    </nav>

    <!-- main section -->
    <div class="mainscreen" style="overflow-y: auto;">
        <div class="manager-content">
            <h2 class="mb-4">Manager Control Panel</h2>
            
            <div class="row">
                <!-- Staff Salaries Section -->
                <div class="col-md-6">
                    <div class="section-card">
                        <h4>Staff Salaries & Contact</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Salary (₹)</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $staffSql = "SELECT * FROM staff";
                                    $staffRes = mysqli_query($conn, $staffSql);
                                    while($row = mysqli_fetch_array($staffRes)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['work']) . "</td>";
                                        echo "<form action='' method='POST'>";
                                        echo "<td><input type='number' step='0.01' name='salary' value='" . $row['salary'] . "' class='form-control form-control-sm'></td>";
                                        echo "<td><input type='text' name='phone' value='" . htmlspecialchars($row['phone']) . "' class='form-control form-control-sm'></td>";
                                        echo "<td>
                                                <input type='hidden' name='staff_id' value='" . $row['id'] . "'>
                                                <button type='submit' name='update_staff' class='btn btn-sm btn-primary'>Update</button>
                                              </td>";
                                        echo "</form>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Room Prices Section -->
                <div class="col-md-6">
                    <div class="section-card">
                        <h4>Update Room Prices</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Bedding</th>
                                        <th>Current Price (₹)</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $roomSql = "SELECT type, MAX(price) as price FROM room GROUP BY type";
                                    $roomRes = mysqli_query($conn, $roomSql);
                                    while($row = mysqli_fetch_array($roomRes)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                                        echo "<td>Any</td>";
                                        echo "<form action='' method='POST'>";
                                        echo "<td><input type='number' step='0.01' name='new_price' value='" . $row['price'] . "' class='form-control form-control-sm'></td>";
                                        echo "<td>
                                                <input type='hidden' name='room_type' value='" . $row['type'] . "'>
                                                <button type='submit' name='update_price' class='btn btn-sm btn-primary'>Update</button>
                                              </td>";
                                        echo "</form>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
