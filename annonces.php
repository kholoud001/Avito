<?php
include("config.php");

// Fetch annonces from the database
$sql_fetch_annonces = "SELECT * FROM annonces";
$result_fetch_annonces = $conn->query($sql_fetch_annonces);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Annonces</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        .annonces-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .annonce {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .annonce img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        p {
            margin: 0;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>

<h2>List of Annonces</h2>

<div class="annonces-container">
    <?php
    if ($result_fetch_annonces->num_rows > 0) {
        while ($row = $result_fetch_annonces->fetch_assoc()) {
            echo "<div class='annonce'>";
            echo "<h3>" . $row["title"] . "</h3>";
            echo "<img src='" . $row["image"] . "' alt='Annonce Image'>";
            echo "<p>" . $row["description"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No annonces available.";
    }
    ?>
</div>

<p><a href="index.php">Back to Home</a></p>

</body>
</html>
