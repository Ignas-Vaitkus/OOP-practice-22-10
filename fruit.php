<?php

$cores = (object)nuLL;

class Fruit
{
    private int $size;
    private int $id;
    private bool $bitten;


    /**
     * @param $size int 
     * @param $id int 
     * @param $bitten bool 
     */
    function __construct()
    {
        $this->size = rand(5, 25);
        $this->id = rand(1000000, 9999999);
        $this->bitten = false;
    }

    /**
     * @return int
     */
    function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return int
     */
    function getId(): int
    {
        return $this->id;
    }

    public function bite()
    {
        $this->bitten = true;
    }
}

class Basket
{
    private static array $fruits = [];

    static function getFruit(): array
    {
        return self::$fruits;
    }

    public static function fill()
    {
        while (sizeof(self::$fruits) < 20) {
            self::$fruits[] = new Fruit();
        }

        usort(self::$fruits, function ($fruit1, $fruit2) {
            return $fruit1->getSize() < $fruit2->getSize();
        });
    }

    public static function takeOut(object $cores): Fruit

    {
        $biggest = self::$fruits[0];
        $biggest->bite();

        $cores->{$biggest->getId()} = $biggest;

        array_splice(self::$fruits, 0, 1);

        return $biggest;
    }
    /**
     * @return array
     */
}

Basket::fill();

// var_dump(Basket::getFruit());
// print(PHP_EOL);

for ($i = 0; $i < 3; $i++) {
    Basket::takeOut($cores);
}

// var_dump($cores);
// print(PHP_EOL);

// var_dump(Basket::getFruit());
// print(PHP_EOL);
