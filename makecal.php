<?php
use Sabre\VObject;

// error_reporting(E_ALL);
include 'vendor/autoload.php';

$param_in = $_GET['p'];
$params = explode('-', $param_in);

// Send Headers for correct caching
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', strtotime('2016-06-22 22:00:00')));
header('cache-control: public ');
header('ETag: ' . md5('Revision4'));

// headers for file downloaders
header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="euro2016-schedule-'.$param_in.'.ics"');

// gamenr, date, location, phase, formal1, formal2, potential1, potential2
$games = [
['1', '10.06.2016 21:00', 'Stade de France, Saint-Denis, France', 'Group matches', 'FRA', 'ROU', ['FRA'], ['ROU']],
['2', '11.06.2016 15:00', 'Stade Bollaert-Delelis, Lens, France', 'Group matches', 'ALB', 'SUI', ['ALB'], ['SUI']],
['3', '11.06.2016 18:00', 'Stade Matmut Atlantique, Bordeaux, France', 'Group matches', 'WAL', 'SVK', ['WAL'], ['SVK']],
['4', '11.06.2016 21:00', 'Stade Vélodrome, Marseille, France', 'Group matches', 'ENG', 'RUS', ['ENG'], ['RUS']],
['5', '12.06.2016 15:00', 'Parc des Princes, Paris, France', 'Group matches', 'TUR', 'CRO', ['TUR'], ['CRO']],
['6', '12.06.2016 18:00', 'Allianz Riviera, Nice, France', 'Group matches', 'POL', 'NIR', ['POL'], ['NIR']],
['7', '12.06.2016 21:00', 'Stade Pierre-Mauroy, Lille, France', 'Group matches', 'GER', 'UKR', ['GER'], ['UKR']],
['8', '13.06.2016 15:00', 'Stadium Municipal, Toulouse, France', 'Group matches', 'ESP', 'CZE', ['ESP'], ['CZE']],
['9', '13.06.2016 18:00', 'Stade de France, Saint-Denis, France', 'Group matches', 'IRL', 'SWE', ['IRL'], ['SWE']],
['10', '13.06.2016 21:00', 'Parc Olympique Lyonnais, Lyon, France', 'Group matches', 'BEL', 'ITA', ['BEL'], ['ITA']],
['11', '14.06.2016 18:00', 'Stade Matmut Atlantique, Bordeaux, France', 'Group matches', 'AUT', 'HUN', ['AUT'], ['HUN']],
['12', '14.06.2016 21:00', 'Stade Geoffroy-Guichard, Saint-Etienne, France', 'Group matches', 'POR', 'ISL', ['POR'], ['ISL']],
['13', '15.06.2016 15:00', 'Stade Pierre-Mauroy, Lille, France', 'Group matches', 'RUS', 'SVK', ['RUS'], ['SVK']],
['14', '15.06.2016 18:00', 'Parc des Princes, Paris, France', 'Group matches', 'ROU', 'SUI', ['ROU'], ['SUI']],
['15', '15.06.2016 21:00', 'Stade Vélodrome, Marseille, France', 'Group matches', 'FRA', 'ALB', ['FRA'], ['ALB']],
['16', '16.06.2016 15:00', 'Stade Bollaert-Delelis, Lens, France', 'Group matches', 'ENG', 'WAL', ['ENG'], ['WAL']],
['17', '16.06.2016 18:00', 'Parc Olympique Lyonnais, Lyon, France', 'Group matches', 'UKR', 'NIR', ['UKR'], ['NIR']],
['18', '16.06.2016 21:00', 'Stade de France, Saint-Denis, France', 'Group matches', 'GER', 'POL', ['GER'], ['POL']],
['19', '17.06.2016 15:00', 'Stadium Municipal, Toulouse, France', 'Group matches', 'ITA', 'SWE', ['ITA'], ['SWE']],
['20', '17.06.2016 18:00', 'Stade Geoffroy-Guichard, Saint-Etienne, France', 'Group matches', 'CZE', 'CRO', ['CZE'], ['CRO']],
['21', '17.06.2016 21:00', 'Allianz Riviera, Nice, France', 'Group matches', 'ESP', 'TUR', ['ESP'], ['TUR']],
['22', '18.06.2016 15:00', 'Stade Matmut Atlantique, Bordeaux, France', 'Group matches', 'BEL', 'IRL', ['BEL'], ['IRL']],
['23', '18.06.2016 18:00', 'Stade Vélodrome, Marseille, France', 'Group matches', 'ISL', 'HUN', ['ISL'], ['HUN']],
['24', '18.06.2016 21:00', 'Parc des Princes, Paris, France', 'Group matches', 'POR', 'AUT', ['POR'], ['AUT']],
['25', '19.06.2016 21:00', 'Parc Olympique Lyonnais, Lyon, France', 'Group matches', 'ROU', 'ALB', ['ROU'], ['ALB']],
['26', '19.06.2016 21:00', 'Stade Pierre-Mauroy, Lille, France', 'Group matches', 'SUI', 'FRA', ['SUI'], ['FRA']],
['27', '20.06.2016 21:00', 'Stadium Municipal, Toulouse, France', 'Group matches', 'RUS', 'WAL', ['RUS'], ['WAL']],
['28', '20.06.2016 21:00', 'Stade Geoffroy-Guichard, Saint-Etienne, France', 'Group matches', 'SVK', 'ENG', ['SVK'], ['ENG']],
['29', '21.06.2016 18:00', 'Stade Vélodrome, Marseille, France', 'Group matches', 'UKR', 'POL', ['UKR'], ['POL']],
['30', '21.06.2016 18:00', 'Parc des Princes, Paris, France', 'Group matches', 'NIR', 'GER', ['NIR'], ['GER']],
['31', '21.06.2016 21:00', 'Stade Bollaert-Delelis, Lens, France', 'Group matches', 'CZE', 'TUR', ['CZE'], ['TUR']],
['32', '21.06.2016 21:00', 'Stade Matmut Atlantique, Bordeaux, France', 'Group matches', 'CRO', 'ESP', ['CRO'], ['ESP']],
['33', '22.06.2016 18:00', 'Stade de France, Saint-Denis, France', 'Group matches', 'ISL', 'AUT', ['ISL'], ['AUT']],
['34', '22.06.2016 18:00', 'Parc Olympique Lyonnais, Lyon, France', 'Group matches', 'HUN', 'POR', ['HUN'], ['POR']],
['35', '22.06.2016 21:00', 'Stade Pierre-Mauroy, Lille, France', 'Group matches', 'ITA', 'IRL', ['ITA'], ['IRL']],
['36', '22.06.2016 21:00', 'Allianz Riviera, Nice, France', 'Group matches', 'SWE', 'BEL', ['SWE'], ['BEL']],
['37', '25.06.2016 15:00', 'Stade Geoffroy-Guichard, Saint-Etienne, France', 'Round of 16', 'RA', 'RC', ['FRA', 'ROU', 'ALB', 'SUI'], ['GER', 'UKR', 'POL', 'NIR']],
['38', '25.06.2016 18:00', 'Parc des Princes, Paris, France', 'Round of 16', 'WB', '3A/C/D', ['ENG', 'RUS', 'WAL', 'SVK'], ['FRA', 'ROU', 'ALB', 'SUI', 'GER', 'UKR', 'POL', 'NIR', 'ESP', 'CZE', 'TUR', 'CRO']],
['39', '25.06.2016 21:00', 'Stade Bollaert-Delelis, Lens, France', 'Round of 16', 'WD', '3B/E/F', ['ESP', 'CZE', 'TUR', 'CRO'], ['ENG', 'RUS', 'WAL', 'SVK', 'POR', 'ISL', 'AUT', 'HUN', 'BEL', 'IRL', 'SWE']],
['40', '26.06.2016 15:00', 'Parc Olympique Lyonnais, Lyon, France', 'Round of 16', 'WA', '3C/D/E', ['FRA', 'ROU', 'ALB', 'SUI'], ['BEL', 'IRL', 'SWE', 'ESP', 'CZE', 'TUR', 'CRO', 'GER', 'UKR', 'POL', 'NIR']],
['41', '26.06.2016 18:00', 'Stade Pierre-Mauroy, Lille, France', 'Round of 16', 'WC', '3A/B/F', ['GER', 'UKR', 'POL', 'NIR'], ['ENG', 'RUS', 'WAL', 'SVK', 'POR', 'ISL', 'AUT', 'HUN', 'FRA', 'ROU', 'ALB', 'SUI']],
['42', '26.06.2016 21:00', 'Stadium Municipal, Toulouse, France', 'Round of 16', 'WF', 'RE', ['POR', 'ISL', 'AUT', 'HUN'], ['BEL',  'IRL', 'SWE']],
['43', '27.06.2016 18:00', 'Stade de France, Saint-Denis, France', 'Round of 16', 'ITA', 'RD', ['ITA'], ['ESP', 'CZE', 'TUR', 'CRO']],
['44', '27.06.2016 21:00', 'Allianz Riviera, Nice, France', 'Round of 16', 'RB', 'RF', ['ENG', 'RUS', 'WAL', 'SVK'], ['POR', 'ISL', 'AUT', 'HUN']],
['45', '30.06.2016 21:00', 'Stade Vélodrome, Marseille, France', 'Quarter-Finals', 'W37', 'W39', 'Z', 'Z'],
['46', '01.07.2016 21:00', 'Stade Pierre-Mauroy, Lille, France', 'Quarter-Finals', 'W38', 'W42', 'Z', 'Z'],
['47', '02.07.2016 21:00', 'Stade Matmut Atlantique, Bordeaux, France', 'Quarter-Finals', 'W41', 'W43', 'Z', 'Z'],
['48', '03.07.2016 21:00', 'Stade de France, Saint-Denis, France', 'Quarter-Finals', 'W40', 'W44', 'Z', 'Z'],
['49', '06.07.2016 21:00', 'Parc Olympique Lyonnais, Lyon, France', 'Half-Finals', 'W45', 'W46', 'Z', 'Z'],
['50', '07.07.2016 21:00', 'Stade Vélodrome, Marseille, France', 'Half-Finals', 'W47', 'W48', 'Z', 'Z'],
['51', '10.07.2016 21:00', 'Stade de France, Saint-Denis, France', 'Final', 'W49', 'W50', 'Z', 'Z'],
];

