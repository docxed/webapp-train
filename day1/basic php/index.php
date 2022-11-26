<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $color = "red";
    echo $color;
    echo "<br>Color is $color";
    ?>

    <br>
    <?php
    $num1 = 5;
    $num2 = 9;
    $result = $num1 + $num2;
    echo "Result = " . $result;
    ?>
    <br>
    <?php
    $n = 15;
    if ($n < 10) {
        echo "Have a good morning.";
    } else if ($n < 20) {
        echo "Have a good day";
    } else {
        echo "Have a good night";
    }
    ?>
    <br>
    <?php
    for ($x = 0; $x <= 10; $x++) {
        echo "The number is: $x <br>";
    }
    ?>
    <br>
    <?php
    $y = 1;
    while ($y <= 5) {
        echo "The number is $y <br>";
        $y++;
    }
    ?>
    <br>
    <?php
    function writeHello()
    { // ประกาศฟังก์ชัน
        echo "Hello <br>";
    }
    function writeName($name)
    { // ประกาศฟังก์ชัน
        echo "My name is $name <br>";
    }
    function plusNumber($num1, $num2)
    { // ประกาศฟังก์ชัน
        $result = $num1 + $num2;
        echo "$num1 + $num2 = $result. <br>";
    }

    writeHello();

    writeName("เจ");

    plusNumber(5, 6);

    ?>
</body>

</html>