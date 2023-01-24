<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="css/style.css"/>
</head>

<body>
    <?php
    include_once("php/Classes.php");
    DataManager::getAllUsersAsDT($mysqli);
    echo "<br/>";
    DataManager::getAllUsersAsObjArray($mysqli);


    ?>
    <!-- <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </table> -->
</body>

</html>