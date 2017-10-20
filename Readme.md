### Solution for TripSorter task.
Author: Evgeniy Bogdanov

#### Example:
See index.php as example for call.
* Dockerfile available, you can build it. 
* composer used for building dependencies.
* Requirements: PHP 7.1

#### Extension
To extend project with new cards, you need to do next:
  1. Add new file in src/Model/BoardingCard/ folder with class, inherited from
  \Tripsorter\Model\BoardingCard\AbstractCard
  2. $type property should indicate human readable name of transport
  3. Implement __toString() method, which will give instruction from "boarding" card in 
human-readable text format.
  4. Note that:
* Departure and destination values are required.
* Seats, gates, baggage, and other details are vary and fully depend on child 
class realization.

```
<?php

namespace Tripsorter\Model;

class Ferry extends \Tripsorter\Model\BoardingCard\AbstractCard {
    
    protected $type = 'ferry';
    
    /**
     *
     * @var string
     */
    protected $pier;
    
    public function __construct($seat, $departure, $destination, $pier) {
       $this->pier = $pier;
       parent::__construct($seat, $departure, $destination);
    }
    
    public function __toString() : string {
        return "Take {$this->type} from {$this-departure} to {$this-destination}. Pier {$this->pier}"; 
    }
    
    
}
```
