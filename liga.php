<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>piłka nożna</title>
    <link rel="stylesheet" href="styl2.css">
</head>

<body>
    <?php
    $db = new mysqli('localhost', 'root', '', 'egzamin');
    ?>
    <header>
        <h3>Reprezentacja Polski w Piłce Nożnej</h3>
        <img src="obraz1.jpg" alt="reprezentacja">
    </header>
    <div id="podzial">
        <div id="lewy">
            <form action="liga.php" method="post">
                <select name="pozycja">
                    <option value="1">Bramkarze</option>
                    <option value="2">Obrońcy</option>
                    <option value="3">Pomocnicy</option>
                    <option value="4">Napastnicy</option>
                </select>
                <button type="submit">Zobacz</button>
            </form>
            <img src="zad2.png" alt="piłka">
            <p>Autor: 00000000000</p>
        </div>
        <div id="prawy">
            <ol>
                <?php
                $query = $db->prepare("SELECT imie,nazwisko FROM zawodnik WHERE pozycja_id = ?");
                $query->bind_param('i', $_POST['pozycja']);
                $query->execute();
                $result = $query->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo '<li>';
                    echo $row['imie'];
                    echo ' ';
                    echo $row['nazwisko'];
                    echo '</li>';
                }
                ?>
            </ol>
        </div>
    </div>
    <main>
        <h3>Liga mistrzów</h3>
    </main>
    <div id="liga">
        <?php
            $query = $db->prepare("SELECT zespol, punkty, grupa FROM liga ORDER BY punkty DESC");
            $query->execute();
            $result = $query->get_result();
            while($row = $result->fetch_assoc()) {
                echo '<div id="druzyna">';
                echo '<h2>'.$row['zespol'].'</h2>';
                echo '<h1>'.$row['punkty'].'</h1>';
                echo '<p>grupa:'.$row['grupa'].'</p>';
                echo '</div>';
            }
        ?>
        
    </div>
    <?php
    $db->close();
    ?>
</body>

</html>