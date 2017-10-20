<?php

namespace Tripsorter\Service;

use Tripsorter\Model\BoardingCard\AbstractCard;

class Instructions {

    /**
     * @var \ArrayObject
     */
    protected $list;

    /**
     * Instructions constructor
     *
     * @param \ArrayObject $sortedList
     */
    public function __construct($sortedList) {
        $this->list = $sortedList;
    }

    /**
     * Get instructions in Text format
     *
     * @return string
     */
    public function asText() {
        $return = '';
        /**
         * @var AbstractCard $card
         */
        foreach ($this->list as $card) {
            $return .= $card . PHP_EOL;
        }

        return $return;
    }

    /**
     * Get instructions in HTML format
     *
     * @return string
     */
    public function asHtml() {
        $return = '<ol>';
        /**
         * @var AbstractCard $card
         */
        foreach ($this->list as $card) {
            $return .= '<li>' . $card . '</li>';
        }

        $return .= '</ol>';

        return $return;
    }
}
