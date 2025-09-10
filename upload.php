<?php declare(strict_types=1);

// echo '<pre>';
// print_r($_POST);
// print_r($_FILES);
// echo '</pre>';

function redir() {
    header("Location: index.html");
    exit;
}

// Проверяем, что поле file_name не пустое
if (empty($_POST['file_name']) || !isset($_FILES['content'])) {
    redir();
}


$name = basename($_POST['file_name']);
$extension = pathinfo($_FILES['content']['name'], PATHINFO_EXTENSION);
$dir = __DIR__ . '/upload';
$adress = $dir . '/' . $name;

if (move_uploaded_file($_FILES['content']['tmp_name'], $adress)) {
    $size = filesize($adress);
    echo 'Файл успешно сохранён по пути: ' . htmlspecialchars($adress) .'.'. $extension . '<br />';
    echo "Размер файла: " . $size . " байт";
} else {
    echo "Ошибка при сохранении файла.";
}
