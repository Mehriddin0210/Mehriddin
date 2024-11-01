<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-danger text-center">Work Of Tracker</h1>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="arrived_at" class="form-label">Kelgan vaqt</label>
                <input type="datetime-local" class="form-control" id="arrived_at" name="arrived_at">
            </div>
            <div class="mb-3">
                <label for="leaved_at" class="form-label">Ketgan vaqt</label>
                <input type="datetime-local" class="form-control" id="leaved_at" name="leaved_at">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <?php
    $dns = "mysql:host=127.0.0.1;dbname=work_of_tracker";
    $username = "root";
    $pasword = "root";

    $pdo = new PDO($dns, $username, $pasword);

    define('WORK_TIME', 8);

    if (isset($_POST['arrived_at']) and isset($_POST['leaved_at']) and isset($_POST['name'])) {
        $name = $_POST['name'];
        $arrived_at = $_POST['arrived_at'];
        $leaved_at = $_POST['leaved_at'];
        
        $query = "INSERT INTO work_time (name, arrived_at, leaved_at) VALUES (:name, :arrived_at, :leaved_at)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':arrived_at', $arrived_at);
        $stmt->bindParam(':leaved_at', $leaved_at);
        $stmt->execute();
    };


    $yozuvlar = $pdo->query("SELECT * FROM work_time")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if (!empty($yozuvlar)): ?>
        <div class="container"></div>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ismi</th>
                    <th>Kelgan Vaqti</th>
                    <th>Ketgan Vaqti</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($yozuvlar as $yozuv): ?>
                    <tr>
                        <td><?= isset($yozuv['id']) ? htmlspecialchars($yozuv['id']) : '' ?></td>
                        <td><?= isset($yozuv['name']) ? htmlspecialchars($yozuv['name']) : '' ?></td>
                        <td><?= isset($yozuv['arrived_at']) ? htmlspecialchars($yozuv['arrived_at']) : '' ?></td>
                        <td><?= isset($yozuv['leaved_at']) ? htmlspecialchars($yozuv['leaved_at']) : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php else: ?>
        <p class="mt-4">Hech qanday yozuv topilmadi.</p>
    <?php endif; ?>  
</body>
</html>
