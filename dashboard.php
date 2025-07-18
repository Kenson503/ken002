<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'info');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database
$sql = "SELECT id,name, email,message FROM logs";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logs Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f6f8;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        button {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
        .delete-button {
            background-color: #dc3545;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>logs  Dashboard</h1>

    <?php if(mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>message</th>
                <th>Email</th>
                <th colspan="2">Actions</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["message"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><a href="update.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to update this record?')"><button>Edit</button></a></td>
                    <td>
                        <a href="delete.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?')">
                            <button class="delete-button">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">No records found.</p>
    <?php endif; ?>
</body>
</html>
