<?php
$xml=simplexml_load_file("elisaveta2.xml");

if(isset($_POST['nimi'])){
    //vormi tekstikastist saadud nimi
    $nimi=$_POST['nimi'];
    $lapsenimi=$_POST['Lnimi'];

    $xml_sugupuu=$xml->addChild('inimene');
    $xml_sugupuu->addChild('nimi', $nimi);
    $xml_laps=$xml_sugupuu->addChild('lapsed')->addChild('inimene');
    $xml_laps->addChild('nimi',$lapsenimi);

    $xmlDoc=new DOMDocument("1.0", "UTF-8");
    $xmlDoc->loadXML($xml->asXML(), LIBXML_NOBLANKS);
    $xmlDoc->preserveWhiteSpace = false;
    $xmlDoc->formatOutput=true;
    $xmlDoc->save('elisaveta2.xml');
    header("refresh: 0;");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sugupuu andmete lisamine XML faili</title>
</head>
<body>
<h1>Sugupuu andmete lisamine XML olemasoleva faili</h1>
<table border="1">
    <tr>
        <th>Nimi</th>
    </tr>
    <?php
    foreach ($xml->xpath("//inimene") as $inimene){
        echo "<tr>";
        echo "<td>".($inimene->nimi) ."</td>";
        echo "</tr>";
    }
    ?>
</table>
<br>
<form method="post" action="">
    <label for="nimi">Vanema nimi:</label>
    <input type="text" name="nimi" id="nimi" placeholder="Vanema nimi">
    <input type="submit" value="OK">
    <input type="submit" value="Sisesta uue XML faili">
    <br><br>
    <label for="Lnimi">Lapse nimi:</label>
    <input type="text" name="Lnimi" id="Lnimi" placeholder="Lapse nimi">
    <input type="submit" value="OK">
    <input type="submit" value="Sisesta uue XML faili">
</form>
</body>
</html>