<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 18.04.17
 * Time: 10:17
 */
class Pop implements iDance
{
    private $head = 3;
    private $body = 3;
    private $legs = 3;
    private $hands = 3;


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