<?php
include("config.php");
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

// Handle add, modify, or delete annonces logic here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_annonce"])) {
        // Add annonce logic goes here
        $title = $_POST["title"];
        $description = $_POST["description"];
        $image = $_POST["image"];

        $sql_add_annonce = "INSERT INTO annonces (title, description, image) VALUES ('$title', '$description', '$image')";
        $result_add_annonce = $conn->query($sql_add_annonce);

        if ($result_add_annonce) {
            echo "Annonce added successfully!";
        } else {
            echo "Error adding annonce: " . $conn->error;
        }
    } elseif (isset($_POST["modify_annonce"])) {
        // Modify annonce logic goes here
        $annonce_id = $_POST["annonce_id"];
        $new_title = $_POST["new_title"];
        $new_description = $_POST["new_description"];
        $new_image = $_POST["new_image"];

        $sql_modify_annonce = "UPDATE annonces SET title='$new_title', description='$new_description', image='$new_image' WHERE id='$annonce_id'";
        $result_modify_annonce = $conn->query($sql_modify_annonce);

        if ($result_modify_annonce) {
            echo "Annonce modified successfully!";
        } else {
            echo "Error modifying annonce: " . $conn->error;
        }
    } elseif (isset($_POST["delete_annonce"])) {
        // Delete annonce logic goes here
        $annonce_id_to_delete = $_POST["annonce_id_to_delete"];

        $sql_delete_annonce = "DELETE FROM annonces WHERE id='$annonce_id_to_delete'";
        $result_delete_annonce = $conn->query($sql_delete_annonce);

        if ($result_delete_annonce) {
            echo "Annonce deleted successfully!";
        } else {
            echo "Error deleting annonce: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome to the Dashboard</h2>

<!-- Add Annonce Form -->
<h3>Add Annonce</h3>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <label for="image">Image URL:</label>
    <input type="text" name="image" required>

    <input type="submit" name="add_annonce" value="Add Annonce">
</form>

<!-- Modify Annonce Form -->
<h3>Modify Annonce</h3>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="annonce_id">Annonce ID to Modify:</label>
    <input type="text" name="annonce_id" required>

    <label for="new_title">New Title:</label>
    <input type="text" name="new_title" required>

    <label for="new_description">New Description:</label>
    <textarea name="new_description" required></textarea>

    <label for="new_image">New Image URL:</label>
    <input type="text" name="new_image" required>

    <input type="submit" name="modify_annonce" value="Modify Annonce">
</form>

<!-- Delete Annonce Form -->
<h3>Delete Annonce</h3>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="annonce_id_to_delete">Annonce ID to Delete:</label>
    <input type="text" name="annonce_id_to_delete" required>

    <input type="submit" name="delete_annonce" value="Delete Annonce">
</form>

<p><a href="logout.php">Logout</a></p>

</body>
</html>
