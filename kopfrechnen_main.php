<DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Kopfrechnen</title>
</head>
<body>
<?php

// Formular erzeugen
class Formular
{
    function __construct(private $name, private $anzahl, private $level, private $richtig = 0, private $aufgaben = array()){}

    function anzeigen()
    {
        echo "<form action='kopfrechnen_end.php' method='post'>";
        echo "<p>Hallo $this->name! Bitte fülle die richtigen Ergebnisse aus.</p>";

        for($i=1; $i<=$this->anzahl; $i++)
        {
            $this->aufgaben[$i] = new Aufgabe($i, $this->anzahl, $this->level);
        }

        echo "<p><input type='submit' value='Fertig'></p>";
        echo "</form>";
    }

    function save()
    {
        $z = serialize($this);
        file_put_contents("kopfrechnen.dat", $z);
    }

    function auswerten($eingabe)
    {
        echo "<p>Deine Antworten wurden kontrolliert, $this->name.</p>";
        for($i=1; $i <= $this->anzahl; $i++)
        {
            $this->richtig += $this->aufgaben[$i]->pruefen($eingabe[$i]);
            $this->aufgaben[$i]->schluss($eingabe[$i]);
        }
        echo "<p>Du hast <b>$this->richtig von $this->anzahl Aufgaben</b> richtig gelöst.</p>";
    }
}

class Aufgabe
{
    function __construct(
        private $nr, 
        private $anzahl, 
        private $level, 
        private $a = 0, 
        private $b = 0, 
        private $op = "", 
        private $ergebnis = 0, 
        private $color ="", 
        private $schlusstext = "")
    {
        $this->a = random_int(1,$this->level);
        $this->b = random_int(1,$this->level);
        $o = random_int(1,4);

        switch($o)
        {
            case 1:
                $this->op = "+";
                $this->ergebnis = $this->a + $this->b;
                break;
            
            case 2:
                $this->op = "-";
                if($this->a < $this->b)
                {
                    $zw = $this->a;
                    $this->a = $this->b;
                    $this->b = $zw;
                }
                $this->ergebnis = $this->a - $this->b;
                break;

            case 3:
                $this->op = "*";
                $this->ergebnis = $this->a * $this->b;
                break;

            case 4:
                $this->op = "/";
                $this->ergebnis = random_int(1,$this->level);
                $this->a = $this->b * $this->ergebnis;
                break;
        }
        echo "<p>Nr. $this->nr/$this->anzahl: <b>$this->a $this->op $this->b = </b><input name='eingabe[$this->nr]'></p>";
    }

    function pruefen($eingabe)
    {
        if($eingabe == $this->ergebnis)
        {
            $this->color = "green";
            $this->schlusstext = "Richtig!";
            return 1;
        }
        else
        {
            $this->color ="red";
            $this->schlusstext = "Falsch! -> Lösung: $this->ergebnis";
            return 0;
        }
    }

    function schluss($eingabe)
    {
        echo "<p style='color:$this->color'>Nr. $this->nr/$this->anzahl: <b>$this->a $this->op $this->b = $eingabe</b> / $this->schlusstext</p>";
    }
}
?>
</body>
</html>
