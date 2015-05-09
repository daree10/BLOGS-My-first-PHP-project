<?php
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/stilObjave.css">
    </head>
    <body>
        <div id="naslov" class='time'>
            <h1>Prijava</h1>
        </div>
        <div class id = "navigacija">

            <div class = "navig">
                <a href="objave.php" class="link">Timeline</a>
            </div>

            <div class = "navig">
                <a href="unos_objave.php" class="link">Unos objave</a>
            </div>

           <?php
    if(!isset($_SESSION["id_aut"]))
    {
echo "<div class = navig>";
echo "<a href='reg.php' class='link'>Registracija</a>";
echo "</div>";

echo "<div class = navig>";
echo "<a href='login.php' class=link>Prijava</a>";
echo "</div>";
    }
        ?>

        </div>
        <div id = "autori">

            <form action="login.php" method="post" id="usrform">
                <div class='autorADD labelaADD'>
                    <?php
                    $connection = mysql_connect("localhost", "root", "") or die("");
                    $baza = "projektbaze2_blog";
                    mysql_select_db($baza, $connection);

                    $loginProsao = false;
                    if (isset($_POST["prijavabotun"])) {

                        $USERNAME = $_POST["username"];
                        $PASSWORD = $_POST["password"];
                        $id_autora;
                        $query = mysql_query("SELECT id, korime, lozinka FROM autori");
                        while ($red = mysql_fetch_assoc($query)) {
                            if ($red["korime"] == $USERNAME && $red["lozinka"] == $PASSWORD) {
                                $loginProsao = true;
                                $id_autora = $red["id"];
                            }
                        }
                        if (!$loginProsao) {
                            echo "<div style='color:blue'>Nepostojece korisnicko ime ili pogresna lozinka! </div>";
                        }


                        if ($loginProsao == true) {
                            $_SESSION["id_aut"] = $id_autora;
                            header("Location: objave.php");
                        }
                    }
                    ?>


                    <br><br>
                    Login
                    <hr>
                    <br>
                    Korisnicko ime: <input type="text" name="username"><br><br>
                    Lozinka: <input type="password" name="password"><br><br>
                    <hr>
                    <input class = "submitButton" name="prijavabotun" type="submit" value = "Prijava!">
                    </form>

                </div>

        </div>


    </body>
</html>