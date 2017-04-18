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
    
    
}
