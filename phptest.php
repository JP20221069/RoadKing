<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="css/style.css"/>
</head>

<body>
    <form id="test" action="" method="POST">
        <button type="submit" name="test1" value="Value test 1">Press for test 1</button>
        <br/>
        <button type="submit" name="test2" value="Value test 2">Press for test 2</button>
    </form>
    <?php 
            if(isset($_POST["test1"]))
            {
            echo $_POST["test1"];
            }
            if(isset($_POST["test2"]))
            {
            echo $_POST["test2"];
            }
                
    ?>
</body>

</html>