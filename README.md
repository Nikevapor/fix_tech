# fix_tech
iDance.php - интерфейс для жанров, я его по сути не использовал, но возможно использовать в будущем (типа расширяемость)
Rnb.php, Electrohouse.php, Pop.php - классы, реализующие iDance.php; жанры музыки, у которых свои свойства, которые требуется для движения под музыку данного жанра. Я обозначил эти движения числами [1, 2 , 3]
DanceFloor.php - класс танцпола. Имеет свойство текущей музыки(жанра) на танцполе. Также имеется метод, для определения есть ли у гостя способности танцевать под данную музыку.
Инициализация танцпола и поведение гостей реализованы в index.php 
