<?php 
    ob_start();
    session_start();

    if ($_SESSION['role'] != 'admin'){
        header('Location:index.php'); 
    }

    require 'bin/functions.php';
    require 'db_configuration.php';
    include('header.php'); 
    
    ob_end_flush();
?>

<html>
<head>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f40040d297.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2 id="title">Admin</h2>
    </div>
    <div class="iconsContainer">
    <table class="center">
         <tr>
            <td><a href="users.php" class="adminLinks"><i class="fa fa-user IconUse" id="adIconOne"></i><p class="iconLabel"><strong>users</strong></p></a></td>
            <td><a href="import.php"><i class="fa fa-arrow-down" id="adIconTwo"></i><p class="iconLabel"><strong>import</strong></p></a></td>
            <td><a href="export.php"><i class="fa fa-arrow-up-from-bracket" id="adIconThree"></i><p class="iconLabel"><strong>export</strong></p></a></td>
            <td><a href="exportPDF.php"><i class="fa fa-file-pdf" id="adIconFour"></i><p class="iconLabel"><strong>export pdf</strong></p></a></td>
</tr>
<tr>
            <td><a href="export_powerpoint_options.php"><i class="fa fa-file-powerpoint" id="adIconFive"></i><p class="iconLabel"><strong>powerpoint</strong></p></a></td>
            <td><a href="help.php"><i class="fa fa-circle-question" id="adIconSix"></i><p class="iconLabel"><strong>help</strong></p></a></td>
            <td><a href="games.php"><i class="fa fa-dice" id="adIconSeven"></i><p class="iconLabel"><strong>games</strong></p></a></td>
            <td><a href="my_favorite.php"><i class="fa fa-shirt" id="adIconEight"></i><p class="iconLabel"><strong>my favorite</strong></p></a></td>
</tr>
<tr class="lastCol">
            <td><a href="reports_summary.php"><i class="fa fa-file-lines" id="adIconNine"></i><p class="iconLabel"><strong>reports summary</strong></p></a></td>
            <td><a href="preferences.php"><i class="fa fa-gear" id="adIconTen"></i><p class="iconLabel"><strong>preferences</strong></p></a></td>
            <td><a href="artistEdit.php"><i class="fa fa-palette" id="adIconEleven"></i><p class="iconLabel"><strong>artists</strong></p></a></td>
            <td><a href="resources.php"><i class="fa-solid fa-scroll" id="adIconTwelve"></i><p class="iconLabel"><strong>resources</strong></p></a></td>
            <td><a href="admin_query.php" class="adminLinks"><i class="fa fa-user IconUse" id="adIconOne"></i><p class="iconLabel"><strong>advanced query</strong></p></a></td>
            <td><a href="suggest_data_table.php" class="adminLinks"><i class="fa fa-user IconUse" id="adIconOne"></i><p class="iconLabel"><strong>review suggestions</strong></p></a></td>
            <!--<td><a href="book_form.php" class="adminLinks" target="_blank"><i class="fa fa-code IconUse" id="generateHtmlIcon"></i><p class="iconLabel"><strong>Generate HTML</strong></p></a></td>..-->
            <td>
                <a href="book_form.php" class="adminLinks" target="_blank">
                    <i class="fa fa-code IconUse" id="generateHtmlIcon"></i>
                    <p class="iconLabel"><strong>Generate HTML</strong></p>
                </a>
            </td>
        </tr>
    </table>
</div>
     
</body>
</html>
 