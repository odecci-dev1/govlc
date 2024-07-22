<?php

namespace App\Http\Livewire\Maintenance\Holiday;

use App\Models\Holiday;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Traits\Common;

class HolidayList extends Component
{
    use Common;
    public $list = [];
    public $usertype;
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    public function archive($holid)
    {
        $holiday = Holiday::where('HolidayID', $holid);
        
        if ($holiday) {
            $holiday->update([
                'Status' => 2,
                'DateUpdate' => now(),
            ]);

            session()->flash('mmessage', 'Holiday has been successfully archived!');
            session()->flash('mword', 'Success');
        } else {
            session()->flash('mmessage', 'Holiday not found');
            session()->flash('mword', 'Error');
        }

        return redirect()->to('/maintenance/holiday/list');
    }
    
    public function setPage($page = 1)
    {
        $this->paginate['page'] = $page;
    }

    public function mount()
    {
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 25;
        $this->paginate['FilterName'] = '';        
        $this->paginationPaging['totalPage'] = 0;  
        $this->paginationPaging['totalRecord'] = 0;  
        $this->usertype = session()->get('auth_usertype'); 
    }

    public function render()
    {
        $query = Holiday::query()->where('Status', 1);

        if ($this->keyword) {
            $query->where('HolidayName', 'like', '%' . $this->keyword . '%');
        }

        $totalRecord = $query->count();

        $holidays = $query->orderBy('DateCreated', 'desc')
            ->skip(($this->paginate['page'] - 1) * $this->paginate['pageSize'])
            ->take($this->paginate['pageSize'])
            ->get();

        $this->list = $holidays;

        $this->paginationPaging['totalPage'] = ceil($totalRecord / $this->paginate['pageSize']);
        $this->paginationPaging['totalRecord'] = $totalRecord;
        $this->paginationPaging['currentPage'] = $this->paginate['page'];
        $this->paginationPaging['nextPage'] = $this->paginate['page'] < $this->paginationPaging['totalPage'] ? $this->paginate['page'] + 1 : $this->paginationPaging['totalPage'];
        $this->paginationPaging['prevPage'] = $this->paginate['page'] > 1 ? $this->paginate['page'] - 1 : 1;

        return view('livewire.maintenance.holiday.holiday-list');
    }
}

// Helper Function
if (! function_exists('format_date_with_ordinal')) {
    function format_date_with_ordinal($date) {
        $day = (int) date('j', strtotime($date));
        $dayWithOrdinal = $day . date('S', mktime(0, 0, 0, 1, $day));
        $weekday = date('l', strtotime($date));
        return "{$dayWithOrdinal} ({$weekday})";
    }
}