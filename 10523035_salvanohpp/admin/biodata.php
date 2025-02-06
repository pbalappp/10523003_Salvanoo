<?php

$biodata = [
    "Nama" => "Salvano Hasbie Putra",
    "Alamat" => "Jln Maribaya No.186",
    "Tanggal Lahir" => "Garut, 29 September 2005", 
    "Hobi" => "Playing Guitar",
];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata - Salvano Hasbie Putra</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        .container img {
            max-width: 150px;
            height: auto;
            border-radius: 50%;
            border: 3px solid white;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .container img:hover {
            transform: scale(1.1);
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            font-size: 18px;
        }
        li strong {
            color: #fcd34d;
        }
        .back-button a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 12px 24px;
            background: #ff7eb3;
            color: white;
            border-radius: 25px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .back-button a:hover {
            background: #ff4f81;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="Screenshot 2025-02-06 1548844.png" alt="Foto Salvano">
        <ul>
            <?php foreach ($biodata as $key => $value): ?>
                <li><strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="back-button">
            <a href="./?adm=mahasiswa">Kembali</a>
        </div>
    </div>
</body>
</html>
