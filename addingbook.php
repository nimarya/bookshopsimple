<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="templates\style.css">
</head>

<body>

    <h3>Adding new book</h3>
    <p>
    <form action="addingbook.php" method="post" enctype="multipart/form-data">
        <p><input type="string" value="title" name="title" class="search"></p>
        <p><input type="string" value="author" name="author" class="search"></p>
        <p><textarea type="string" name="description" class="in">description</textarea></p>
        <p><input type="int" value="price" name="price" class="search"></p>
        <p><input type="file" name="myimg"></p>
        <p><input type="submit" value="отправить" class="search"></p>
    </form>
    </p>



    <?php
    require __DIR__ . '/classes/DataBase.php';
    $dsn = 'mysql:host=127.0.0.1;dbname=bookshop';
    $database = new DataBase($dsn, 'root', '');



    if (isset($_FILES['myimg'])) {
        // echo $_FILES['myimg']['full_path'];
        if (0 == $_FILES['myimg']['error'] && ($_FILES['myimg']['type'] == 'image/jpeg' || $_FILES['myimg']['type'] == 'image/png')) {
            move_uploaded_file($_FILES['myimg']['tmp_name'], __DIR__ . '/images/' . $_FILES['myimg']['full_path']);
            //echo 'SUCCESSFULLY UPLOADED :)';
        } else {
            echo 'ERROR WITH UPLOADING FILE';
        }
    }

    if (!empty($_POST['title'])) {
        $database->addBook($_POST['title'], $_POST['author'], $_POST['description'], $_POST['price'], '/images/' . $_FILES['myimg']['full_path']);
    }

    ?>
</body>

</html>