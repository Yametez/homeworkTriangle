<?php

function classifyTriangle($a, $b, $c) {
    // ตรวจสอบว่าข้อมูลนำเข้าอยู่ในช่วงที่ถูกต้องหรือไม่
    if ($a < 0.00 || $a > 100.00 || $b < 0.00 || $b > 100.00 || $c < 0.00 || $c > 100.00) {
        return "Invalid input. Please enter values between 0.00 and 100.00.";
    }

    // ตรวจสอบว่าเป็นสามเหลี่ยมหรือไม่
    if (($a + $b > $c) && ($b + $c > $a) && ($c + $a > $b)) {
        // ตรวจสอบว่าเป็นสามเหลี่ยมมุมฉากหรือไม่
        $sides = [$a, $b, $c];
        sort($sides);

        // ตรวจสอบว่าเป็นสามเหลี่ยมมุมฉากหรือไม่
        if ($sides[0] ** 2 + $sides[1] ** 2 === $sides[2] ** 2) {
            return "Right triangle";
        }

        // ตรวจสอบว่าเป็นสามเหลี่ยมด้านเท่าหรือไม่
        if ($a === $b && $b === $c) {
            return "Equilateral triangle";
        }

        // ตรวจสอบว่าเป็นสามเหลี่ยมด้านเท่ากันสองด้านหรือไม่
        if ($a === $b || $b === $c || $c === $a) {
            return "Isosceles triangle";
        }

        // ถ้าไม่เข้าเงื่อนไขใดเลย แสดงว่าเป็นสามเหลี่ยม Scalene
        return "Scalene triangle";
    } else {
        return "Not a triangle";
    }
}

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ตรวจสอบว่ามีข้อมูลที่ต้องการตรวจสอบหรือไม่
    if (isset($_POST["sideA"]) && isset($_POST["sideB"]) && isset($_POST["sideC"])) {
        // ดึงค่าข้อมูลจากฟอร์ม
        $sideA = floatval($_POST["sideA"]);
        $sideB = floatval($_POST["sideB"]);
        $sideC = floatval($_POST["sideC"]);

        // เรียกใช้ฟังก์ชันและแสดงผลลัพธ์
        $result = classifyTriangle($sideA, $sideB, $sideC);
        echo "Triangle with sides $sideA, $sideB, $sideC is a $result.";
    } else {
        echo "Please enter all three sides of the triangle.";
    }
}

?>

<!-- แบบฟอร์มสำหรับกรอกข้อมูล -->
<form method="post" action="">
    Side A: <input type="text" name="sideA" value=""><br>
    Side B: <input type="text" name="sideB" value=""><br>
    Side C: <input type="text" name="sideC" value=""><br>
    <input type="submit" value="Classify Triangle">
</form>
