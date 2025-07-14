<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Jenssegers\Agent\Agent;

class HotelList extends Component
{
    public $hotelList;
    public $searchTerms;
    public $hotelId;
    /**
     * Create a new component instance.
     */
    public function __construct($hotelList, $searchTerms, $hotelId=null)
    {
        $this->hotelList = $hotelList;
        $this->searchTerms = $searchTerms;
        $this->hotelId = $hotelId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $agent = new Agent();
        return view('components.hotel-list', compact('agent'));
    }
}
