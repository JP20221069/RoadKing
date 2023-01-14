<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <?php
    include_once("php/Classes.php");
    $q= DataManager::getAllUsers($mysqli);

    ?>
    <!-- <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </table> -->
</body>

</html>