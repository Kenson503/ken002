<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'info');

$user = null; // Initialize user variable
// Check if we received an ID via GET to fetch the user to edit
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Select the user record based on ID
    $sql = "SELECT * FROM logs WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    // Fetch the record into an associative array
    $user = mysqli_fetch_assoc($result);
}

// Check if the form has been submitted via POST
if(isset($_POST['update'])){
    $id = $_POST['id'];                         // Hidden input passed in the form
    $firstname = $_POST['name'];           // Updated firstname
    $msg = $_POST['message'];                       // Updated message
    $email = $_POST['email'];                   // Updated email

    // Update the record in the database
    $sql = "UPDATE logs SET name='$name', message='$comment', email='$email' WHERE id='$id'";
    mysqli_query($conn, $sql);

    // Redirect back to dashboard after update
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
    h1,p {
        text-align: center;
        color: #333;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    form div {
        margin-bottom: 15px;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 100px;
        width: 40%;
        font-size: 20px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }
    </style>
</head>
<body>
    <!-- Update form section -->
    <section>
        <h1>Update User</h1>
        <p>Update the user details below:</p>
        <div>
           <?php if($user){ ?>
            <form action="update.php" method="POST">
                <!-- Hidden field for ID (important for the update query) -->
                <div>
                    <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                </div>

                <!-- Input for first name -->
                <div>
                    <label for="name">firstname</label>
                    <input type="text" name="name" placeholder="Enter name" value="<?php echo $user['name'] ?>">
                </div>
                <!-- Input for email -->
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Enter email" value="<?php echo $user['email'] ?>">
                </div>
                <!-- Textarea for message -->
                <div>
                    <label for="message">Comment</label>
                    <textarea name="message" placeholder="Enter message"><?php echo $user['message'] ?></textarea>
                </div>
                <!-- Submit button -->
                <div>
                    <input type="submit" name="update" value="Update">
                </div>
            </form>
           <?php } ?>
        </div>
    </section>
</body>
</html>
