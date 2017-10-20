<?php

namespace Tripsorter\Model\BoardingCard;

/**
 * Class Train
 * @package Tripsorter\Model\BoardingCard
 * @brief Declares Train ticket
 */
class Train extends AbstractCard {

    /**
     * Transport type
     *
     * @var string
     */
    protected $type = 'train';

    /**
     * Train number
     *
     * @var string
     */
    protected $trainNumber;

    /**
     * @return mixed
     */
    public function getTrainNumber() {
        return $this->trainNumber;
    }

    /**
     * Train constructor
     *
     * @param string $seat
     * @param string $trainNumber
     * @param string $departure
     * @param string $destination
     */
    public function __construct($seat, $trainNumber, $departure, $destination) {
        parent::__construct($seat, $departure, $destination);
        $this->setTrainNumber($trainNumber);
    }

    /**
     * Set train number
     *
     * @param string $trainNumber
     * @return Train
     */
    public function setTrainNumber($trainNumber) : Train {
        $this->trainNumber = $trainNumber;
        return $this;
    }

    /**
     * Convert structure to instruction
     *
     * @return string
     */
    public function __toString() : string {
        return sprintf("Take train %s from %s to %s. Sit in seat %s.",
            $this->trainNumber,
            $this->departure,
            $this->destination,
            $this->seat
        );
    }
}