<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/../styles/style.css">
</head>

<body>

    <h3>Adding new book</h3>
    <p>
    <form action="createbook" method="post" enctype="multipart/form-data">
        <p><input type="string" value="title" name="title" class="search"></p>
        <p><input type="string" value="author" name="author" class="search"></p>
        <p><textarea type="string" name="description" class="in">description</textarea></p>
        <p><input type="int" value="price" name="price" class="search"></p>
        <p><input type="file" name="myimg"></p>
        <p><input type="submit" value="отправить" class="search"></p>
    </form>
    </p>

</body>

</html>