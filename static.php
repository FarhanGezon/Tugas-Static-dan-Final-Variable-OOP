<?php

class counter {

    public static $jumlah = 0;

    public function tambah () {
        self::$jumlah++;
        }
}

$c1 = new counter();
$c2 = new counter();

$c1->tambah();
$c2->tambah();

echo counter::$jumlah;

?>
