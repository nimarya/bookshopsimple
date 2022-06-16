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
    <img src="<?php echo $book->getImage(); ?>" alt="kitten" class="image">
    <h2><?php echo $book->getTitle(); ?> </h2>
    <h3><?php echo $book->getAuthor(); ?> </h3>
    <h3><?php echo $book->getPrice(); ?> рублей </h3>
    <div class="containerinfo">
        <div class="info">
            <p><b>Описание:</b></p>
            <p><?php echo $book->getDescription(); ?></p>
        </div>
        <div class="info">
            <p><b>Отзывы:</b></p>

            <?php foreach ($comments as $comment) {
                echo "<b>" . $comment->getName() . "</b>";
                echo ': ';
                echo  $comment->getOpinion();
            ?>
                <form action="/books/deletecomment" method="post">
                    <input type="checkbox" name="id" value="<?php echo $comment->getId(); ?>" />
                    <input type="submit" value="delete comment" />
                </form>
            <?php echo "<br>";
            } ?>

            <p>
            <form action="/books/<?php echo $book->getId(); ?>/createcomment" method="post">
                <input type="string" value="имя" name="name" class="search">
                <input type="string" value="ваш отзыв" name="opinion" class="search">
                <input type="submit" value="отправить" class="search">
            </form>
            </p>
        </div>
    </div>



</body>

</html>