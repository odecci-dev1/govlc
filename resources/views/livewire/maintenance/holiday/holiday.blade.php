<div>  
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script> 
    <!-- * New Holiday Form -->
    <form action="" class="na-form-con" autocomplete="off">
    @if($showDialog == 1)
        <x-dialog :message="'Are you sure you want to trash this data '" :xmid="$mid" :confirmaction="'archive'" :header="'Trash'"></x-dialog>   
    @endif
    @if(session('mmessage'))
    <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
    <div wire:loading  wire:loading.delay.short wire:target="store, update" class="full-screen-div-loading">
        <div class="center-loading-container">
            <div>
                <div class="lds-dual-ring"></div>
            </div>
            <div class="loading-text">
                <span>Please wait . . .</span>
            </div>
        </div>        
    </div>
    <!-- * Container Wrapper: Add New Holiday -->

        <!-- * Container 1: Add New Holiday and Buttons -->
        <div class="nh-con">

            <!-- * Container Wrapper -->
            <div class="container-wrapper">

                <!-- * Big Container -->
                <div class="big-con">

                    <!-- * Form Header -->

                    <!-- * Rowspan 1: Rowspan Header: Header and Buttons -->
                    <div class="rowspan">

                        <!-- * Header Wrapper -->
                        <div class="header-wrapper">
                            <h2>New Holiday</h2>
                        </div>

                        <!-- * Buttons -->
                        <div class="btn-wrapper">
                        @if($usertype != 2)
                            <!-- * Save -->
                            @if($holid == '')
                            <button type="button" wire:click="store" class="button" data-save>Save</button>
                            @else
                            <button type="button" wire:click="update" class="button" data-save>Update</button>
                            <button type="button" onclick="showDialog('{{ $holid }}')"  class="button" data-save>Trash</button>
                            @endif
                        @endif
                        </div>

                    </div>

                    <!-- * Rowspan 2: Last Update and View History -->
                    <div class="rowspan">

                        <!-- * First Name -->
                        <p>Last Updated:
                            <span>
                                <span id="nhDate">05/26/2022</span> ,
                                <span id="nhDay">Thursday</span> at
                                <span id="nhTime">9:45 am</span> by
                                <span id="nhUser">Admin</span>
                            </span>
                        </p>

                        <!-- * View History -->
                        <div class="btn-wrapper">
                            <button type="button">View History</button>
                        </div>

                    </div>

                    <!-- * Rowspan 3: Holiday Name -->
                    <div class="rowspan">

                        <!-- * Holiday Name -->
                        <div class="input-wrapper">
                            <span>Holiday Name</span>
                            <input wire:model.lazy="name" autocomplete="off" type="text">
                            @error('name') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                    </div>

                    <!-- * Rowspan 4: Pick a date, Month, Day, and Year -->
                    <div class="rowspan" >

                        <!-- * Pick a date -->
                        <div class="input-wrapper" wire:ignore>
                            <input type="hidden" wire:model="date" id="mdate" >
                            <span>Pick a date</span>
                                <input type="button" class="datepicker-toggle" id="datepicker">                                
                            </input>
                        </div>

                        <!-- * Month -->
                        <div class="input-wrapper">
                            <span>Month:</span>
                            <input autocomplete="off" disabled wire:model.lazy="month"  type="text" class="calendarSelect" id="formHolidayMonth" name="formHolidayMonth"  >
                            @error('month') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Day -->
                        <div class="input-wrapper">
                            <span>Day:</span>
                            <input autocomplete="off" disabled wire:model.lazy="day"  type="text" class="calendarSelect" id="formHolidayDay" name="formHolidayDay" >
                            @error('day') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Year -->
                        <div class="input-wrapper">
                            <span>Year:</span>
                            <input autocomplete="off" disabled wire:model.lazy="year"  type="text" class="calendarSelect" id="formHolidayYear" name="formHolidayYear" >
                            @error('year') <span class="text-required">{{ $message }}</span>@enderror
                        </div>
                        @error('date') <span class="text-required" style="font-size: 1.8rem;">{{ $message }}</span>@enderror
                    </div>
                    
                    <!-- * Rowspan 5: Location / Area -->
                    <div class="rowspan">

                        <!-- * Location / Area -->
                        <div class="input-wrapper">
                            <span>Location / Area</span>
                            <input autocomplete="off" type="text" wire:model.lazy="location">
                            @error('location') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                    </div>

                    <!-- * Rowspan 6: Repeat Yearly Radio Buttons -->
                    <div class="rowspan">

                        <!-- * Repeat Yearly Radio Buttons -->
                        <div class="input-wrapper">

                            <span>Repeat Yearly?</span>

                            <div class="box-wrap">

                                <!-- * Yes -->
                                <div class="radio-btn-wrapper">
                                    <span>Yes</span>
                                    <input  wire:model.lazy="repeat" autocomplete="off" type="radio" name="repeat" value="1">
                                </div>

                                <!-- * No -->
                                <div class="radio-btn-wrapper">
                                    <span>No</span>
                                    <input  wire:model.lazy="repeat" autocomplete="off" type="radio" name="repeat" value="0">
                                </div>

                            </div>
                            @error('repeat') <span class="text-required">{{ $message }}</span>@enderror

                        </div>

                    </div>

                </div>

            </div>

            <div class="cancel-btn-wrapper">
                <a href="{{ URL::to('/') }}/maintenance/holiday/list">
                    <button type="button" class="transparentButtonUnderline">Cancel</button>
                </a>
            </div>

        </div>


    </form>
      
</div>
<script>
    document.addEventListener('livewire:load', function () {
            $( "#datepicker" ).datepicker({	
                showButtonPanel: true,
                // format: "MM, d DD, yy",
                // formatSubmit: "MM, d DD, yy",
                buttonImage: "{{ URL::to('/') }}/assets/icons/calendar.svg",
                buttonText: "Select Date",
                showOn: "both",
                currentText: "Clear",

                // * Displaying the selected date to the corresponding input field
                onSelect: function(date) {                                               
                    const currentDate = new Date(date);
            
                    const options = { 
                        weekday:"long", day:"numeric", year:"numeric", month:"long"
                    } // "Monday, July 24, 2023"
                    
                    const newDateFormat = currentDate.toLocaleDateString('en-us', options)                 
                    const removeStringCommas = newDateFormat.replace(/,/g, '');
                    const array = removeStringCommas.split(" ")
                    let weekday = array[0]
                    let month = array[1]
                    let day = array[2]
                    let year = array[3]
                    
                    let dayAndWeekday = day + " " + "(" + weekday + ")"
                    // console.log(newDateFormat);
                    // console.log(dayAndWeekday);

                    const monthInputField = document.getElementById('formHolidayMonth')
                    monthInputField.value = month

                    const dayInputField = document.getElementById('formHolidayDay')
                    dayInputField.value = dayAndWeekday

                    const yearInputField = document.getElementById('formHolidayYear')
                    yearInputField.value = year

                    @this.call('setDate', date, month, dayAndWeekday, year);

                },

            });

            window.showDialog = function($mid){              
                @this.call('showDialog', $mid);        
            };

            window.archive = function($mid){
                @this.call('archive', $mid);       
            };
    })
</script>