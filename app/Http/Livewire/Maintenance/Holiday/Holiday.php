<?php

namespace App\Http\Livewire\Maintenance\Holiday;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

use App\Models\Holiday as HolidayModel;
use App\Traits\Common;

class Holiday extends Component
{
    use Common;

    public $holid;
    public $HolidayName;
    public $Day;
    public $Month;
    public $Year;
    public $Location;
    public $Repeat;
    public $Date;
    public $usertype;

    public function rules()
    {
        return [
            'HolidayName' => [
                'required',
                'regex:/^[A-Za-z]+(?:\s[A-Za-z]+)*$/',
                function ($attribute, $value, $fail) {
                    $holiday = HolidayModel::whereRaw('LOWER(HolidayName) = ?', [strtolower($value)])
                                            ->where('HolidayID', '!=', $this->holid)
                                            ->where('Date', date('Y-m-d', strtotime($this->Date)))
                                            ->first();
                    if ($holiday) {
                        $fail('A holiday with the same name and date already exists.');
                    }
                },
                
            ],
            'Date' => 'required|date',
            'Location' => 'required',
            'Repeat' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'HolidayName.regex' => 'Holiday name should be a words with single space between if applicable',
            'Date.required' => 'Select a valid date',
        ];
    }

    public function setDate($day, $month, $dayAndWeekday, $year)
    {
        $this->Date = $day;
        $this->Month = $month;
        $this->Day = $dayAndWeekday;
        $this->Year = $year;
    }

    public function store()
    {
        $input = $this->validate();

        $data = [
            'HolidayName' => $input['HolidayName'],
            'Date' => date('Y-m-d', strtotime($this->Date)),
            'Location' => $input['Location'],
            'RepeatYearly' => $input['Repeat'],
            'DateCreated' => now(),
            'Status' => 1,
        ];

        $holiday = HolidayModel::create($data);

        $latestHoliday = HolidayModel::latest()->first();
        return redirect()->to('/maintenance/holiday/view/' . $latestHoliday->HolidayID)
                         ->with(['mmessage' => 'Holiday has been saved', 'mword' => 'Success']);
    }

    public function update()
    {
        $input = $this->validate();

        $data = [
            'HolidayName' => $input['HolidayName'],
            'Date' => date('Y-m-d', strtotime($this->Date)),
            'Location' => $input['Location'],
            'RepeatYearly' => $input['Repeat'],
            'DateUpdated' => now(),
        ];

        $holiday = HolidayModel::where('HolidayID', $this->holid);

        if ($holiday) {
            $holiday->update($data);

            return redirect()->to('/maintenance/holiday/view/' . $this->holid)
                             ->with(['mmessage' => 'Holiday has been successfully updated!', 'mword' => 'Success']);
        }

        session()->flash('errmmessage', 'Holiday not found');
        return redirect()->to('/maintenance/holiday/list');
    }

    public function archive($holid)
    {
        $holiday = HolidayModel::where('HolidayID', $holid);

        if ($holiday) {
            $holiday->update([
                'Status' => 2,
                'DateUpdated' => now(),
            ]);

            return redirect()->to('/maintenance/holiday/list')
                             ->with('mmessage', 'Holiday has been successfully archived!');
        }

        session()->flash('errmmessage', 'Holiday not found');
        return redirect()->to('/maintenance/holiday/list');
    }

    public function mount($holid = "")
    {
        $this->usertype = session()->get('auth_usertype');

        if ($holid != '') {
            $holiday = HolidayModel::where('HolidayID', $holid)->first();

            if ($holiday) {
                $this->holid = $holiday->HolidayID;
                $this->HolidayName = $holiday->HolidayName;
                $this->Date = date('m/d/Y', strtotime($holiday->Date));
                $this->Day = date('d (l)', strtotime($holiday->Date));
                $this->Month = date('m', strtotime($holiday->Date));
                $this->Year = date('Y', strtotime($holiday->Date));
                $this->Location = $holiday->Location;
                $this->Repeat = $holiday->RepeatYearly ? 1 : 0;
            }
        }
    }

    public function render()
    {
        return view('livewire.maintenance.holiday.holiday');
    }
}
