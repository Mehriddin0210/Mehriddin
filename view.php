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
        }

      
        form {
            max-width: 500px;
            margin: auto; 
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px; 
        }

        h1 {
            font-weight: bold;
            font-size: 3.0rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .form-label {
            font-weight: bold;
            font-size: 1.4rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.);
            text-align: center;
            display: block;
        }

        .btn-custom {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            transition: background 0.3s ease, transform 0.2s ease;
            display: block;
            margin: 0 auto;
        }
        
        .btn-custom:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            transform: scale(1.05);
        }

        .table-container {
            max-width: 800px;
            margin: 20px auto; 
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 10px;
        }

        .table {
            width: 100%; 
        }

        .table td, .table th {
            padding: 6px;
            font-size: 0.9rem; 
        }

        /* Matn ranglarini belgilash */
        .text-primary {
            color: #0000cc !important;
            font-weight: bold;
        }
        
        .text-success {
            color: #008000 !important;
            font-weight: bold;
        }
        
        .text-warning {
            color: #ff8800 !important;
            font-weight: bold;
        }
        
        .text-danger {
            color: #cc0000 !important;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-danger">Work Of Tracker</h1>
        
        <form method="post" action="work_daily.php">
            <div class="mb-3">
                <label for="name" class="form-label text-primary">Name</label>
                <input type="text" class="form-control border border-primary" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="arrived_at" class="form-label text-success">Kelgan vaqt</label>
                <input type="datetime-local" class="form-control border border-success" id="arrived_at" name="arrived_at" required>
            </div>
            <div class="mb-3">
                <label for="leaved_at" class="form-label text-warning">Ketgan vaqt</label>
                <input type="datetime-local" class="form-control border border-warning" id="leaved_at" name="leaved_at" required>
            </div>
            <button type="submit" class="btn btn-custom">Submit</button>
        </form>
    </div>

    <div class="table-container">
        <table class="table table-striped table-hover border border-secondary">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-primary">Ism</th>
                    <th scope="col" class="text-success">Kelgan vaqt</th>
                    <th scope="col" class="text-warning">Ketgan vaqt</th>
                    <th scope="col" class="text-danger">Qarzdorlik</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                    foreach ($records as $record) {
                        echo "<tr>
                                <th scope='row'>{$record['id']}</th>
                                <td class='text-primary'>{$record['name']}</td>
                                <td class='text-success'>{$record['arrived_at']}</td>
                                <td class='text-warning'>{$record['leaved_at']}</td>
                                <td class='text-danger'>" . gmdate('H:i',$record['required_of']) . "</td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
