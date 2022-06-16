<?php

namespace App;

class Helper
{
    public static function uploadImage()
    {
        if (0 == $_FILES['myimg']['error'] && ($_FILES['myimg']['type'] == 'image/jpeg' || $_FILES['myimg']['type'] == 'image/png')) {
            move_uploaded_file($_FILES['myimg']['tmp_name'], __DIR__ . '/../images/' . $_FILES['myimg']['full_path']);
        } else {
            echo 'ERROR WITH UPLOADING FILE';
        }
    }
}
