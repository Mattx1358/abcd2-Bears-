<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dresses</title>
    <link rel="stylesheet" href="css/book_form_pages_styles.css">
</head>

<body>



    <?php
	
	require 'bin/functions.php';
	require 'db_configuration.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "abcd_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM dresses";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<ul>';

        while ($row = $result->fetch_assoc()) {
			
			$name = $row["name"];
            $description = $row["description"];
            $did_you_know = $row["did_you_know"];
            $image = $row["image_url"];
            $ID = $row["id"];

			echo '<div class="title" style="text-align: center;"';
            echo '<li>';
            echo '<span style="text-transform: uppercase; color: #000080; height: 100px; font-size: 70px; font-family: "Kanit"; font-weight: bold; text-shadow: 2px 2px 4px #cec6bd; letter-spacing: 1rem; padding-bottom: 100px; padding-left: 200px;">' . $row['name'] . '</span><br>';
            echo '</div>';
			
			echo '<div class="container" style="display: flex; width: 80%; max-width: 1400px; margin: 0 auto;">';
            if (file_exists("images/dress_images/" . $row["image_url"])) {
				echo '<img src="' . "images/dress_images/" . $row["image_url"] . '" style="max-width: 30%; height: auto; display: block;"><';
			} else {
				echo 'Image not found<br>';
			}
			
			
			echo 'ID: ' . $row['id'] . '<br>';
			echo '<span style="color: blue; font-size: 28px">Description:</span><br><span style="flex: 1; padding: 200px; padding-bottom: 100px; padding-top: 100px; font-size: 28px;"> <br>' . $row['description'] . '</span><br><br>';
			echo '<span style="color: blue; font-size: 28px">Did You Know? </span><br><span style="flex: 1; padding: 200px; padding-bottom: 100px; padding-top: 100px; font-size: 28px;"> <br>' . $row['did_you_know'] . '</span><br>';
			echo '</div>';

            

            echo '</li>';
        }

        echo '</ul>';
    } else {
        echo 'No data found';
    }

    $conn->close();
    ?>

</body>
</html>


