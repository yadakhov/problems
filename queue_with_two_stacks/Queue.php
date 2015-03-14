<?php

class Queue
{
    private $inbox;
    private $outbox;

    public function __construct()
    {
        $this->inbox = new SplStack();
        $this->outbox = new SplStack();
    }


    public function enqueue($item)
    {
        $this->inbox->push($item);
    }

    public function dequeue()
    {
        if ($this->outbox->isEmpty()) {
            while (!$this->inbox->isEmpty()) {
                $this->outbox->push($this->inbox->pop());
            }
        }

        return $this->outbox->pop();
    }

    public function isEmpty()
    {
        return $this->inbox->isEmpty() && $this->outbox->isEmpty();
    }

}

// main
$q = new Queue();

$q->enqueue('a');
$q->enqueue('b');
$q->enqueue('c');
$q->enqueue('d');
$q->enqueue('e');
$q->enqueue('f');
$q->enqueue('g');
$q->enqueue('h');

while (! $q->isEmpty()) {
    echo $q->dequeue()."\n";
}
