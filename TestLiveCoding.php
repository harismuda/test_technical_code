<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>

<?php
$validasi = "";
$output = "";
$numGanjil = "";
$numPrima = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no = $_POST["number"];
    if (ctype_digit($no)) {
        if (isset($_POST["generateSegitiga"])) {
            $segitiga = generateSegitiga($no);
            $output = nl2br($segitiga);
        } elseif (isset($_POST["generateGanjil"])) {
            $ganjil = bilanganGanjil($no);
            $numGanjil = implode(', ', $ganjil);
        } elseif (isset($_POST["generatePrima"])) {
            $no = intval($no);
            $prima = bilanganPrima($no);
            $numPrima = implode(', ', $prima);
        }
    } else {
        http_response_code(400);
        $validasi = "Tidak valid";
    }
}

function generateSegitiga($number)
{
    $segitiga = '';
    $numStr = (string)$number;
    $lenght = strlen($numStr);
    for ($i = 0; $i < $lenght; $i++) {
        $segitiga .= str_pad(substr($numStr, 0, $i + 1), $lenght, "0", STR_PAD_LEFT) . "<br/>";
    }
    return $segitiga;
}

function bilanganGanjil($no)
{
    $ganjil = [];
    for ($i = 1; $i <= $no; $i += 2) {
        $ganjil[] = $i;
    }
    return $ganjil;
}

function bilanganPrima($no)
{
    $prima = [];
    for ($x = 2; $x <= $no; $x++) {
        $isPrima = true;
        for ($i = 2; $i <= sqrt($x); $i++) {
            if ($x % $i == 0) {
                $isPrima = false;
                break;
            }
        }
        if ($isPrima) {
            $prima[] = $x;
        }
    }
    return $prima;
}

?>

<body>
    <form method="POST">
        <div style="margin-bottom: 20px;">
            <div><?php echo $validasi; ?></div>
            <input type="form-control" placeholder="Input Angka" name="number" id="input">
        </div>
        <button type="submit" name="generateSegitiga">Generate Segitiga</button>
        <button type="submit" name="generateGanjil">Generate Bilangan Ganjil</button>
        <button type="submit" name="generatePrima">Generate Bilangan Prima</button>
    </form>
    <h3>Result : <br> <?php echo $output ?> <?php echo $numGanjil ?> <?php echo $numPrima ?></h3>
</body>

<script>

</script>

</html>