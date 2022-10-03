<?php

class TV
{
    private string $manufacturer;
    private int $channel;
    private int $volume;
    /**
     * @param string $manufacturer
     * @param int $channel 
     * @param int $volume 
     */
    public function __construct(string $manufacturer)
    {
        $this->manufacturer = $manufacturer;
        $this->channel = 1;
        $this->volume = 50;
    }

    public function resetParameters()
    {
        $this->channel = 1;
        $this->volume = 50;
    }

    /**
     * @param int $channel 
     * @return TV
     */
    public function setChannel(int $channel): self
    {
        if ($channel > 50) {
            $this->channel = 1;
        } elseif ($channel < 1) {
            $this->channel = 50;
        } else {
            $this->channel = $channel;
        }
        return $this;
    }
    public function setVolume(int $volume): self
    {
        if ($volume > 100) {
            $this->volume = 100;
        } elseif ($volume < 1) {
            $this->volume = 1;
        } else {
            $this->volume = $volume;
        }
        return $this;
    }
    public function getInfo(): string
    {
        return 'TV \'' . $this->manufacturer . '\' shows channel ' . $this->channel . ' and the volume is ' . $this->volume;
    }
}

$sony = new TV('Sony');

print($sony->getInfo() . PHP_EOL);