$outgames = array();

// filter the games
foreach ($games as $game) {
    $copygame = false;
    foreach ($params as $param) {
        if ($param == 'ALL') { // wants all games
            $copygame = true;
        } elseif ((is_array($game[6]) && in_array($param, $game[6])) || (is_array($game[7]) && in_array($param, $game[7]))) { // TEAM plays
            $copygame = true;
        } elseif ($game[3] == 'Round of 16' && $param == 'ALL16') {
            $copygame = true;
        } elseif ($game[3] == 'Quarter-Finals' && $param == 'ALLQ') {
            $copygame = true;
        } elseif ($game[3] == 'Half-Finals' && $param == 'ALLH') {
            $copygame = true;
        } elseif ($game[3] == 'Quarter-Finals' || $game[3] == 'Half-Finals' || $game[3] == 'Final') { // for now everyone gets the quarter/half/Final
            $copygame = true;
        }
    }

    if ($copygame) {
        array_push($outgames, $game);
    }
}

// format the calendar
$vcalendar = new VObject\Component\VCalendar();
$vcalendar->add('X-WR-CALNAME', 'EURO 2016 Schedule '.$param_in);
$vcalendar->add('X-WR-CALDESC', 'EURO 2016 Schedule '. $param_in."\nbrought to you by http://kralo.github.io/euro2016-calendar-ics-exporter/");

