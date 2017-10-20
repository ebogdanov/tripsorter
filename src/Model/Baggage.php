<?php

namespace Tripsorter\Model;

/**
 * Class Baggage
 * @package Tripsorter\Model
 * @brief Declares information about baggage for BoardingCards
 */
class Baggage implements BoardingCard\InterfaceCard {

    /**
     * Auto mode
     */
    const AUTO_TRANSFER = 'auto';

    /**
     * Baggage should be dropped at specified place
     */
    const DROP_OFF = 'drop';

    /**
     * Baggage mode
     *
     * @var string
     */
    protected $mode;

    /**
     * Dropoff place
     *
     * @var string
     */
    protected $dropOffPlace;

    /**
     * Baggage constructor
     *
     * @param string $mode
     * @param string $dropOffPlace
     *
     * @throws Exception
     */
    public function __construct($mode, $dropOffPlace = '') {
        if ($mode != self::AUTO_TRANSFER && $dropOffPlace == '') {
            throw new Exception('Dropoff should be specified if non auto-transfer mode');
        }

        $this->setMode($mode);
        if ($dropOffPlace) {
            $this->setDropOffPlace($dropOffPlace);
        }
    }

    /**
     * @return string
     */
    public function getMode(): string {
        return $this->mode;
    }

    /**
     * @param string $mode
     * @return Baggage
     */
    public function setMode(string $mode): Baggage {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Get dropoff place
     *
     * @return string
     */
    public function getDropOffPlace(): string {
        return $this->dropOffPlace;
    }

    /**
     * Set dropoff place
     *
     * @param string $dropOffPlace
     * @return Baggage
     */
    public function setDropOffPlace(string $dropOffPlace): Baggage {
        $this->dropOffPlace = $dropOffPlace;
        return $this;
    }

    /**
     * Return as string
     *
     * @return string
     */
    public function __toString() : string {
        return ($this->mode == self::AUTO_TRANSFER)
            ? 'Baggage will we automatically transferred from your last leg.'
            : sprintf('Baggage drop at %s.', $this->dropOffPlace);
    }
}