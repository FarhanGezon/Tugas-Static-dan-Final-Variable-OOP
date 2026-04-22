<?php

class Kendaraan {
    final public function mesin() {
        echo "Mesin standar";
    }
}

class Mobil extends Kendaraan {
    public function mesin() {
        echo "Mesin mobil";
    }
}

?>