<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 18.04.17
 * Time: 10:19
 */
class DanceFloor
{
    private $current_music;

    /**
     * @return mixed
     */
    public function getCurrentMusic()
    {
        return $this->current_music;
    }

    /**
     * @param mixed $current_music
     */
    public function setCurrentMusic($current_music)
    {
        $this->current_music = $current_music;
    }
    
    public function allowedToDance($dancer)
    {
        if ($dancer->getHead() == $this->current_music->getHead() ||
            $dancer->getBody() == $this->current_music->getBody() ||
            $dancer->getHands() == $this->current_music->getHands() ||
            $dancer->getLegs() == $this->current_music->getLegs()) {
            
            return true;
        }
        else return false;
    }
    
}