<?php

namespace Tripsorter\Model\BoardingCard;

use Tripsorter\Model\Baggage;
use Tripsorter\Model\Exception;

/**
 * Class Flight
 * @package Tripsorter\Model\BoardingCard
 * @brief Flight boarding card structure
 */
class Flight extends AbstractCard {

    protected $type = 'flight';

    /**
     * Flight number
     *
     * @var string
     */
    protected $flightNumber;

    /**
     * Set baggage details
     *
     * @var Baggage
     */
    protected $baggage;

    /**
     * @var string
     */
    protected $airport = '';

    /**
     * @var string
     */
    protected $gate;

    /**
     * Flight constructor
     *
     * @param string $seat
     * @param string $flightNumber
     * @param string $gate
     * @param string $departure
     * @param string $destination
     * @param string $airport
     *
     * @param Baggage|string $baggage
     */
    public function __construct($seat, $flightNumber, $gate, $departure, $destination, $baggage = Baggage::AUTO_TRANSFER, $airport = '') {
        if (is_string($baggage)) {
            $baggage = new Baggage($baggage);
        }

        parent::__construct($seat, $departure, $destination);
        $this->setFlightNumber($flightNumber)
            ->setGate($gate)
            ->setBaggage($baggage)
            ->setAirport($airport);
    }

    /**
     * Get flight number
     *
     * @return string
     */
    public function getFlightNumber(): string {
        return $this->flightNumber;
    }

    /**
     * Set flight number
     *
     * @param string $flightNumber
     * @return Flight
     *
     * @throws Exception
     */
    public function setFlightNumber(string $flightNumber): Flight {
        if (preg_match('#^[A-Z]{2,4}\d{2,4}#', $flightNumber)) {
            $this->flightNumber = $flightNumber;
            return $this;
        }
        throw new Exception('Incorrect flight number: ' . $flightNumber);
    }

    /**
     * Set seat
     *
     * @param string $seat
     * @return AbstractCard
     *
     * @throws Exception
     */
    public function setSeat(string $seat): AbstractCard {
        if (preg_match('#^\d+[A-Z]{1}$#', $seat)) {
            $this->seat = $seat;
            return $this;
        }
        throw new Exception('Incorrect seat number: ' . $seat);
    }

    /**
     * Get baggage dropoff
     *
     * @return Baggage
     */
    public function getBaggage(): Baggage {
        return $this->baggage;
    }

    /**
     * Set baggage drop off
     *
     * @param Baggage $baggage
     * @return Flight
     */
    public function setBaggage(Baggage $baggage): Flight {
        $this->baggage = $baggage;
        return $this;
    }

    /**
     * Get gate
     *
     * @return string
     */
    public function getGate(): string {
        return $this->gate;
    }

    /**
     * Set gate
     *
     * @param string $gate
     * @return Flight
     */
    public function setGate(string $gate): Flight {
        $this->gate = $gate;
        return $this;
    }

    /**
     * @param string $airport
     * @return Flight
     */
    public function setAirport(string $airport) : Flight {
        $this->airport = $airport;
        return $this;
    }

    /**
     * @return string
     */
    public function getAirport(): string {
        return $this->airport;
    }

    /**
     * Format object as instruction
     *
     * @return string
     */
    public function __toString() : string {
        /*From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
        Baggage will we automatically transferred from your last leg.*/

        return sprintf('From %s, take %s %s to %s. Gate %s, seat %s. %s',
            $this->departure,
            $this->type,
            $this->flightNumber,
            trim($this->destination . ' '. $this->airport),
            $this->gate,
            $this->seat,
            $this->baggage
        );
    }
}