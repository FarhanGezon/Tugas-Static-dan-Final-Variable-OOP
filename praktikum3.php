<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum - Sistem Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #eef2f3;
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 20px 30px;
        }
        .header h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .info-produk {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-left: 5px solid #3498db;
        }
        .total-produk {
            background: #e9ecef;
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 25px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .transaksi {
            background: #f1f9ff;
            border-radius: 12px;
            padding: 20px;
            margin-top: 25px;
            border: 1px solid #cfe2ff;
        }
        .transaksi h3 {
            color: #0a58ca;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .transaksi-item {
            background: white;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            font-family: monospace;
            font-size: 1rem;
        }
        hr {
            margin: 20px 0;
            border: none;
            border-top: 2px dashed #dee2e6;
        }
        footer {
            text-align: center;
            padding: 15px;
            font-size: 0.8rem;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🛍️ Sistem Transaksi Toko</h1>
    </div>
    <div class="content">
        <?php
        class Produk {
            public static $jumlahProduk = 0;
            
            public $namaProduk;
            public $harga;

            public function __construct($nama, $harga) {
                $this->namaProduk = $nama;
                $this->harga = $harga;
            }

            public function tambahProduk() {
                self::$jumlahProduk++;
            }
        }

        class Transaksi {
            // Final method agar logika transaksi tidak bisa diubah
            final public function prosesTransaksi($produk, $jumlahBeli) {
                $totalHarga = $produk->harga * $jumlahBeli;
                echo "Transaksi diproses: Membeli {$jumlahBeli}x {$produk->namaProduk} | Total Bayar: Rp " . number_format($totalHarga, 0, ',', '.') . "<br>";
            }
        }

        $p1 = new Produk("Laptop Gaming", 15000000);
        $p1->tambahProduk();

        $p2 = new Produk("Smartphone Flagship", 8500000);
        $p2->tambahProduk();

        $p3 = new Produk("Headset Bluetooth", 350000);
        $p3->tambahProduk();

        echo "<div class='total-produk'>📦 Total Produk: " . Produk::$jumlahProduk . "</div><hr>";

        echo "<div class='info-produk'><strong>📋 Daftar Produk:</strong></div>";
        echo "<table>";
        echo "<tr><th>No</th><th>Nama Produk</th><th>Harga</th></tr>";
        $daftar = [$p1, $p2, $p3];
        $no = 1;
        foreach ($daftar as $p) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>" . htmlspecialchars($p->namaProduk) . "</td>";
            echo "<td>Rp " . number_format($p->harga, 0, ',', '.') . "</td>";
            echo "</tr>";
            $no++;
        }
        echo "</table><hr>";

        echo "<div class='transaksi'><h3>🧾 Simulasi Transaksi</h3>";
        $kasir = new Transaksi();
        $kasir->prosesTransaksi($p1, 1);
        $kasir->prosesTransaksi($p2, 2);
        $kasir->prosesTransaksi($p3, 4);
        echo "</div>";
        ?>
    </div>
</div>
</body>
</html>