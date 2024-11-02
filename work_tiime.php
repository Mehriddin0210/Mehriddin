<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        h1 {
            font-weight: bold;
            font-size: 2.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        
        .form-label {
            font-weight: bold;
            font-size: 1.1rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        
        .btn-custom:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-danger text-center">Work Of Tracker</h1>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label text-primary">Name</label>
                <input type="text" class="form-control border border-primary" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="arrived_at" class="form-label text-success">Kelgan vaqt</label>
                <input type="datetime-local" class="form-control border border-success" id="arrived_at" name="arrived_at">
            </div>
            <div class="mb-3">
                <label for="leaved_at" class="form-label text-warning">Ketgan vaqt</label>
                <input type="datetime-local" class="form-control border border-warning" id="leaved_at" name="leaved_at">
            </div>
            <button type="submit" class="btn btn-custom">Submit</button>
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

    <div class="container mt-4">
        <table class="table table-striped table-hover border border-secondary">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-primary">Ism</th>
                    <th scope="col" class="text-success">Kelgan vaqt</th>
                    <th scope="col" class="text-warning">Ketgan vaqt</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                    foreach ($yozuvlar as $record) {
                        echo "<tr>
                                <th scope='row'>{$record['id']}</th>
                                <td class='text-primary'>{$record['name']}</td>
                                <td class='text-success'>{$record['arrived_at']}</td>
                                <td class='text-warning'>{$record['leaved_at']}</td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
