<?php
// Database connection details
$serverName = "your-server-name.database.windows.net";
$databaseName = "your-database-name";
$username = "your-username";
$password = "your-password";

// Create connection
$connectionOptions = array(
    "Database" => $databaseName,
    "Uid" => $username,
    "PWD" => $password,
    "TrustServerCertificate" => false
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Fetch employee data
$query = "SELECT EmployeeID, FirstName, LastName, Email, HireDate FROM Employee";
$stmt = sqlsrv_query($conn, $query);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Employee List</h1>
    <table>
        <tr>
            <th>EmployeeID</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>HireDate</th>
        </tr>
        <?php
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['EmployeeID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['HireDate']->format('Y-m-d')) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the connection
sqlsrv_close($conn);
?>
