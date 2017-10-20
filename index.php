<?php

require_once __DIR__ . '/vendor/autoload.php';

use Tripsorter\Model\BoardingCard\Flight;
use Tripsorter\Model\BoardingCard\Train;
use Tripsorter\Model\BoardingCard\AirportBus;
use Tripsorter\Model\Collection;
use Tripsorter\Model\Baggage;

use Tripsorter\Service\Instructions;

try {
    $baggageDropOff = new Baggage(Baggage::DROP_OFF, 'ticket counter 344');

    $trip = new Collection();

    $sortedCards = $trip
        ->addCard(new Flight('3A', 'SK455', '45B', 'Gerona Airport','Stockholm', $baggageDropOff))
        ->addCard(new Train('45B', '78A', 'Madrid', 'Barcelona'))
        ->addCard(new AirportBus('Barcelona', 'Gerona Airport'))
        ->addCard(new Flight('7B', 'SK22', '22', 'Stockholm', 'New York', Baggage::AUTO_TRANSFER, 'JFK'))
        ->sort()
        ->getCards();

    $instructions = new Instructions($sortedCards);
    echo $instructions->asText();

} catch (\Exception $e) {
    echo 'Error: ', $e->getMessage();
}

echo PHP_EOL;