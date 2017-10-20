<?php

namespace Tripsorter\Model\BoardingCard;

/**
 * Class AirportBus
 * @package Tripsorter\Model\BoardingCard
 *
 * @brief Declares airport bus boarding card structure
 */
class AirportBus extends AbstractCard {

    /**
     * Transport type
     *
     * @var string
     */
    protected $type = 'airport bus';

    /** @noinspection PhpMissingParentConstructorInspection */

    /**
     * AirportBus constructor
     *
     * @param string $departure
     * @param string $destination
     */
    public function __construct($departure, $destination) {
        $this->setDeparture($departure)
            ->setDestination($destination);
    }

    /**
     * Convert structure to string, as instruction for human
     *
     * @return string
     */
    public function __toString() : string {
        return sprintf(
            'Take the %s from %s to %s. No seat assignment.',
            $this->type,
            $this->departure,
            $this->destination
        );
    }
}