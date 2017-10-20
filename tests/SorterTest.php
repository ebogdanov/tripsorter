<?php

use Tripsorter\Model\BoardingCard;
use Tripsorter\Model;
use Tripsorter\Model\Baggage;
use Tripsorter\Service\Instructions;

use PHPUnit\Framework\TestCase;

class SorterTest extends TestCase {

    public function testMain() {
        $baggageDropOff = new Model\Baggage(Model\Baggage::DROP_OFF, 'ticket counter 344');

        $trip = new Model\Collection();

        $sortedCards = $trip
            ->addCard(new BoardingCard\Flight('3A', 'SK455', '45B', 'Gerona Airport','Stockholm', $baggageDropOff))
            ->addCard(new BoardingCard\Train('45B', '78A', 'Madrid', 'Barcelona'))
            ->addCard(new BoardingCard\AirportBus('Barcelona', 'Gerona Airport'))
            ->addCard(new BoardingCard\Flight('7B', 'SK22', '22', 'Stockholm', 'New York', Baggage::AUTO_TRANSFER, 'JFK'))
            ->sort()
            ->getCards();

        $instructions = new Instructions($sortedCards);
        $instructions->asText();

        $outputText = <<<TEXT
Take train 78A from Madrid to Barcelona. Sit in seat 45B.
Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.
From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.

TEXT;

        $outputHtml = <<<HTML
<ol><li>Take train 78A from Madrid to Barcelona. Sit in seat 45B.</li><li>Take the airport bus from Barcelona to Gerona Airport. No seat assignment.</li><li>From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.</li><li>From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.</li></ol>
HTML;


        $this->assertEquals($instructions->asText(), $outputText);
        $this->assertEquals($instructions->asHtml(), $outputHtml);
    }

    /**
     * @expectedException Tripsorter\Model\Exception
     */
    public function testIncompleteRoute() {
        $trip = new Model\Collection();

        $trip
            ->addCard(new BoardingCard\Flight('3A', 'SK455', '45B', 'Gerona Airport','Stockholm'))
            ->addCard(new BoardingCard\Train('45B', '78A', 'Madrid', 'Barcelona'))
            ->sort();
    }
}