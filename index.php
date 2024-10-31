<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $dns = "mysql:host=127.0.0.1;dbname=book";
    $username = "root";
    $password = "root";
    $pdo = new PDO($dns, $username, $password);

    if (isset($_GET['name']) && isset($_GET['year'])) {
        $name = $_GET['name'];
        $year = $_GET['year'];

        $query = "INSERT INTO book(name, year) VALUES('$name', '$year')";
        $pdo->query($query);

        echo "<p>Ma'lumotlar muvaffaqiyatli qo'shildi. </p>";
    }

    $workTimes = $pdo->query("SELECT * FROM book");
    print_r($workTimes->fetchAll(PDO::FETCH_ASSOC));
    ?>
    
    <form method="GET">
        <input type="text" name="name" placeholder="Nomini kiriting"><br>
        <input type="text" name="year" placeholder="Yilini kiriting"><br>
        <button type="submit">Yuborish</button>
    </form>
</body>
</html>
