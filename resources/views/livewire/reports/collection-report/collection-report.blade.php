<div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script> 
    
    <div class="reports-container">
    <div class="report-inner-container-2">
            <div class="header-wrapper">
                <div class="inner-wrapper date-picker">
                    <h2>Collection Report</h2>                                      
                </div>
                <!-- * Print and Export Buttons -->
                <div class="inner-wrapper">
                    <button class="button-2" data-print-button>Print</button>
                    <button class="button-2" data-export-button>Export</button>
                </div>
            </div>
            <div class="header-wrapper" style="padding-top: 3rem;">
                <div class="inner-wrapper date-picker">                                 
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date Start</span>
                        <input type="date" wire:model.lazy="datestart" class="">
                        @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
                    </div>
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date End</span>
                        <input type="date" wire:model.lazy="dateend" class="">
                        @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
                    </div>                                     
                </div>              
            </div>
        <div class="body-wrapper">
            <!-- * Container: Reports Table -->
            <div class="reports-table-container">

                <!-- * Table Container -->
                <div class="table-container">

                    <!-- * Collection Table -->
                    <table>

                        <!-- * Table Header -->
                        <tr>

                            <!-- * Checkbox ALl-->
                            <!-- <th><input type="checkbox" class="checkbox" data-select-all-checkbox></th> -->

                            <!-- * Area -->
                            <th><span class="th-name">Area</span></th>

                            <!-- * Field Officer -->
                            <th><span class="th-name">Field Officer</span></th>

                            <!-- * Total Collection -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Collection</span>
                            </th>

                            <!-- * Total Savings -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Savings</span>
                            </th>

                            <!-- * Total Lapses -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Lapses</span> 
                            </th>

                            <!-- * Total Advance -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Advance</span> 
                            </th>

                            <!-- * Cash Remit -->
                            <th style="text-align: right;">
                                <span class="th-name">Cash Remit</span> 
                            </th>

                            <!-- * Total NP -->
                            <th style="text-align: center;">
                                <span class="th-name">Total NP</span> 
                            </th>

                        </tr>

                        <!-- * All Members Data -->
                            @if($res)
                                @foreach($res as $data)
                                <tr>

                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ $data['areaName'] }}</span></td>

                                    <td><span class="td-name">{{ $data['fieldOfficer'] }}</span></td>
                                
                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalCollection']) ? number_format($data['totalCollection'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalSavings']) ? number_format($data['totalSavings'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalLapses']) ? number_format($data['totalLapses'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalAdvance']) ? number_format($data['totalAdvance'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['cashRemit']) ? number_format($data['cashRemit'], 2) : '0.00' }}</span>
                                    </td>

                                    <td  style="text-align: center;">
                                        <span class="td-name">{{ !empty($data['totalNP']) ? $data['totalNP'] : 0 }}</span>
                                    </td>

                                </tr>
                                @endforeach
                            @endif

                    </table>
                
                </div>

                <!-- * Total Collection Footer -->
                <div class="total-collection-footer">
                    <div class="footer-wrapper">
                        <p>Total Collection:</p> 
                        <span id="">{{ number_format($res->sum('totalCollection'), 2) }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
</div>
<script>
    $( () => {	
        $( "#datepicker" ).datepicker({	
            showButtonPanel: true,
            // format: "MM, d DD, yy",
            // formatSubmit: "MM, d DD, yy",
            buttonImage: "/res/assets/icons/calendar.svg",
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

            },

        });
        
        $( "#startDate" ).datepicker({
            showButtonPanel: true,
            // format: "MM, d DD, yy",
            // formatSubmit: "MM, d DD, yy",
            // buttonImage: "/res/assets/icons/calendar.svg",
            // buttonText: "Start Date",
            // showOn: "both",
            currentText: "Clear",
            onSelect: function( selectedDate ) {
                $( "#endDate" ).datepicker({
                    minDate: selectedDate
                });
            }
        });
        
        $( "#endDate" ).datepicker({
            showButtonPanel: true,
            // format: "MM, d DD, yy",
            // formatSubmit: "MM, d DD, yy",
            // buttonImage: "/res/assets/icons/calendar.svg",
            // buttonText: "End Date",
            // showOn: "both",
            currentText: "Clear",
            onSelect: function( selectedDate ) {
                $( "#startDate" ).datepicker({
                    maxDate: selectedDate
                });
            }
        });
        
    } );
</script>