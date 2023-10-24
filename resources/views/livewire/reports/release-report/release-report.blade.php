<div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script> 
    <!-- * Filter Modal -->
    <dialog class="am-filter-modal" data-filter-member-modal>

        <div class="modal-container">

            <!-- * Modal Header and Exit Button -->
            <div class="modal-header">
                <h4>Filter</h4>
                <button class="exit-button" data-close-filter-member-modal>
                    <img src="../../res/assets/icons/x-circle.svg" alt="exit">
                </button>
            </div>

            <!-- * Current Loan -->
            <div class="rowspan">

                <div class="input-wrapper-modal">
                    <span>Current Loan</span>
                    <input autocomplete="off" type="number" id="filterCurrentLoanFrom" name="filterCurrentLoanFrom" placeholder="From">
                </div>

                <div class="input-wrapper-modal">
                    <input autocomplete="off" type="number" id="filterCurrentLoanTo" name="filterCurrentLoanTo" placeholder="To">
                </div>

            </div>

            <!-- * Outstanding Balance -->
            <div class="rowspan">

                <div class="input-wrapper-modal">
                    <span>Outstanding Balance</span>
                    <input autocomplete="off" type="number" id="filterOutstandingBal" name="filterOutstandingBal">
                </div>

            </div>

            <!-- * Save Button -->
            <div class="rowspan">
                <button class="button" data-save-filter-member-modal>Save</button>
            </div>

        </div>

        </dialog>
        <div class="reports-container">
        <div class="report-inner-container-2">
            <div class="header-wrapper">
                <div class="inner-wrapper date-picker">
                    <h2>Release Reports</h2>
                    <input type="button" class="ui-datepicker-trigger" id="startDate" value="Start Date"></input>
                    <input type="button" class="ui-datepicker-trigger" id="endDate" value="End Date"></input>
                </div>
                <!-- * Print and Export Buttons -->
                <div class="inner-wrapper">
                    <button class="button-2" data-print-button>Print</button>
                    <button class="button-2" data-export-button>Export</button>
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

                                <!-- * Application Reference -->
                                <th><span class="th-name">Application Reference</span></th>

                                <!-- * Member Name -->
                                <th><span class="th-name">Member Name</span></th>

                                <!-- * Co Borrower -->
                                <th>
                                    <span class="th-name">Co Borrower</span>
                                </th>

                                <!-- * Area -->
                                <th>
                                    <span class="th-name">Area</span>
                                </th>

                                <!-- * Loan Type -->
                                <th>
                                    <span class="th-name">Loan Type</span> 
                                </th>

                                <!-- * Loan Amount -->
                                <th>
                                    <span class="th-name">Loan Amount</span> 
                                </th>

                                <!-- * Advance Payment -->
                                <th>
                                    <span class="th-name">Advance Payment</span> 
                                </th>

                                <!-- * Terms -->
                                <th>
                                    <span class="th-name">Terms</span> 
                                </th>

                                <!-- * Due Date -->
                                <th>
                                    <span class="th-name">Due Date</span> 
                                </th>

                                <!-- * Date Date Released -->
                                <th>
                                    <span class="th-name">Date Date Released</span> 
                                </th>

                            </tr>

                            <!-- * Release Data -->
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            <tr>

                                <!-- * Application Reference -->
                                <td><span class="td-name">00000001</span></td>

                                <!-- * Member Name -->
                                <td><span class="td-name">Mario Magsakay</span></td>

                                <!-- * Co Borrower -->
                                <td>
                                    <span class="td-name">John Doe</span>
                                </td>

                                <!-- * Area -->
                                <td>
                                    <span class="td-name">Area 1</span>
                                </td>

                                <!-- * Loan Type -->
                                <td>
                                    <span class="td-name">Group Loan</span> 
                                </td>

                                <!-- * Loan Amount -->
                                <td>
                                    <span class="td-name">800.00</span> 
                                </td>

                                <!-- * Advance Payment -->
                                <td>
                                    <span class="td-name">500.00</span> 
                                </td>

                                <!-- * Terms -->
                                <td>
                                    <span class="td-name">Terms...</span> 
                                </td>

                                <!-- * Due Date -->
                                <td>
                                    <span class="td-name">08/10/23</span> 
                                </td>

                                <!-- * Date Date Released -->
                                <td>
                                    <span class="td-name">07/10/23</span> 
                                </td>

                            </tr>
                            

                        </table>
                    
                    </div>

                    <!-- * Total Collection Footer -->
                    <!-- <div class="total-collection-footer">
                        <div class="footer-wrapper">
                            <p>Total Collection:</p> 
                            <span id="">1,231.00</span>
                        </div>
                    </div> -->

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