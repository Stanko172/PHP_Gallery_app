<?php

class Paginate {
    public $page;
    public $items_per_page;
    public $total_items_count;

    public function __construct($page = 1, $items_per_page = 8, $total_items_count = 0)
    {
        $this->page = $page;
        $this->items_per_page = $items_per_page;
        $this->total_items_count = $total_items_count;
    }

    public function next(){
        return $this->page + 1;
    }

    public function previous(){
        return $this->page - 1;
    }

    public function total_page(){
        return ceil($this->total_items_count / $this->items_per_page);
    }

    public function has_previous(){
        return $this->previous() >= 1 ? true : false;  
    }

    public function has_next(){
        return $this->next() <= $this->total_page() ? true : false;
    }

    public function offset(){
        return ($this->page - 1) * $this->items_per_page;
    }
}

?>