<?php
class Matematika {
    public static function kali($a, $b) {
        return $a * $b;
    }

    public static function bagi($a, $b) {
        return $a / $b;
    }

    public static function tambah($a, $b) {
        return $a + $b;
    }

    public static function kurang($a, $b) {
        return $a - $b;
    }

    public static function luasPersegi($sisi) {
        return $sisi * $sisi;
    }
}

$hasil = "";
$error = "";
$n1 = $_POST['n1'] ?? '';
$n2 = $_POST['n2'] ?? '';
$sisi = $_POST['sisi'] ?? '';
$op = $_POST['op'] ?? 'tambah';

if (isset($_POST['hitung'])) {
    if ($op == 'luas') {
        if ($sisi === '' || !is_numeric($sisi)) {
            $error = "Masukkan sisi persegi yang valid (angka).";
        } else {
            $sisi = (float)$sisi;
            $hasilLuas = Matematika::luasPersegi($sisi);
            $hasil = "Luas Persegi (sisi = " . htmlspecialchars($sisi) . ") = " . htmlspecialchars($hasilLuas);
        }
    } else {
        if ($n1 === '' || !is_numeric($n1) || $n2 === '' || !is_numeric($n2)) {
            $error = "Masukkan Angka 1 dan Angka 2 yang valid.";
        } else {
            $n1 = (float)$n1;
            $n2 = (float)$n2;
            try {
                switch ($op) {
                    case 'tambah':
                        $res = Matematika::tambah($n1, $n2);
                        $hasil = "Hasil Tambah: $n1 + $n2 = " . htmlspecialchars($res);
                        break;
                    case 'kurang':
                        $res = Matematika::kurang($n1, $n2);
                        $hasil = "Hasil Kurang: $n1 - $n2 = " . htmlspecialchars($res);
                        break;
                    case 'kali':
                        $res = Matematika::kali($n1, $n2);
                        $hasil = "Hasil Kali: $n1 × $n2 = " . htmlspecialchars($res);
                        break;
                    case 'bagi':
                        if ($n2 == 0) {
                            throw new Exception("Pembagian dengan nol tidak diperbolehkan.");
                        }
                        $res = Matematika::bagi($n1, $n2);
                        $hasil = "Hasil Bagi: $n1 ÷ $n2 = " . htmlspecialchars($res);
                        break;
                    default:
                        $error = "Operasi tidak dikenal.";
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum 2 - Kalkulator Matematika</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #f4f4f4;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h3 {
            margin-top: 0;
            color: #333;
        }
        label {
            display: inline-block;
            width: 100px;
            margin-bottom: 10px;
        }
        input, select {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }
        button {
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .hasil {
            margin-top: 20px;
            padding: 10px;
            background: #e9ecef;
            border-radius: 5px;
            font-weight: bold;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        hr {
            margin: 15px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h3>Kalkulator Matematika</h3>
    <form method="POST">
        <label>Angka 1:</label>
        <input type="number" step="any" name="n1" value="<?= htmlspecialchars($n1) ?>">
        <br>
        <label>Angka 2:</label>
        <input type="number" step="any" name="n2" value="<?= htmlspecialchars($n2) ?>">
        <br>
        <label>Sisi Persegi:</label>
        <input type="number" step="any" name="sisi" value="<?= htmlspecialchars($sisi) ?>">
        <br><br>
        <label>Operasi:</label>
        <select name="op">
            <option value="tambah" <?= $op == 'tambah' ? 'selected' : '' ?>>Tambah (+)</option>
            <option value="kurang" <?= $op == 'kurang' ? 'selected' : '' ?>>Kurang (-)</option>
            <option value="kali"    <?= $op == 'kali'    ? 'selected' : '' ?>>Kali (×)</option>
            <option value="bagi"    <?= $op == 'bagi'    ? 'selected' : '' ?>>Bagi (÷)</option>
            <option value="luas"    <?= $op == 'luas'    ? 'selected' : '' ?>>Hitung Luas Persegi</option>
        </select>
        <br><br>
        <button type="submit" name="hitung">Proses</button>
    </form>

    <?php if ($error): ?>
        <div class="error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php elseif ($hasil): ?>
        <div class="hasil">✅ <?= $hasil ?></div>
    <?php endif; ?>
</div>
</body>
</html>