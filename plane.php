<?php

class Plane implements IteratorAggregate
{
    private array $crewMembers;
    private array $passengers;
    private array $people;
    /**
     * @param $crewMembers array 
     * @param $passengers array 
     */
    public function __construct(array $crewMembers, array $passengers)
    {
        $this->crewMembers = $crewMembers;
        $this->passengers = $passengers;
        $this->people = array_merge($crewMembers, $passengers);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->people);
    }
}

$boeing = new Plane(
    ['Anna', 'Marija', 'Kristina', 'Dovydas'],
    ['Mykolaitis', 'Antanas', 'Petras', 'Kriugeris']
);

foreach ($boeing as $person) {
    print($person);
    echo "\n";
}
