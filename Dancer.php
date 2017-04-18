<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 18.04.17
 * Time: 9:51
 */
class Dancer
{
    private $name;
    private $head;
    private $body;
    private $legs;
    private $hands;

    public static $count;

    public function __construct()
    {
        self::$count++;
        $this->name = "Dancer #" . self::$count;
        $this->head = rand(1, 3);
        $this->body = rand(1, 3);
        $this->legs = rand(1, 3);
        $this->hands = rand(1, 3);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @return int
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getLegs()
    {
        return $this->legs;
    }

    /**
     * @return int
     */
    public function getHands()
    {
        return $this->hands;
    }

    public function allowedToDance($music)
    {
        if ($music->getHead() == $this->getHead() ||
            $music->getBody() == $this->getBody() ||
            $music->getHands() == $this->getHands() ||
            $music->getLegs() == $this->getLegs()) {

            return true;
        }
        else return false;
    }

}
