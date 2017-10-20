<?php

use Tripsorter\Model\BoardingCard\Flight;
use Tripsorter\Model;

use PHPUnit\Framework\TestCase;

class FlightClassTest extends TestCase {

    public function testConstructor() {
        $card = new Flight('3A', 'SK455', '45B', 'Gerona Airport','Stockholm');

        $this->assertInstanceOf('\Tripsorter\Model\BoardingCard\Flight', $card);
        $this->assertInstanceOf('Tripsorter\Model\BoardingCard\AbstractCard', $card);
    }

    /**
     * @expectedException Tripsorter\Model\Exception
     */
    public function testValidationFlight() {
        // Should not match regular expression in flight number
        $card = new Flight('3A', '455SK', '45B', 'Gerona Airport','Stockholm');
    }

    /**
     * @expectedException Tripsorter\Model\Exception
     */
    public function testValidationSeat() {
        // Seat should be followed by letter, exception will be throwed
        $card = new Flight('30', 'SK455', '45B', 'Gerona Airport','Stockholm');
    }
}