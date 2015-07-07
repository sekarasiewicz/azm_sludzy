<?php
require_once(dirname(dirname(__FILE__)) . '/functions/' . 'autoload.php');

class Rank extends SectionsBase
{
    public $ranks;

    public function fetch_rank()
    {
        return $this->ranks = $this->fetch("SELECT * FROM rank");
    }

    public function find_rank_by_id($rank_id)
    {
        $founded_rank = null;
        foreach($this->ranks as $rank) {
            if ($rank_id == $rank->id) {
                $founded_rank = $rank;
                break;
            }
        }
        return $founded_rank;
    }

    public function count()
    {
        return sizeof($this->ranks);
    }
}