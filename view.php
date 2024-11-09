<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Of Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://avatars.mds.yandex.net/i?id=b59a73e2dac65f0ee5dff474d31ec9d4e94d35cb-5236263-images-thumbs&n=13');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            backdrop-filter: blur(5px);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            padding-top: 30px;
        }
        form {
            max-width: 500px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-weight: bold;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 20px;
            color: #e63946;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }
        .form-label {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2a9d8f;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
        }
        .btn-custom, .btn-export {
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            transition: background 0.3s, transform 0.2s;
            display: block;
            margin: 20px auto 0;
        }
        .btn-custom {
            background: linear-gradient(135deg, #00b4d8, #0077b6);
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            transform: translateY(-3px);
        }
        .btn-export {
            background: #2a9d8f;
        }
        .btn-export:hover {
            background: #21867a;
            transform: translateY(-3px);
        }
        .table-container {
            max-width: 800px;
            margin: 30px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        .table {
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead {
            background-color: #1d3557;
            color: #fff;
        }
        .table th, .table td {
            padding: 10px;
            text-align: center;
        }
        .text-primary {
            color: #1d3557 !important;
            font-weight: bold;
        }
        .text-success {
            color: #2a9d8f !important;
            font-weight: bold;
        }
        .text-warning {
            color: #ffb703 !important;
            font-weight: bold;
        }
        .text-danger {
            color: #e63946 !important;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Work Of Tracker</h1>
        <form method="post" action="work_daily.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="arrived_at" class="form-label">Kelgan vaqt</label>
                <input type="datetime-local" class="form-control" id="arrived_at" name="arrived_at" required>
            </div>
            <div class="mb-3">
                <label for="leaved_at" class="form-label">Ketgan vaqt</label>
                <input type="datetime-local" class="form-control" id="leaved_at" name="leaved_at" required>
            </div>
            <button type="submit" class="btn btn-custom">Submit</button>
        
            <button type="submit" class="btn btn-export" form="export">Export</button>
            
        </form>
        <form action="download.php" method="post" id="export" style="display:none;">
                <input type="hidden" name="export" value="true">
                
        </form>
    </div>
    <div class="table-container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-success">Ism</th>
                    <th scope="col" class="text-success">Kelgan vaqt</th>
                    <th scope="col" class="text-warning">Ketgan vaqt</th>
                    <th scope="col" class="text-danger">Qarzdorlik</th>
                    <th scope="col">Tuzatish</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    global $record;
                    $i=isset($_GET["page"]) ? (int)$_GET["page"] :0;
                        foreach ($records as $record) {
                            $i++;
                            echo "<tr>
                                    <th scope='row'>{$record['id']}</th>
                                    <td class='text-primary'>{$record['name']}</td>
                                    <td class='text-success'>{$record['arrived_at']}</td>
                                    <td class='text-warning'>{$record['leaved_at']}</td>
                                    <td class='text-danger'>" . gmdate('H:i', $record['required_of']) . "</td>
                                    <td><a href='work_daily.php?done={$record['id']}'>Done</a></td>
                                  </tr>";
                        }
                   
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php
        global $workDay, $currentPage;
        $disabled=$currentPage==1 ? "disabled" :"";

        ?>
        <li class="page-item <?=$disabled?>"><a class="page-link" href="#"><<</a></li>
        <?php
        $pageCount=$workDay->calculatePageCount();
        for ($page=1; $page<=$pageCount; $page++){
            $active=$page==$currentPage ? "active" : "";
            echo "<li class='page-item $active''><a class='page-link'' href='work_daily.php?page=" . $page . "''>" . $page . "</a></li>";

        }
        ?>
        <li class="page-item"><a class="page-link" href="#">>></a></li>
    </ul>
</nav>

    </div>
</body>
</html>
