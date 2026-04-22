<?php
class Matematika {
    public static function kali($a, $b) {
        return $a * $b;
    }

    public static function bagi($a, $b) {
        return $a / $b;
    }
}

echo Matematika::kali(4, 5);
echo "<br>";
echo Matematika::bagi(10, 2);
?>