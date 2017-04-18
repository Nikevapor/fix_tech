<?php
/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 18.04.17
 * Time: 9:52
 */
require_once "iDance.php";
require_once "Rnb.php";
require_once 'Electrohouse.php';
require_once 'Pop.php';
require_once "Dancer.php";
require_once "DanceFloor.php";

$dancers = [];
for ($i = 0; $i < 10; $i++) {
    $dancers[] = new Dancer();
} //получили массив гостей(потенциальных танцоров)
$genres = [];
$genres[] = new Rnb();
$genres[] = new Electrohouse();
$genres[] = new Pop();
//получили массив жанров

$dance_floor = new DanceFloor();
//создали объект танцпола

$count = 0;
while(true) {
    $dance_floor->setCurrentMusic($genres[rand(0, 2)]); // случайно выбираем объект жанра из массива жанров
    echo "Текущая музыка на тацполе ". get_class($dance_floor->getCurrentMusic()). ". ";
    foreach ($dancers as $dancer) {
        if ($dancer->allowedToDance($dance_floor->getCurrentMusic())) { //проверяем способен ли танцевать под данный жанр гость
            echo $dancer->getName(). " танцует". "<br>";
        }
        else {
            echo $dancer->getName(). " пошел пить водку". "<br>";
        }
    }//если у гостя есть какая-либо способность танцевать под текщий жанр, он танцует, иначае уходит пить водку
    $count++;
    if ($count > 10) {
        break;
    } //десять итераций достаточны для наглядности
    //sleep(10);
}

