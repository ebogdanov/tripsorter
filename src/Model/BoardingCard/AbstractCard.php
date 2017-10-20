<?php

namespace Tripsorter\Model\BoardingCard;

use Tripsorter\Model\Exception;

/**
 * Class AbstractCard
 * @package Tripsorter\Model\BoardingCard
 */
abstract class AbstractCard implements InterfaceCard {

    /**
     * Transport type
     *
     * @var string
     */
    protected $type;

    /**
     * Seat
     *
     * @var string
     */
    protected $seat;

    /**
     * Departure
     *
     * @var string
     */
    protected $departure;

    /**
     * Destination
     *
     * @var string
     */
    protected $destination;

    /**
     * AbstractCard constructor
     *
     * @param string $seat
     * @param string $departure
     * @param string $destination
     */
    public function __construct($seat, $departure, $destination) {
        $this->setSeat($seat)
            ->setDeparture($departure)
            ->setDestination($destination);
    }

    /**
     * Get seat number
     *
     * @return string
     */
    public function getSeat(): string {
        return $this->seat;
    }

    /**
     * Set seat number
     *
     * @param string $seat
     * @return AbstractCard
     */
    public function setSeat(string $seat): AbstractCard {
        $this->seat = $seat;
        return $this;
    }

    /**
     * Get departure city
     *
     * @return string
     */
    public function getDeparture() {
        return strtoupper($this->departure);
    }

    /**
     * Set departure city
     *
     * @param string $departure
     * @return AbstractCard
     *
     * @throws Exception
     */
    public function setDeparture($departure) : AbstractCard{
        if ($departure === "" || is_null($departure)) {
            throw new Exception('Departure should be specified');
        }

        $this->departure = $departure;
        return $this;
    }

    /**
     * Get destination city
     *
     * @return string
     */
    public function getDestination() {
        return strtoupper($this->destination);
    }

    /**
     * @param string $destination
     * @return AbstractCard
     *
     * @throws Exception
     */
    public function setDestination($destination) : AbstractCard {
        if ($destination === "" || is_null($destination)) {
            throw new Exception('Destination should be specified');
        }

        $this->destination = $destination;
        return $this;
    }
}