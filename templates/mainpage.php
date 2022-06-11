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
    <h2 align="center">BEST BOOKSHOP</h2>
    <p>
    <form action="index.php" method="post" align="center">
        <input type="submit" value="sortbyprice" class="search" name="sort">
    </form>
    </p>
    <p>
    <form action="addingbook.php" method="post" align="center">
        <input type="submit" value="add new book" class="search" name="add">
    </form>
    </p>
    <p>
    <form action="index.php" method="post" align="center">
        <input type="string" name="search" class="search">
        <input type="submit" value="search" class="search">
    </form>
    </p>


    <div class="containeritem">
        <?php foreach ($data['books'] as $book) { ?>
            <div class="item">
                <img src="<?php echo $book['image']; ?>" alt="kitten" width="230px">
                <?php
                echo '<a href="secondpage.php?id=' . $book['id'] . '">' . $book['title'] . '</a>';
                echo "<br>";
                echo $book['author'];
                echo "<br>";
                echo "<b>" . $book['price'] . "</b> рублей";
                ?>
            </div>
        <?php } ?>
    </div>

</body>

</html>