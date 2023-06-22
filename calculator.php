<!doctype html>
<html lang="en">
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['values'];
    if (isset($input)) {
        $input = str_replace(' ', '', $input);
        if (!preg_match('/^[\d\+\-\*\/.]+$/', $input)) {
            $total = "Invalid input";
        } else {
            $total = eval("return $input;");
             $text = "<tr><td>{$input} = {$total}</td></tr>";
            $_SESSION['his'] = $total;
            if(isset($_SESSION['his'])){
                ## Sesion Store
                if(isset($_SESSION['value'])){
                    $b = $_SESSION['value'];
                    // var_dump($b);
                    $a =  explode(" ", $b);
                    array_push($a, $text);
                    $b = implode(" ", $a);
                    $_SESSION['value'] = $b;
                 "{$_SESSION['value']}";
                }
                else{
                    $a = array();
                array_push($a,$text);
                // print_r($a);
                $b = implode(" ", $a);
                $_SESSION['value'] = $b;
                 "Session2 {$_SESSION['value']}";
                }
            }
        }
    } else {
        $total = "Error";
    }
}
if(isset($_SESSION['value'])){
    $texts = "<table class='text-center table table-hover'>
    <thead>
      <tr>
        <th scope='col'>History</th>
      </tr>
    </thead>
    <tbody>
      {$_SESSION['value']}
    </tbody>
  </table>";
}
if (isset($_GET['del'])) {
    session_destroy();
    echo "History Deleted";
    header("location:calculator.php");
}
?>

<head>
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body class="d-flex p-5">
    <div class="container">
        <form method="post" class="calculator card">

            <input type="text" name="values" class="calculator-screen z-depth-1" value="" />
            <input type="text" name="values" class="calculator-screenn z-depth-1" value="<?php
                                                                                            if (isset($total)) {
                                                                                                echo $total;
                                                                                            } else {
                                                                                                echo "0";
                                                                                            }
                                                                                            ?>" disabled />

            <div class="calculator-keys">
                <?php
                $arithmeticSigns = array('+', '-', '*', '/');
                foreach ($arithmeticSigns as $sign) {
                    echo '<button type="button" class="btnn operator btn btn-info" value="' . $sign . '">' . $sign . '</button>';
                }
                ?>

                <?php
                for ($i = 9; $i >= 0; $i--) {
                    echo '<button type="button" class="btnn btn btn-light waves-effect" value="' . $i . '">' . $i . '</button>';
                }
                ?>

                <button type="button" class="btnn function btn btn-secondary" value=".">.</button>
                <a class="all-clear function btn btn-danger btn-sm" href="?del=all"><div class="w-100" value="">AC</div></a>
                <button type="submit" class="equal-sign operator btn btn-default" value="=">=</button>
            </div>
        </form>
    </div>

    <div class="px-5 w-100">
            <?php
                if(isset($texts)){
                    echo $texts;
                }
                else{
                    echo "Welcome !!";
                }
            ?>
        </div>
    <script>
        $(document).ready(function() {
            $(".btnn").click(function() {
                var btnValue = $(this).val();
                var currentValue = $(".calculator-screen").val();
                $(".calculator-screen").val(currentValue + btnValue);
            });
        });
    </script>
</body>

</html>