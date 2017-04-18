<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 18.04.17
 * Time: 9:47
 */
class Rnb implements iDance
{
    private $head = 1;
    private $body = 1;
    private $legs = 1;
    private $hands = 1;

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

    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.
    }
}