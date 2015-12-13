<?php

// error_reporting(E_ALL);

include dirname(__FILE__).'/./bennu/lib/bennu.inc.php';

$param_in = $_GET['p'];
$params = explode('-', $param_in);

// Send Headers for correct caching
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', strtotime('2016-06-22 22:00:00')));
header('cache-control: public ');
header('ETag: ' . md5('Revision1'));

// headers for file downloaders
header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="euro2016-schedule-'.$param_in.'.ics"');

// gamenr, date, location, phase, formal1, formal2, potential1, potential2
$games = [
['1', '10.06.2016 21:00', 'Saint-Denis', 'Group matches', 'FRA', 'ROU', ['FRA'], ['ROU']],
['2', '11.06.2016 15:00', 'Lens', 'Group matches', 'ALB', 'SUI', ['ALB'], ['SUI']],
['3', '11.06.2016 18:00', 'Bordeaux', 'Group matches', 'WAL', 'SVK', ['WAL'], ['SVK']],
['4', '11.06.2016 21:00', 'Marseille', 'Group matches', 'ENG', 'RUS', ['ENG'], ['RUS']],
['5', '12.06.2016 15:00', 'Paris', 'Group matches', 'TUR', 'CRO', ['TUR'], ['CRO']],
['6', '12.06.2016 18:00', 'Nice', 'Group matches', 'POL', 'NIR', ['POL'], ['NIR']],
['7', '12.06.2016 21:00', 'Lille', 'Group matches', 'GER', 'UKR', ['GER'], ['UKR']],
['8', '13.06.2016 15:00', 'Toulouse', 'Group matches', 'ESP', 'CZE', ['ESP'], ['CZE']],
['9', '13.06.2016 18:00', 'Saint-Denis', 'Group matches', 'IRL', 'SWE', ['IRL'], ['SWE']],
['10', '13.06.2016 21:00', 'Lyon', 'Group matches', 'BEL', 'ITA', ['BEL'], ['ITA']],
['11', '14.06.2016 18:00', 'Bordeaux', 'Group matches', 'AUT', 'HUN', ['AUT'], ['HUN']],
['12', '14.06.2016 21:00', 'Saint-Etienne', 'Group matches', 'POR', 'ISL', ['POR'], ['ISL']],
['13', '15.06.2016 15:00', 'Lille', 'Group matches', 'RUS', 'SVK', ['RUS'], ['SVK']],
['14', '15.06.2016 18:00', 'Paris', 'Group matches', 'ROU', 'SUI', ['ROU'], ['SUI']],
['15', '15.06.2016 21:00', 'Marseille', 'Group matches', 'FRA', 'ALB', ['FRA'], ['ALB']],
['16', '16.06.2016 15:00', 'Lens', 'Group matches', 'ENG', 'WAL', ['ENG'], ['WAL']],
['17', '16.06.2016 18:00', 'Lyon', 'Group matches', 'UKR', 'NIR', ['UKR'], ['NIR']],
['18', '16.06.2016 21:00', 'Saint-Denis', 'Group matches', 'GER', 'POL', ['GER'], ['POL']],
['19', '17.06.2016 15:00', 'Toulouse', 'Group matches', 'ITA', 'SWE', ['ITA'], ['SWE']],
['20', '17.06.2016 18:00', 'Saint-Etienne', 'Group matches', 'CZE', 'CRO', ['CZE'], ['CRO']],
['21', '17.06.2016 21:00', 'Nice', 'Group matches', 'ESP', 'TUR', ['ESP'], ['TUR']],
['22', '18.06.2016 15:00', 'Bordeaux', 'Group matches', 'BEL', 'IRL', ['BEL'], ['IRL']],
['23', '18.06.2016 18:00', 'Marseille', 'Group matches', 'ISL', 'HUN', ['ISL'], ['HUN']],
['24', '18.06.2016 21:00', 'Paris', 'Group matches', 'POR', 'AUT', ['POR'], ['AUT']],
['25', '19.06.2016 21:00', 'Lyon', 'Group matches', 'ROU', 'ALB', ['ROU'], ['ALB']],
['26', '19.06.2016 21:00', 'Lille', 'Group matches', 'SUI', 'FRA', ['SUI'], ['FRA']],
['27', '20.06.2016 21:00', 'Toulouse', 'Group matches', 'RUS', 'WAL', ['RUS'], ['WAL']],
['28', '20.06.2016 21:00', 'Saint-Etienne', 'Group matches', 'SVK', 'ENG', ['SVK'], ['ENG']],
['29', '21.06.2016 18:00', 'Marseille', 'Group matches', 'UKR', 'POL', ['UKR'], ['POL']],
['30', '21.06.2016 18:00', 'Paris', 'Group matches', 'NIR', 'GER', ['NIR'], ['GER']],
['31', '21.06.2016 21:00', 'Lens', 'Group matches', 'CZE', 'TUR', ['CZE'], ['TUR']],
['32', '21.06.2016 21:00', 'Bordeaux', 'Group matches', 'CRO', 'ESP', ['CRO'], ['ESP']],
['33', '22.06.2016 18:00', 'Saint-Denis', 'Group matches', 'ISL', 'AUT', ['ISL'], ['AUT']],
['34', '22.06.2016 18:00', 'Lyon', 'Group matches', 'HUN', 'POR', ['HUN'], ['POR']],
['35', '22.06.2016 21:00', 'Lille', 'Group matches', 'ITA', 'IRL', ['ITA'], ['IRL']],
['36', '22.06.2016 21:00', 'Nice', 'Group matches', 'SWE', 'BEL', ['SWE'], ['BEL']],
['37', '25.06.2016 15:00', 'Saint-Etienne', 'Round of 16', 'RA', 'RC', ['FRA', 'ROU', 'ALB', 'SUI'], ['GER', 'UKR', 'POL', 'NIR']],
['38', '25.06.2016 18:00', 'Paris', 'Round of 16', 'WB', '3A/C/D', ['ENG', 'RUS', 'WAL', 'SVK'], ['FRA', 'ROU', 'ALB', 'SUI', 'GER', 'UKR', 'POL', 'NIR', 'ESP', 'CZE', 'TUR', 'CRO']],
['39', '25.06.2016 21:00', 'Lens', 'Round of 16', 'WD', '3B/E/F', ['ESP', 'CZE', 'TUR', 'CRO'], ['ENG', 'RUS', 'WAL', 'SVK', 'POR', 'ISL', 'AUT', 'HUN', 'BEL', 'ITA', 'IRL', 'SWE']],
['40', '26.06.2016 15:00', 'Lyon', 'Round of 16', 'WA', '3C/D/E', ['FRA', 'ROU', 'ALB', 'SUI'], ['BEL', 'ITA', 'IRL', 'SWE', 'ESP', 'CZE', 'TUR', 'CRO', 'GER', 'UKR', 'POL', 'NIR']],
['41', '26.06.2016 18:00', 'Lille', 'Round of 16', 'WC', '3A/B/F', ['GER', 'UKR', 'POL', 'NIR'], ['ENG', 'RUS', 'WAL', 'SVK', 'POR', 'ISL', 'AUT', 'HUN', 'FRA', 'ROU', 'ALB', 'SUI']],
['42', '26.06.2016 21:00', 'Toulouse', 'Round of 16', 'WF', 'RE', ['POR', 'ISL', 'AUT', 'HUN'], ['BEL', 'ITA', 'IRL', 'SWE']],
['43', '27.06.2016 18:00', 'Saint-Denis', 'Round of 16', 'WE', 'RD', ['BEL', 'ITA', 'IRL', 'SWE'], ['ESP', 'CZE', 'TUR', 'CRO']],
['44', '27.06.2016 21:00', 'Nice', 'Round of 16', 'RB', 'RF', ['ENG', 'RUS', 'WAL', 'SVK'], ['POR', 'ISL', 'AUT', 'HUN']],
['45', '30.06.2016 21:00', 'Marseille', 'Quarter-Finals', 'W37', 'W39', 'Z', 'Z'],
['46', '01.07.2016 21:00', 'Lille', 'Quarter-Finals', 'W38', 'W42', 'Z', 'Z'],
['47', '02.07.2016 21:00', 'Bordeaux', 'Quarter-Finals', 'W41', 'W43', 'Z', 'Z'],
['48', '03.07.2016 21:00', 'Saint-Denis', 'Quarter-Finals', 'W40', 'W44', 'Z', 'Z'],
['49', '06.07.2016 21:00', 'Lyon', 'Half-Finals', 'W45', 'W46', 'Z', 'Z'],
['50', '07.07.2016 21:00', 'Marseille', 'Half-Finals', 'W47', 'W48', 'Z', 'Z'],
['51', '10.07.2016 21:00', 'Saint-Denis', 'Final', 'W49', 'W50', 'Z', 'Z'],
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

$calendar = new iCalendar();
$calendar->add_property('X-WR-CALNAME', 'EURO 2016 Schedule '.$param_in);

// $calendar->add_property('X-WR-CALDESC', 'EURO 2016 Schedule '. $param_in);

foreach ($outgames as $game) {
    $ev = new iCalendar_event();

    $ev->add_property('uid', 'euro2016_game'.$game[0]);

    // Summary and description; also resources

    if ($game[6] != 'Z' && sizeof($game[6]) == 1 && sizeof($game[7]) == 1) {
        $involved = $game[6][0].' - '.$game[7][0];
    } else {
        $involved = $game[4].' - '.$game[5];
    }

    $ev->add_property('summary', $involved.' / '.$game[3].' / EURO 2016 France');

    // $ev->add_property('description', 'Game '. $game[0] .'\n'. 'source: http://www.uefa.com/uefaeuro/season=2016/matches/day=1/index.html');

    $ev->add_property('location', $game[2]);

    // Start-end date
    $date = DateTime::createFromFormat('j.m.Y G:i T', $game[1].' CET');
    $ev->add_property('dtstart', gmdate('Ymd\TGis\Z', $date->getTimestamp()));
    $ev->add_property('duration', 'PT1H45M');
    $ev->add_property('dtstamp', '20151212T235601Z');
    $ev->add_property('categories', 'EURO2016-Schedule');
		$ev->add_property('TRANSP', 'TRANSPARENT');
    $calendar->add_component($ev);
}

echo $calendar->serialize();
