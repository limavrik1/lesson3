<?php
/**
 * Created by PhpStorm.
 * User: Andrius Mikelionis
 * Date: 2/17/2017
 * Time: 10:44 PM
 */

//Use this post http://stackoverflow.com/a/6785366
function array_flatten($array)
{
    if (!is_array($array)) {
        return FALSE;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        } else {
            $result[$key] = $value;
        }
    }
    return $result;
}

function array_shuffle($array)
{
    if (shuffle($array)) {
        return $array;
    } else {
        return FALSE;
    }
}

$continentsAnimals = array(
    "Antarctica" => array("Antarctopelta oliveroi", "Pygoscelis antarcticus"),
    "Africa" => array("Orycteropodidae", "Afrosoricida", "Soricomorpha"),
    "Australia" => array("Canis lupus dingo", "Phascolarctos cinereus", "Dasyurus maculatus"),
    "Eurasia" => array("Rattus timorensis", "Crocidura tenuis", "Eliomys quercinus", "Spalax zemni"),
    "North America" => array("Mammuthus columbi", "Alligator mississippiensis"),
    "South America" => array("Lama glama", "Panthera onca")
);

$continentsAnimalsTwoWords = array();
$continentsAnimalsCount = array();
$newAnimalsTwoWordsArray = array();


foreach ($continentsAnimals as $continentAnimal => $animals) {
    $continent = $continentAnimal;
    foreach ($animals as $animal) {

        if (substr_count($animal, ' ') === 1) {


            $continentsAnimalsTwoWords[$continent][] = $animal;

        }
    }

}

foreach ($continentsAnimalsTwoWords as $continentAnimal => $animals) {

    $continentsAnimalsCount[$continentAnimal][] = count($animals);
}

$allAnimalsTwoWords = array_flatten($continentsAnimalsTwoWords);
$allAnimalsWordsString = implode(" ", $allAnimalsTwoWords);
$allAnimalsWordsArray = explode(" ", $allAnimalsWordsString);
$wordsCount = count($allAnimalsWordsArray);

$oddWordsArray = array();
$evenWordsArray = array();

for ($wordIndex = 0; $wordIndex < $wordsCount; $wordIndex++) {
    if ((($wordIndex + 1) % 2) === 1) {
        $oddWordsArray[] = $allAnimalsWordsArray[$wordIndex];
    }
    if ((($wordIndex + 1) % 2) === 0) {
        $evenWordsArray[] = $allAnimalsWordsArray[$wordIndex];
    }
}

$evenWordsShuffledArray = array_shuffle($evenWordsArray);

$oddWordsArrayCount = count($oddWordsArray);

for ($arrayIndex = 0; $arrayIndex < $oddWordsArrayCount; $arrayIndex++) {
    $newAnimalsTwoWordsArray[] = "{$oddWordsArray[$arrayIndex]} {$evenWordsShuffledArray[$arrayIndex]}";
}

$position = 0;
foreach ($continentsAnimalsCount as $continent => $animalsCount) {
    echo '<h2>' . $continent . '</h2>';
    $continentsAnimals = array_slice($newAnimalsTwoWordsArray, $position, $animalsCount[0]);
    foreach ($continentsAnimals as $continentsAnimal) {
        echo $continentsAnimal;
        echo '</br>';
    }
    $position += $animalsCount[0];
}