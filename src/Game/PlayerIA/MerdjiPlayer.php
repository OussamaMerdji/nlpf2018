<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class MerdjiPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class MerdjiPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        $scissors = parent::scissorsChoice();
        $paper = parent::paperChoice();
        $rock = parent::rockChoice();

        if ($this->result->getNbRound() === 0){
            return $paper;
        }

        //if the opponent won the last round and if he repats the same choice in this round => i win.
        if ($this->result->getLastChoiceFor($this->mySide) == "paper" && $this->result->getLastChoiceFor($this->opponentSide) == "scissors"){
            return $rock;
        }
        if ($this->result->getLastChoiceFor($this->mySide) == "scissors" && $this->result->getLastChoiceFor($this->opponentSide) == "rock"){
            return $paper;
        }
        if ($this->result->getLastChoiceFor($this->mySide) == "rock" && $this->result->getLastChoiceFor($this->opponentSide) == "paper"){
            return $scissors;
        }

        $myChoices = $this->result->getChoicesFor($this->mySide);
        $opponentChoices = $this->result->getChoicesFor($this->opponentSide);

        $p = 0;
        $r = 0;
        $s = 0;

        
        //I return the choice which win against the most used opponent choice
        foreach ($opponentChoices as $value){
            if ($value === "paper"){
                $p = $p + 1;
            }
            if ($value === "scissors"){
                $s = $s + 1;
            }
            if ($value === "rock"){
                $r = $r + 1;
            }
        }

        if ($p >= $r && $p >= $s){
            if ($this->result->getLastChoiceFor($this->opponentSide) == "rock"){
                return $rock;
            }
            return $paper;
        }

        if ($s >= $r && $s >= $p){
            if ($this->result->getLastChoiceFor($this->opponentSide) == "paper"){
                return $paper;
            }
            return $scissors;
        }
    
        if ($r >= $s && $r >= $p){
            if ($this->result->getLastChoiceFor($this->opponentSide) == "scissors"){
                return $scissors;
            }
            return $rock;
        }

        return $paper;
    }
};