<html>
    <body>
        <?php
        require $_SERVER['DOCUMENT_ROOT'].'/../db.php';
            echo var_dump($_GET);
            $playerID = $_GET['token'];

            $sql = "UPDATE `player` SET get_email = 0 WHERE `player_id` = '$playerID'";

            $result = @mysqli_query($cnxn, $sql);
            var_dump($result);
         ?>
    </body>
</html>