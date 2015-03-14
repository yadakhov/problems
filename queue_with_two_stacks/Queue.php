<?php

class Queue
{
    private $input;
    private $output;

    public function __construct()
    {
        $this->input = new SplStack();
        $this->output = new SplStack();
    }


    public function enqueue($item)
    {
        $this->input->push($item);
    }

    public function dequeue()
    {
        if (! $this->output->isEmpty()) {
            return $this->output->pop();
        }

        while(! $this->input->isEmpty()) {
            $this->output->push($this->input->pop());
        }

        return $this->output->pop();
    }

    public function isEmpty()
    {
        return $this->input->isEmpty() && $this->output->isEmpty();
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
$q->dequeue();
$q->enqueue('g');
$q->enqueue('h');

while (! $q->isEmpty()) {
    echo $q->dequeue()."\n";
}
