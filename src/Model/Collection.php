<?php

namespace Tripsorter\Model;

use Tripsorter\Model\BoardingCard\AbstractCard;

/**
 * Class Collection
 *
 * @package Tripsorter\Service
 */
class Collection {

    /**
     * @var \ArrayObject
     */
    protected $cards;

    /**
     * @var array
     */
    protected $route = [];

    /**
     * @var \ArrayObject
     */
    private $sortedCards = [];

    /**
     * @var array
     */
    protected $citiesStat = [];

    /**
     * Collection constructor
     */
    public function __construct() {
        $this->cards = new \ArrayObject();
    }

    /**
     * Add card to collection
     *
     * @param AbstractCard $card
     * @return Collection
     */
    public function addCard(AbstractCard $card) : Collection {
        $this->cards->append($card);
        $index = $this->cards->count() - 1;

        $departure   = $card->getDeparture();
        $destination = $card->getDestination();

        // Prepare index and stat for lookup "start" point
        if (!isset($this->citiesStat[$departure])) {
            $this->citiesStat[$departure] = 0;
        }
        $this->citiesStat[$departure]++;

        if (!isset($this->citiesStat[$destination])) {
            $this->citiesStat[$destination] = 0;
        }
        $this->citiesStat[$destination]--;

        if (!isset($this->route[$departure])) {
            $this->route[$departure] = [];
        }
        $this->route[$departure][] = $index;

        return $this;
    }

    /**
     * Search route
     *
     * @param array $graph
     * @param int $index
     *
     * @return \ArrayObject
     */
    public function buildRoute($graph, $index) : \ArrayObject {
        $sortedCards = new \ArrayObject();
        /**
         * @var AbstractCard $card
         */
        do {
            $card = $this->cards->offsetGet($index);
            $sortedCards->append($card);

            $index = isset($graph[$card->getDestination()])
                ? array_shift($graph[$card->getDestination()])
                : null;

        } while (!is_null($index));

        return $sortedCards;
    }

    /**
     * Sort cards in collection
     *
     * @return Collection
     * @throws Exception
     */
    public function sort() : Collection {
        // Search start point of our trip
        $index = array_search(1 , $this->citiesStat);
        if ($index === false) {
            throw new Exception('Unable to find route starting point');
        }

        if (!empty($this->route[$index][0])) {
            $this->sortedCards = $this->buildRoute($this->route, $this->route[$index][0]);
        }

        if (empty($this->sortedCards) ||
            ($this->sortedCards->count() != $this->cards->count())
        ) {
            throw new Exception('Unable to sort cards. Check data for consistency');
        }

        return $this;
    }

    /**
     * @return \ArrayObject
     */
    public function getCards(): \ArrayObject {
        return $this->sortedCards->count()
            ? $this->sortedCards
            : $this->cards;
    }
}