foreach ($outgames as $game) {
    $vev = $vcalendar->add('VEVENT', ['UID'=>'euro2016_game'.$game[0],]);

    // Summary and description; also resources

    if ($game[6] != 'Z' && sizeof($game[6]) == 1 && sizeof($game[7]) == 1) {
        $involved = $game[6][0].' - '.$game[7][0];
    } else {
        $involved = $game[4].' - '.$game[5];
    }

    $vev->add('SUMMARY',$involved.' / '.$game[3].' / EURO 2016 France');
    //$ev->add_property('summary', $involved.' / '.$game[3].' / EURO 2016 France');

    $vev->add('DESCRIPTION', "Game ". $game[0] ."\n". "source: http://www.uefa.com/uefaeuro/season=2016/matches/index.html\n\nbrought to you by http://kralo.github.io/euro2016-calendar-ics-exporter/");
    $vev->add('location', $game[2]);

    // Start-end date
    $date = DateTime::createFromFormat('j.m.Y G:i T', $game[1].' CEST');
    $vev->add('DTSTART',gmdate('Ymd\TGis\Z', $date->getTimestamp()));
    $vev->add('DURATION','PT1H45M');
    $vev->DTSTAMP = '20160501T235602Z';
    $vev->add('categories', 'EURO2016-Schedule');
    $vev->add('TRANSP','TRANSPARENT');
}

echo $vcalendar->serialize();
