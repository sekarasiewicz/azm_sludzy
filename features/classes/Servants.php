<?php
require_once(dirname(dirname(__FILE__)) . '/functions/' . 'autoload.php');

class Servants extends SectionsBase
{
    public $servants;
    public $lastUpdate;

    public function fetch_servants()
    {
        return $this->servants = $this->fetch("SELECT servants.* FROM rank INNER JOIN servants ON rank.id = servants.rank_id ORDER BY rank.level ASC, servants.status DESC, servants.nick ASC ");
    }

    public function grouped_servants_by_rank()
    {
        $groupedServants = array();

        foreach ($this->servants as $servant) {
            $groupedServants[$servant->rank_id][] = $servant;
        }

        return $groupedServants;
    }

    public function ranks_count()
    {
        $ranksCount = array();

        foreach ($this->grouped_servants_by_rank() as $rank_id => $servants) {
            $ranksCount[$rank_id] = sizeof($servants);
        }

        return $ranksCount;
    }

    public function count()
    {
        return sizeof($this->servants);
    }

    public function last_added()
    {
        if ($this->lastUpdate != null) {
            $lastUpdate = $this->lastUpdate;
        } else {
            $lastUpdate = $this->fetch("SELECT servants.updated_at FROM servants ORDER BY updated_at DESC LIMIT 1");
        }

        return $lastUpdate[0]->updated_at;
    }
}