<div >       
    <!-- * New-Application-Form-Container -->
    <form action="" class="na-form-con" autocomplete="off" >

    <!-- * New Application Progress Bar Container -->
    <div class="na-progress-bar-container">
        <div class="progress-bar-level">

            <!-- * New Application Registration Level 1 -->
            <div class="level level1 active">
                <span>Registration</span>
            </div>

            <!-- * New Application Credit Investigation Level 2 -->
            <div class="line" data-level-2></div>
            <div class="level" data-level-2>
                <span>Credit<br>Investigation</span>
            </div>

            <!-- * New Application Approval Level 3 -->
            <div class="line line3"></div>
            <div class="level level3">
                <span>Approval</span>
            </div>

            <!-- * New Application Releasing Level 4 -->
            <div class="line line3"></div>
            <div class="level level4">
                <span>Releasing</span>
            </div>

        </div>
    </div>

    <!-- * New Application Container Wrapper -->
    <div class="na-container-wrapper">

        <!-- * Container 1: Borrower New Application Form Fields and Buttons -->
        <div class="na-container-1">

            <!-- * Big Container -->
            <div class="big-con">

                <!-- * Form Header -->

                <!-- * Rowspan 1: Rowspan Header: Header and Buttons -->
                <div class="rowspan">

                    <!-- * Header Wrapper -->
                    <div class="header-wrapper">
                        <h2>Borrower Information</h2>
                        <button type="button" id="data-open-loan-details">View loan & payment history</button>
                    </div>

                    <!-- * Buttons -->
                    <div class="btn-wrapper">

                        <!-- * Save -->
                        <button wire:click="store" type="button" id="saveBtn" class="button" data-save>Save</button>

                        <!-- * Save & Apply for loan  -->
                        <a href="new-application-credit-investigation.html">
                            <button type="button" id="proceedToCI" class="button" onclick="activeProgressButton()" data-proceed-to-ci>Save & Proceed to CI</button>
                        </a>

                    </div>

                </div>

                <!-- * Rowspan 2: First Name, Middle Name , Last Name, and Suffix -->
                <div class="rowspan">

                    <!-- * First Name -->
                    <div class="input-wrapper">
                        <span>First Name</span>
                        <input wire:model.defer="member.Fname" autocomplete="off" type="text" id="fName" name="fName">
                        @error('member.Fname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Middle Name -->
                    <div class="input-wrapper">
                        <span>Middle Name</span>
                        <input wire:model.defer="member.Mname" autocomplete="off" type="text" id="midName" name="midName">
                        @error('member.Mname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Last Name -->
                    <div class="input-wrapper">
                        <span>Last Name</span>
                        <input wire:model.defer="member.Lname"  autocomplete="off" type="text" id="lName" name="lName">
                        @error('member.Lname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Suffix -->
                    <div class="input-wrapper">
                        <span>Suffix</span>
                        <input wire:model.defer="member.Suffix" autocomplete="off" type="text" id="suffix" name="suffix">
                    </div>

                </div>

                <!-- * Rowspan 3: Gender, Date Of Birth, Age, Place Of Birth and Civil Status -->
                <div class="rowspan">

                    <!-- * Gender -->
                    <div class="input-wrapper">
                        <span>Gender</span>
                        <div class="select-box">
                          
                            <div class="options-container" data-option-con1>

                                <div class="option"  data-option-item1>

                                    <input type="radio"  wire:model.defer="member.Gender" class="radio" id="Male" name="category" value="Male" />
                                    <label for="Male">
                                        <h4>Male</h4>
                                    </label>

                                </div>

                                <div class="option"  data-option-item1>

                                    <input type="radio" wire:model.defer="member.Gender" class="radio"   id="Female" name="category" value="Female"/>
                                    <label for="Female">
                                        <h4>Female</h4>
                                    </label>

                                </div>

                            </div>
                            
                            <div class="selected" style="font-weight: bold;" data-option-select1>
                                {{ isset($member['Gender']) ? $member['Gender'] : '' }}
                            </div>

                        </div>
                        @error('member.Gender') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Date Of Birth -->
                    <div class="input-wrapper">
                        <span>Date Of Birth</span>
                        <input wire:model.defer="member.DOB" autocomplete="off" type="text" id="doBirth" name="doBirth">
                        @error('member.DOB') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Age -->
                    <div class="input-wrapper">
                        <span>Age</span>
                        <input wire:model.defer="member.Age" autocomplete="off" type="number" id="age" name="age">
                        @error('member.Age') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Place Of Birth -->
                    <div class="input-wrapper">
                        <span>Place Of Birth</span>
                        <input wire:model.defer="member.POB" autocomplete="off" type="text" id="poBirth" name="poBirth">
                        @error('member.POB') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Civil Status -->
                    <div class="input-wrapper">
                        <span>Civil Status {{ isset($member['Civil_Status']) ? $member['Civil_Status'] : '' }}</span>
                        <div class="select-box">

                            <div class="options-container" data-option-con2>

                                <div class="option" data-option-item2>

                                    <input wire:model.defer="member.Civil_Status" type="radio" class="radio" name="category" id="Widow" value="Widow" />
                                    <label for="Widow">
                                        <h4>Widow</h4>
                                    </label>

                                </div>

                                <div class="option" data-option-item2>

                                    <input wire:model.defer="member.Civil_Status" type="radio" class="radio" name="category" id="Married" value="Married"/>
                                    <label for="Married">
                                        <h4>Married</h4>
                                    </label>

                                </div>

                                <div class="option" data-option-item2>

                                    <input wire:model.defer="member.Civil_Status" type="radio" class="radio" name="category" id="Single" value="Single"/>
                                    <label for="Single">
                                        <h4>Single</h4>
                                    </label>

                                </div>

                            </div>
                            
                            <div class="selected" style="font-weight: bold;" data-option-select2>
                                {{ isset($member['Civil_Status']) ? $member['Civil_Status'] : '' }}
                            </div>

                        </div>
                        @error('member.Civil_Status') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                </div>

                <!-- * Rowspan 4: Contact Number and Email Address -->
                <div class="rowspan">

                    <!-- * Contact Number -->
                    <div class="input-wrapper">
                        <div class="input-wrapper">
                            <span>Contact Number</span>
                            <input wire:model.defer="member.Cno" autocomplete="off" type="number" id="conNum" name="conNum">
                            @error('member.Cno') <span class="text-required">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <!-- * Email Address -->
                    <div class="input-wrapper">
                        <div class="input-wrapper">
                            <span>Email Address</span>
                            <input wire:model.defer="member.EmailAddress" autocomplete="off" type="email" id="eMail" name="eMail">
                            @error('member.EmailAddress') <span class="text-required">{{ $message }}</span>@enderror
                        </div>
                    </div>

                </div>

                <!-- * Rowspan 5: Rented, Owned, Free of Use Radio Buttons and House Address-->
                <div class="rowspan">

                    <!-- * Rented, Owned, and Free of Use Radio Buttons -->
                    <div class="input-wrapper">

                        <div class="box-wrap">

                            <!-- * Rented -->
                            <div class="radio-btn-wrapper">
                                <span>Rented</span>
                                <input  wire:model.defer="member.House_Stats" autocomplete="off" type="radio" name="radio" value="rented" id="rented">
                            </div>

                            <!-- * Owned -->
                            <div class="radio-btn-wrapper">
                                <span>Owned</span>
                                <input  wire:model.defer="member.House_Stats" autocomplete="off" type="radio" name="radio" value="owned" id="owned">
                            </div>

                            <!-- * Free Use -->
                            <div class="radio-btn-wrapper">
                                <span>Free Use</span>
                                <input  wire:model.defer="member.House_Stats" autocomplete="off" type="radio" name="radio" value="freeUse" id="freeUse">
                            </div>

                        </div>
                        @error('member.House_Stats') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * House No./ Bldg. No./ Room No./ Subdivision/ Street -->
                    <div class="input-wrapper">
                        <span>House No./ Bldg. No./ Room No./ Subdivision/ Street</span>
                        <input wire:model.defer="member.HouseNo" autocomplete="off" type="text" id="houseAdd" name="houseAdd">
                        @error('member.HouseNo') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                </div>

                <!-- * Rowspan 6: Barangay, City / Municipality, Province / Region, and Country -->
                <div class="rowspan">

                    <!-- * Barangay -->
                    <div class="input-wrapper">
                        <span>Barangay</span>
                        <input wire:model.defer="member.Barangay" autocomplete="off" type="text" id="brgy" name="brgy">
                        @error('member.Barangay') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * City / Municipality -->
                    <div class="input-wrapper">
                        <span>City / Municipality</span>
                        <input wire:model.defer="member.City" autocomplete="off" type="text" id="city" name="city">
                        @error('member.City') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Province / Region -->
                    <div class="input-wrapper">
                        <span>Province / Region</span>
                        <input wire:model.defer="member.Province" autocomplete="off" type="text" id="province" name="province">
                        @error('member.Province') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Country -->
                    <div class="input-wrapper">
                        <span>Country</span>
                        <input wire:model.defer="member.Country" autocomplete="off" type="text" id="country" name="country">
                        @error('member.Country') <span class="text-required">{{ $message }}</span>@enderror
                    </div>


                </div>

                <!-- * Rowspan 7: Zip Code and Years Of Stay -->
                <div class="rowspan">

                    <!-- * Zip Code -->
                    <div class="input-wrapper">
                        <span>Zip Code</span>
                        <input wire:model.defer="member.ZipCode" type="number" id="zipCode" name="zipCode">
                    </div>

                    <!-- * Years Of Stay -->
                    <div class="input-wrapper">
                        <span>Years of stay on the mentioned address</span>
                        <input wire:model.defer="member.YearsStay" type="number" id="yoStay" name="yoStay">
                        @error('member.YearsStay') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                </div>

                <!-- * Rowspan 8: Empty Rowspan -->
                <div class="rowspan">

                </div>
            </div>
        </div>

        <!-- * Container 2: Upload Images, Files and Monthly Bills Input Fields -->
        <div class="na-container-2">

            <!-- * Small Container -->
            <div class="small-con">

                <div class="box-wrap">

                    <!-- * Colspan 1: Upload Image and Attach Files Buttons  -->
                    <div class="colspan">

                        <!-- * Upload Image -->
                        <div class="input-wrapper">
                            <input type="image" src="../res/assets/icons/upload-image.svg" alt="upload-image">
                        </div>

                        <!-- * Upload Button -->
                        <button type="button" submit="" class="button">Upload Image</button>

                        <!-- * Attach Button -->
                        <button type="button" submit="" class="button">Attach Files</button>

                    </div>

                </div>

                <div class="box-wrap">

                    <!-- * Colspan 2: Monthly Bills - Electricity Bill, Water Bill, and Daily Expenses -->
                    <div class="colspan">

                        <h3>Monthly Bills <span>(Estimated):</span></h3>

                        <!-- * Electricity Bill -->
                        <div class="input-wrapper">
                            <span>Electricity Bill</span>
                            <input type="number" id="elecBill" name="elecBill">
                        </div>

                        <!-- * Water Bill -->
                        <div class="input-wrapper">
                            <span>Water Bill</span>
                            <input type="number" id="waterBill" name="waterBill">
                        </div>

                        <!-- * Other Bills -->
                        <div class="input-wrapper">
                            <span>Other Bills</span>
                            <input type="number" id="otherBill" name="otherBill">
                        </div>

                        <!-- * Daily Expenses -->
                        <div class="input-wrapper">
                            <span>Daily Expenses</span>
                            <input type="number" id="dailyExp" name="dailyExp">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- * New Application Loan Details Modal -->
    <dialog class="na-loan-details-modal" data-loan-details-modal>

        <!-- * Modal Container -->
        <div class="modal-container">

            <!-- * Button Wrapper -->
            <div class="button-wrapper">
                <button type="button" id="data-close-loan-details">
                    <img src="../res/assets/icons/x-circle.svg" alt="close">
                </button>
            </div>

            <!-- * Container 11: Loan History Table -->
            <div class="na-container-8">

                <!-- * Small Container -->
                <div class="small-con-5">

                    <!-- * Rowspan 1: Header -->
                    <div class="rowspan">

                        <!-- * Loan History -->
                        <div class="input-wrapper">
                            <h2>Loan History</h2>
                        </div>

                    </div>

                    <!-- * Rowspan 2: Loan History Table -->
                    <div class="rowspan">

                        <table>
                            <tr>
                                <th>Loan Amount</th>
                                <th>Savings</th>
                                <th>Penalty</th>
                                <th>Outstanding Balance</th>
                                <th>Date Released</th>
                                <th>Due Date</th>
                                <th>Due Date</th>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                                <td>Lorem ipsum dolor sit.</td>
                            </tr>
                            

                        </table>


                    </div>

                </div>



            </div>

            <!-- * Container 10: Payment History Table -->
            <div class="na-container-7">

                <!-- * Small Container -->
                <div class="small-con-4">

                    <!-- * Rowspan 1: Header -->
                    <div class="rowspan">

                        <!-- * Payment History -->
                        <div class="input-wrapper">
                            <h2>Payment History</h2>
                        </div>

                    </div>

                    <!-- * Rowspan 2: Payment History Table -->
                    <div class="rowspan">

                        <table>
                            <tr>
                                <th>Loan Amount</th>
                                <th>Outstanding Balance</th>
                                <th>Paid Amount</th>
                                <th>Collector</th>
                                <th>Payment Date</th>
                                <th>Payment Type</th>
                                <th>Penalty</th>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                            </tr>
                            
                            

                        </table>


                    </div>

                </div>



            </div>

        </div>


    </dialog>

    <!-- * Container 3: Job Information Input Fields -->
    <div class="na-container-3">

        <!-- * Small Container -->
        <div class="small-con-2">

            <!-- * Rowspan 1: Header -->
            <div class="rowspan">

                <!-- * Job Information -->
                <div class="input-wrapper">
                    <h2>Job Information</h2>
                    <span>(Borrower)</span>
                </div>

            </div>

            <!-- * Rowspan 2: Employment Status, Current Job / Position, Years Of Service and Company Name -->
            <div class="rowspan">
                <!-- * Employment Status -->
                <div class="input-wrapper">
                    <span>Employment Status</span>
                    <div class="select-box">

                        <div class="options-container" data-option-con3>

                            <div class="option" data-option-item3>

                                <input type="radio" class="radio" name="category" value="Employed" />
                                <label for="Employed">
                                    <h4>Employed</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item3>

                                <input type="radio" class="radio" name="category" value="Unemployed"/>
                                <label for="Unemployed">
                                    <h4>Unemployed</h4>
                                </label>

                            </div>

                        </div>
                        
                        <div class="selected" data-option-select3>
                        </div>

                    </div>
                </div>

                <!-- * Current Job / Position -->
                <div class="input-wrapper">

                    <!-- * Current Job -->
                    <span data-current-job>Current Job / Position</span>
                    <input type="text" id="currentJob" name="currentJob" data-current-job>

                    <!-- * Previous Job -->
                    <span data-previous-job>Previous Job / Position</span>
                    <input type="text" id="previousJob" name="previousJob" data-previous-job>

                </div>

                <!-- * Years Of Service -->
                <div class="input-wrapper">
                    <span>Years Of Service</span>
                    <input type="text" id="yoService" name="yoService">
                </div>

                <!-- * Company Name -->
                <div class="input-wrapper">
                    <span>Company Name</span>
                    <input type="text" id="compName" name="compName">
                </div>

            </div>

            <!-- * Rowspan 3: Company Address, Monthly Salary, Other Source of Income, and Do you own a Business?  -->
            <div class="rowspan">

                <!-- * Company Address -->
                <div class="input-wrapper">
                    <span>Company Address</span>
                    <input type="text" id="compAddr" name="compAddr">
                </div>

                <!-- * Monthly Salary -->
                <div class="input-wrapper">
                    <span>Monthly Salary</span>
                    <input type="number" id="monthSal" name="monthSal">
                </div>

                <!-- * Other Source Of Income -->
                <div class="input-wrapper">
                    <span>Other Source Of Income</span>
                    <input type="text" id="othSorOfInc" name="othSorOfInc">
                </div>

                <!-- * Do you own a Business?  -->
                <div class="input-wrapper">
                    <span>Do you own a Business?</span>

                    <!-- * Form Toggle -->

                    <div class="box-wrap">

                        <!-- * Rented -->
                        <div class="radio-btn-wrapper">
                            <input autocomplete="off" type="radio" name="formToggle" value="formToggleYes" id="formToggleYes">
                            <span>Yes</span>
                        </div>

                        <!-- * Owned -->
                        <div class="radio-btn-wrapper">
                            <input autocomplete="off" type="radio" name="formToggle" value="formToggleNo" id="formToggleNo">
                            <span>No</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- * Imported from New Member Application -->
    <!-- * Container 4(a): Family Background Information (Married)-->
    <div class="nm-container-4" data-family-background-married >

        <!-- * Small Container -->
        <div class="small-con-3" data-child-container>

            <!-- * Rowspan 1: Header -->
            <div class="rowspan">

                <!-- * Family Background Information -->
                <div class="input-wrapper">
                    <h2>Family Background Information</h2>
                </div>

            </div>

            <!-- * Rowspan 2: Subheader - Spouse Information -->
            <div class="rowspan">

                <!-- * Family Background Information -->
                <div class="input-wrapper">
                    <h3>Spouse Information</h3>
                </div>

            </div>

            <!-- * Rowspan 3: First Name, Middle Name, Last Name, Suffix, Date Of Birth and Age -->
            <div class="rowspan">

                <!-- * First Name -->
                <div class="input-wrapper">
                    <span>First Name</span>
                    <input autocomplete="off" type="text" id="fName" name="fName">
                </div>

                <!-- * Middle Name -->
                <div class="input-wrapper">
                    <span>Middle Name</span>
                    <input autocomplete="off" type="text" id="midName" name="midName">
                </div>

                <!-- * Last Name -->
                <div class="input-wrapper">
                    <span>Last Name</span>
                    <input autocomplete="off" type="text" id="lName" name="lName">
                </div>

                <!-- * Suffix -->
                <div class="input-wrapper">
                    <span>Suffix</span>
                    <input autocomplete="off" type="text" id="suffix" name="suffix">
                </div>


                <!-- * Date Of Birth -->
                <div class="input-wrapper">
                    <span>Date Of Birth</span>
                    <input autocomplete="off" type="text" id="doBirth" name="doBirth">
                </div>

                <!-- * Age -->
                <div class="input-wrapper">
                    <span>Age</span>
                    <input autocomplete="off" type="number" id="age" name="age">
                </div>

            </div>

            <!-- * Rowspan 4: Employment Status, Current Job / Position, Years Of Service and Company Name -->
            <div class="rowspan">

                <!-- * Employment Status -->
                <div class="input-wrapper">
                    <span>Employment Status</span>
                    <div class="select-box">

                        <div class="options-container" data-option-con7>

                            <div class="option" data-option-item7>

                                <input type="radio" class="radio" name="category" value="Employed" />
                                <label for="Employed">
                                    <h4>Employed</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item7>

                                <input type="radio" class="radio" name="category" value="Unemployed"/>
                                <label for="Unemployed">
                                    <h4>Unemployed</h4>
                                </label>

                            </div>

                        </div>
                        
                        <div class="selected" data-option-select7>
                        </div>

                    </div>
                </div>

                <!-- * Current Job / Position -->
                <div class="input-wrapper">

                    <!-- * Current Job -->
                    <span data-spouse-current-job>Current Job / Position</span>
                    <input type="text" id="currentJob" name="currentJob" data-spouse-current-job>

                    <!-- * Previous Job -->
                    <span data-spouse-previous-job>Previous Job / Position</span>
                    <input type="text" id="previousJob" name="previousJob" data-spouse-previous-job>

                </div>

                <!-- * Years Of Service -->
                <div class="input-wrapper">
                    <span>Years Of Service</span>
                    <input type="text" id="yoService" name="yoService">
                </div>

                <!-- * Company Name -->
                <div class="input-wrapper">
                    <span>Company Name</span>
                    <input type="text" id="compName" name="compName">
                </div>

                <!-- * Empty Input Wrapper -->
                <div class="input-wrapper">
                </div>

            </div>

            <!-- * Rowspan 5: Number Of Dependants -->
            <div class="rowspan">

                <!-- * Current Job / Position -->
                <div class="input-wrapper">
                    <span>Number Of Dependants</span>
                    <input type="number" id="numOfDependants" name="numOfDependants">
                </div>

            </div>

            <!-- * Rowspan 6: Empty Rowspan -->
            <div class="rowspan">

            </div>

            <!-- * Rowspan 7: Subheader - Children(s) Information -->
            <div class="rowspan" data-child-sibling>

                <!-- * Family Background Information -->
                <div class="input-wrapper">
                    <h3>Children(s) Information</h3>
                </div>

            </div>

            <!-- * Rowspan 8: First Name, Middle Name , Last Name, Age, Name Of School and Add/Subtract Button -->
            <div class="rowspan child" data-child>

                <!-- * First Name -->
                <div class="input-wrapper">
                    <span>First Name</span>
                    <input autocomplete="off" type="text" id="childFName" name="fName">
                </div>

                <!-- * Middle Name -->
                <div class="input-wrapper">
                    <span>Middle Name</span>
                    <input autocomplete="off" type="text" id="childMidName" name="midName">
                </div>

                <!-- * Last Name -->
                <div class="input-wrapper">
                    <span>Last Name</span>
                    <input autocomplete="off" type="text" id="childLName" name="lName">
                </div>

                <!-- * Age -->
                <div class="input-wrapper">
                    <span>Age</span>
                    <input autocomplete="off" type="number" id="childAge" name="age">
                </div>

                <!-- * Name Of School -->
                <div class="input-wrapper">
                    <span>Name Of School</span>
                    <input autocomplete="off" type="text" id="nameOfSchool" name="nameOfSchool">
                </div>

                <!-- * Add and Subtract Button  -->
                <div class="input-wrapper">
                    <button type="button" onclick="addChild()">+</button>
                    <button type="button" onclick="subChild()">-</button>
                </div>

            </div>

        </div>

    </div>

    <!-- * Container 4(b): Family Background Information (Single)-->
    <div class="nm-container-4" data-family-background-single  >

        <!-- * Small Container -->
        <div class="small-con-3" data-child-container-2>

            <!-- * Rowspan 1: Header -->
            <div class="rowspan">

                <!-- * Family Background Information -->
                <div class="input-wrapper">
                    <h2>Family Background Information</h2>
                </div>

            </div>

            <!-- * Rowspan 2: Subheader - First degree relative information -->
            <div class="rowspan">

                <!-- * Family Background Information -->
                <div class="input-wrapper">
                    <h3>First degree relative information</h3>
                </div>

            </div>

            <!-- * Rowspan 3: First Name, Middle Name, Last Name, Suffix, Date Of Birth and Age -->
            <div class="rowspan">

                <!-- * First Name -->
                <div class="input-wrapper">
                    <span>First Name</span>
                    <input autocomplete="off" type="text" id="fName" name="fName">
                </div>

                <!-- * Middle Name -->
                <div class="input-wrapper">
                    <span>Middle Name</span>
                    <input autocomplete="off" type="text" id="midName" name="midName">
                </div>

                <!-- * Last Name -->
                <div class="input-wrapper">
                    <span>Last Name</span>
                    <input autocomplete="off" type="text" id="lName" name="lName">
                </div>

                <!-- * Suffix -->
                <div class="input-wrapper">
                    <span>Suffix</span>
                    <input autocomplete="off" type="text" id="suffix" name="suffix">
                </div>


                <!-- * Date Of Birth -->
                <div class="input-wrapper">
                    <span>Date Of Birth</span>
                    <input autocomplete="off" type="text" id="doBirth" name="doBirth">
                </div>

                <!-- * Age -->
                <div class="input-wrapper">
                    <span>Age</span>
                    <input autocomplete="off" type="number" id="age" name="age">
                </div>

            </div>

            <!-- * Rowspan 4: Employment Status, Current Job / Position, Years Of Service and Company Name -->
            <div class="rowspan">

                <!-- * Employment Status -->
                <div class="input-wrapper">
                    <span>Employment Status</span>
                    <div class="select-box">

                        <div class="options-container" data-option-con8>

                            <div class="option" data-option-item8>

                                <input type="radio" class="radio" name="category" value="Employed" />
                                <label for="Employed">
                                    <h4>Employed</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item8>

                                <input type="radio" class="radio" name="category" value="Unemployed"/>
                                <label for="Unemployed">
                                    <h4>Unemployed</h4>
                                </label>

                            </div>

                        </div>
                        
                        <div class="selected" data-option-select8>
                        </div>

                    </div>
                </div>


                <!-- * Current Job / Position -->
                <div class="input-wrapper">

                    <!-- * Current Job -->
                    <span data-fdr-current-job>Current Job / Position</span>
                    <input type="text" id="fdrCurrentJob" name="currentJob" data-fdr-current-job>

                    <!-- * Previous Job -->
                    <span data-fdr-previous-job>Previous Job / Position</span>
                    <input type="text" id="fdrPreviousJob" name="previousJob" data-fdr-previous-job>

                </div>

                <!-- * Years Of Service -->
                <div class="input-wrapper">
                    <span>Years Of Service</span>
                    <input type="text" id="yoService" name="yoService">
                </div>

                <!-- * Company Name -->
                <div class="input-wrapper">
                    <span>Company Name</span>
                    <input type="text" id="compName" name="compName">
                </div>

                <!-- * Empty Input Wrapper -->
                <div class="input-wrapper">
                </div>

            </div>

            <!-- * Rowspan 5: Number Of Dependants -->
            <div class="rowspan">

                <!-- * Number Of Dependants -->
                <div class="input-wrapper">
                    <span>Number Of Dependants</span>
                    <input type="number" id="numOfDependants" name="numOfDependants">
                </div>

            </div>

            <!-- * Rowspan 6: Empty Rowspan -->
            <div class="rowspan">

            </div>

            <!-- * Rowspan 7: Subheader - Children(s) Information -->
            <div class="rowspan">

                <!-- * Family Background Information -->
                <div class="input-wrapper">
                    <h3>Children(s) Information</h3>
                </div>

            </div>

            <!-- * Rowspan 8: First Name, Middle Name , Last Name, Age, Name Of School and Add/Subtract Button -->
            <div class="rowspan child" data-child-2>

                <!-- * First Name -->
                <div class="input-wrapper">
                    <span>First Name</span>
                    <input autocomplete="off" type="text" id="fName" name="fName">
                </div>

                <!-- * Middle Name -->
                <div class="input-wrapper">
                    <span>Middle Name</span>
                    <input autocomplete="off" type="text" id="midName" name="midName">
                </div>

                <!-- * Last Name -->
                <div class="input-wrapper">
                    <span>Last Name</span>
                    <input autocomplete="off" type="text" id="lName" name="lName">
                </div>

                <!-- * Age -->
                <div class="input-wrapper">
                    <span>Age</span>
                    <input autocomplete="off" type="number" id="age" name="age">
                </div>

                <!-- * Name Of School -->
                <div class="input-wrapper">
                    <span>Name Of School</span>
                    <input autocomplete="off" type="text" id="nameOfSchool" name="nameOfSchool">
                </div>

                <!-- * Add and Subtract Button  -->
                <div class="input-wrapper">
                    <button type="button" onclick="addChildSingle()">+</button>
                    <button type="button" onclick="subChildSingle()">-</button>
                </div>


            </div>

        </div>

    </div>

    <!-- * Imported from New Member Application -->
    <!-- * Container 5: Business Information -->
    <div class="nm-container-5" data-business-form>

        <!-- * Small Container -->
        <div class="small-con-4">

            <!-- * Rowspan 1: Header -->
            <div class="rowspan">

                <!-- * Business Information -->
                <div class="input-wrapper">
                    <h2>Business Information</h2>
                </div>

            </div>

            <!-- * Rowspan 2: Business Name, Business Type and Business Address -->
            <div class="rowspan">

                <!-- * Business Name -->
                <div class="input-wrapper">
                    <span>Business Name</span>
                    <input type="text" id="busName" name="busName">
                </div>

                <!-- * Business Type -->
                <div class="input-wrapper">
                    <span>Business Type</span>
                    <input type="text" id="busType" name="busType">
                </div>

                <!-- * Business Address -->
                <div class="input-wrapper">
                    <span>Business Address</span>
                    <input type="text" id="busAddr" name="busAddr">
                </div>

            </div>

            <!-- * Rowspan 3: Rented or Owned, Years Of Business, Number Of Employees, Salary / Day, Value Of Stocks and Amount Of Sales / Day  -->
            <div class="rowspan">

                <div class="input-wrapper">

                    <div class="box-wrap">

                        <!-- * Rented -->
                        <div class="radio-btn-wrapper">
                            <span>Rented</span>
                            <input autocomplete="off" type="radio" name="radio" value="rented" id="rented">
                        </div>

                        <!-- * Owned -->
                        <div class="radio-btn-wrapper">
                            <span>Owned</span>
                            <input autocomplete="off" type="radio" name="radio" value="owned" id="owned">
                        </div>

                    </div>

                </div>

                <!-- * Years Of Business -->
                <div class="input-wrapper">
                    <span>Years Of Business</span>
                    <input type="text" id="yearsOfBus" name="yearsOfBus">
                </div>

                <!-- * Number Of Employees -->
                <div class="input-wrapper">
                    <span>Number Of Employees</span>
                    <input type="number" id="numOfEmploy" name="numOfEmploy">
                </div>

                <!-- * Salary / Day -->
                <div class="input-wrapper">
                    <span>Salary / Day</span>
                    <input type="text" id="salDay" name="salDay">
                </div>

                <!-- * Value Of Stocks -->
                <div class="input-wrapper">
                    <span>Value Of Stocks</span>
                    <input type="number" id="valOfStocks" name="valOfStocks">
                </div>

                <!-- * Amount Of Sales / Day -->
                <div class="input-wrapper">
                    <span>Amount Of Sales / Day</span>
                    <input type="text" id="amtSalDay" name="amtSalDay">
                </div>

            </div>

            <!-- * Rowspan 4: Add Business and Attach Files Buttons -->
            <div class="rowspan">

                <!-- * Buttons -->
                <div class="btn-wrapper">

                    <!-- * Add Business -->
                    <button>Add Business</button>

                    <!-- * Attach Files -->
                    <button>Attach Files</button>

                </div>

            </div>

            <!-- * Rowspan 5: Add Business Table -->
            <div class="rowspan">

                <table>
                    <tr>
                        <th>Business Name</th>
                        <th>Business Type</th>
                        <th>Business Address</th>
                        <th>Years of Business</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>Baskin'</td>
                        <td>Sole Proprietorship</td>
                        <td>Germany</td>
                        <td>2</td>

                        <!-- * Table Edit and Delete Button -->
                        <td class="td-btns">

                            <div class="td-btn-wrapper">
                                <button class="a-btn-edit">Edit</button>
                                <button class="a-btn-delete">Delete</button>
                            </div>

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <!-- * Table Edit and Delete Button -->
                        <td class="td-btns">

                            <!-- <div class="td-btn-wrapper">
                                <button class="a-btn-edit">Edit</button>
                                <button class="a-btn-delete">Delete</button>
                            </div> -->

                        </td>

                    </tr>

                </table>


            </div>

            <!-- * Rowspan 6: Pagination -->
            <div class="rowspan">

                <!-- * Pagination Container -->
                <div class="pagination-container">

                    <!-- * Pagination Links -->
                    <a href="#"><img src="../res/assets/icons/caret-left.svg" alt="caret-left"></a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#"><img src="../res/assets/icons/caret-right.svg" alt="caret-right"></a>

                </div>

            </div>

        </div>

    </div>

    <!-- * Container 6: (Wrapper): Assets and Properties, Appliances and Bank Accounts -->
    <div class="na-container-wrapper-3">

        <!-- * Container 9: Assets and Properties -->
        <div class="na-container-9">

            <!-- * Big Container -->
            <div class="big-con-2">

                <!-- * Form Header -->

                <!-- * Rowspan Container 1: Rowspan Header - Assets and Properties -->
                <div class="rowspan-container">

                    <div class="rowspan">
                        <h2>Assets and Properties</h2>
                    </div>

                </div>

                <!-- * Rowspan Container 2: Do you own motor vehicles? -->
                <div class="rowspan-container">
                    <!-- * Rowspan 2: Do you own motor vehicles? -->
                    <div class="rowspan">

                        <!-- * Do you own motor vehicles? -->
                        <div class="input-wrapper">

                            <span>Do you own motor vehicles?</span>

                            <!-- * Form Toggle -->
                            <div class="box-wrap">

                                <!-- * Yes -->
                                <div class="radio-btn-wrapper">
                                    <input autocomplete="off" type="radio" name="formToggle" value="formToggleYes" id="vehicleFormToggleYes">
                                    <span>Yes</span>
                                </div>

                                <!-- * No -->
                                <div class="radio-btn-wrapper">
                                    <input autocomplete="off" type="radio" name="formToggle" value="formToggleNo" id="vehicleFormToggleNo">
                                    <span>No</span>
                                </div>

                            </div>

                        </div>


                        <!-- * Rowspan 3: Vehicle Input Field -->
                        <div class="box-wrap-2" data-vehicle-container>
                            <div class="input-wrapper" data-vehicle >
                                <span>If yes please specify,</span>

                                <div class="rowspan-2 child">


                                    <!-- * Vehicle Input Field -->
                                    <div class="input-wrapper">
                                        <input autocomplete="off" type="text" id="ownVehicle" name="ownVehicle" value="">
                                    </div>

                                    <!-- * Add and Subtract Button  -->
                                    <div class="input-wrapper">
                                        <button type="button" onclick="addVehicle()">+</button>
                                        <button type="button" onclick="subVehicle()">-</button>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- * Rowspan Container 3: Do you own real property? -->
                <div class="rowspan-container">

                    <!-- * Rowspan 4: Do you own real property? -->
                    <div class="rowspan">

                        <!-- * Do you own real property? -->
                        <div class="input-wrapper">
                            <span>Do you own real property?</span>

                            <!-- * Form Toggle -->

                            <div class="box-wrap">

                                <!-- * Yes -->
                                <div class="radio-btn-wrapper">
                                    <input autocomplete="off" type="radio" name="formToggle" value="formToggleYes" id="propertyFormToggleYes">
                                    <span>Yes</span>
                                </div>

                                <!-- * No -->
                                <div class="radio-btn-wrapper">
                                    <input autocomplete="off" type="radio" name="formToggle" value="formToggleNo" id="propertyFormToggleNo">
                                    <span>No</span>
                                </div>

                            </div>

                        </div>

                        <div class="box-wrap-2" data-property-container>
                            <div class="input-wrapper" data-property>
                                <span>If yes please specify,</span>


                                <!-- * Rowspan 5: Property Input Field -->
                                <div class="rowspan-2 child">

                                    <!-- * Vehicle Input Field -->
                                    <div class="input-wrapper">
                                        <input autocomplete="off" type="text" id="nameOfSchool" name="nameOfSchool">
                                    </div>

                                    <!-- * Add and Subtract Button  -->
                                    <div class="input-wrapper">
                                        <button type="button" onclick="addProperty()">+</button>
                                        <button type="button" onclick="subProperty()">-</button>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>


            </div>


        </div>

        <!-- * Container 10: Appliances and Bank Accounts -->
        <div class="na-container-10">

            <!-- * Small Container -->
            <div class="small-con-6">

                <div class="box-wrap">

                    <!-- * Rowspan 1: Appliances -->
                    <div class="rowspan header">

                        <h2>Appliances</h2>

                    </div>

                    <!-- * Rowspan 2: Appliances and Brand / Model -->
                    <div class="box-wrap-2" data-appliances-container>
                        <div class="rowspan child" data-appliances>

                            <!-- * Appliances -->
                            <div class="input-wrapper">
                                <span>Appliances</span>
                                <input autocomplete="off" type="number" id="appliances" name="appliances">
                            </div>

                            <!-- * Brand / Model -->
                            <div class="input-wrapper">
                                <span>Brand / Model</span>
                                <input autocomplete="off" type="text" id="brandModel" name="brandModel">
                            </div>

                            <!-- * Add and Subtract Button  -->
                            <div class="input-wrapper">
                                <button type="button" onclick="addAppliances()">+</button>
                                <button type="button" onclick="subAppliances()">-</button>
                            </div>


                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="na-container-10">

            <!-- * Small Container -->
            <div class="small-con-6">

                <div class="box-wrap">

                    <!-- * Rowspan 3: Bank Accounts -->
                    <div class="rowspan header">

                        <h2>Bank Accounts</h2>

                    </div>

                    <!-- * Rowspan 4: Bank account and Address -->
                    <div class="box-wrap-2" data-bank-container>
                        <div class="rowspan child" data-bank>

                            <!-- * Bank account -->
                            <div class="input-wrapper">
                                <span>Bank account</span>
                                <input autocomplete="off" type="bankAcc" id="bankAcc" name="appliances">
                            </div>

                            <!-- * Address -->
                            <div class="input-wrapper">
                                <span>Address</span>
                                <input autocomplete="off" type="bankAddr" id="bankAddr" name="brandModel">
                            </div>

                            <!-- * Add and Subtract Button  -->
                            <div class="input-wrapper">
                                <button type="button" onclick="addBank()">+</button>
                                <button type="button" onclick="subBank()">-</button>
                            </div>


                        </div>
                    </div>

                </div>

            </div>

        </div>


    </div>

    <!-- * Container 7: Loan Details Input Fields -->
    <div class="na-container-4">

        <!-- * Small Container -->
        <div class="small-con-3">

            <!-- * Rowspan 1: Header -->
            <div class="rowspan">

                <!-- * Loan Details -->
                <div class="input-wrapper">
                    <h2>Loan Details</h2>
                    <span>Individual Loan</span>
                </div>

            </div>

            <!-- * Rowspan 2: Applied Loan Amount, Terms Of Payment and Purpose -->
            <div class="rowspan">

                <!-- * Applied Loan Amount -->
                <div class="input-wrapper">
                    <span>Applied Loan Amount</span>
                    <input type="text" id="appLoanAmnt" name="appLoanAmnt">
                </div>

                <!-- * Terms Of Payment -->
                <div class="input-wrapper">
                    <span>Terms Of Payment</span>
                    <input type="text" id="top" name="top">
                </div>

                <!-- * Purpose -->
                <div class="input-wrapper">
                    <span>Purpose</span>
                    <input type="text" id="purpose" name="purpose">
                </div>

            </div>

        </div>

    </div>

    <!-- * Container 8: Co-Maker New Application Form Fields -->
    <div class="na-container-wrapper-2">

        <!-- * Container 5: New Application Form Fields and Buttons -->
        <div class="na-container-5">

            <!-- * Container Wrapper -->
            <div class="container-wrapper">

                <!-- * Big Container -->
                <div class="big-con">

                    <!-- * Form Header -->

                    <!-- * Rowspan 1: Rowspan Header - Co-Maker Information -->
                    <div class="rowspan">
                        <h2>Co-Maker Information</h2>
                    </div>

                    <!-- * Rowspan 2: First Name, Middle Name , Last Name, and Suffix -->
                    <div class="rowspan">

                        <!-- * First Name -->
                        <div class="input-wrapper">
                            <span>First Name</span>
                            <input autocomplete="off" type="text" id="fName" name="fName">
                        </div>

                        <!-- * Middle Name -->
                        <div class="input-wrapper">
                            <span>Middle Name</span>
                            <input autocomplete="off" type="text" id="midName" name="midName">
                        </div>

                        <!-- * Last Name -->
                        <div class="input-wrapper">
                            <span>Last Name</span>
                            <input autocomplete="off" type="text" id="lName" name="lName">
                        </div>

                        <!-- * Suffix -->
                        <div class="input-wrapper">
                            <span>Suffix</span>
                            <input autocomplete="off" type="text" id="suffix" name="suffix">
                        </div>

                    </div>

                    <!-- * Rowspan 3: Gender, Date Of Birth, Age, Place Of Birth and Civil Status -->
                    <div class="rowspan">

                        <!-- * Gender -->
                        <div class="input-wrapper">
                            <span>Gender</span>
                            <div class="select-box">

                                <div class="options-container" data-option-con4>

                                    <div class="option"  data-option-item4>

                                        <input type="radio" class="radio" name="category" value="Male" />
                                        <label for="Male">
                                            <h4>Male</h4>
                                        </label>

                                    </div>

                                    <div class="option"  data-option-item4>

                                        <input type="radio" class="radio" name="category" value="Female"/>
                                        <label for="Female">
                                            <h4>Female</h4>
                                        </label>

                                    </div>

                                </div>
                                
                                <div class="selected" data-option-select4>
                                </div>

                            </div>
                        </div>

                        <!-- * Date Of Birth -->
                        <div class="input-wrapper">
                            <span>Date Of Birth</span>
                            <input autocomplete="off" type="text" id="doBirth" name="doBirth">
                        </div>

                        <!-- * Age -->
                        <div class="input-wrapper">
                            <span>Age</span>
                            <input autocomplete="off" type="number" id="age" name="age">
                        </div>

                        <!-- * Place Of Birth -->
                        <div class="input-wrapper">
                            <span>Place Of Birth</span>
                            <input autocomplete="off" type="text" id="poBirth" name="poBirth">
                        </div>

                        <!-- * Civil Status -->
                        <div class="input-wrapper">
                            <span>Civil Status</span>
                            <div class="select-box">

                                <div class="options-container" data-option-con5>

                                    <div class="option" data-option-item5>

                                        <input type="radio" class="radio" name="category" value="Widow" />
                                        <label for="Widow">
                                            <h4>Widow</h4>
                                        </label>

                                    </div>

                                    <div class="option" data-option-item5>

                                        <input type="radio" class="radio" name="category" value="Married"/>
                                        <label for="Married">
                                            <h4>Married</h4>
                                        </label>

                                    </div>

                                    <div class="option" data-option-item5>

                                        <input type="radio" class="radio" name="category" value="Single"/>
                                        <label for="Single">
                                            <h4>Single</h4>
                                        </label>

                                    </div>

                                </div>
                                
                                <div class="selected" data-option-select5>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- * Rowspan 4: Contact Number and Email Address -->
                    <div class="rowspan">

                        <!-- * Contact Number -->
                        <div class="input-wrapper">
                            <div class="input-wrapper">
                                <span>Contact Number</span>
                                <input autocomplete="off" type="number" id="conNum" name="conNum">
                            </div>
                        </div>

                        <!-- * Email Address -->
                        <div class="input-wrapper">
                            <div class="input-wrapper">
                                <span>Email Address</span>
                                <input autocomplete="off" type="email" id="eMail" name="eMail">
                            </div>
                        </div>

                    </div>

                    <!-- * Rowspan 5: Rented, Owned, Free of Use Radio Buttons and House Address-->
                    <div class="rowspan">

                        <!-- * Rented, Owned, and Free of Use Radio Buttons -->
                        <div class="input-wrapper">

                            <div class="box-wrap">

                                <!-- * Rented -->
                                <div class="radio-btn-wrapper">
                                    <span>Rented</span>
                                    <input autocomplete="off" type="radio" name="radio" value="rented" id="rented">
                                </div>

                                <!-- * Owned -->
                                <div class="radio-btn-wrapper">
                                    <span>Owned</span>
                                    <input autocomplete="off" type="radio" name="radio" value="owned" id="owned">
                                </div>

                                <!-- * Free Use -->
                                <div class="radio-btn-wrapper">
                                    <span>Free Use</span>
                                    <input autocomplete="off" type="radio" name="radio" value="freeUse" id="freeUse">
                                </div>

                            </div>

                        </div>

                        <!-- * House No./ Bldg. No./ Room No./ Subdivision/ Street -->
                        <div class="input-wrapper">
                            <span>House No./ Bldg. No./ Room No./ Subdivision/ Street</span>
                            <input autocomplete="off" type="text" id="houseAdd" name="houseAdd">
                        </div>

                    </div>

                    <!-- * Rowspan 6: Barangay, City / Municipality, Province / Region, and Country -->
                    <div class="rowspan">

                        <!-- * Barangay -->
                        <div class="input-wrapper">
                            <span>Barangay</span>
                            <input autocomplete="off" type="text" id="brgy" name="brgy">
                        </div>

                        <!-- * City / Municipality -->
                        <div class="input-wrapper">
                            <span>City / Municipality</span>
                            <input autocomplete="off" type="text" id="city" name="city">
                        </div>

                        <!-- * Province / Region -->
                        <div class="input-wrapper">
                            <span>Province / Region</span>
                            <input autocomplete="off" type="text" id="province" name="province">
                        </div>

                        <!-- * Country -->
                        <div class="input-wrapper">
                            <span>Country</span>
                            <input autocomplete="off" type="text" id="country" name="country">
                        </div>


                    </div>

                    <!-- * Rowspan 7: Zip Code and Years Of Stay -->
                    <div class="rowspan">

                        <!-- * Zip Code -->
                        <div class="input-wrapper">
                            <span>Zip Code</span>
                            <input type="number" id="zipCode" name="zipCode">
                        </div>

                        <!-- * Years Of Stay -->
                        <div class="input-wrapper">
                            <span>Years of stay on the mentioned address</span>
                            <input type="number" id="yoStay" name="yoStay">
                        </div>

                    </div>

                    <!-- * Rowspan 8: Empty Rowspan -->
                    <div class="rowspan">

                    </div>

                </div>
                <!-- * Container 2: Upload Images, Files and Monthly Bills Input Fields -->
                <div class="na-container-2">

                    <!-- * Small Container -->
                    <div class="small-con">

                        <div class="box-wrap">

                            <!-- * Colspan 1: Upload Image and Attach Files Buttons  -->
                            <div class="colspan">

                                <!-- * Upload Image -->
                                <div class="input-wrapper">
                                    <input type="image" src="../res/assets/icons/upload-image.svg" alt="upload-image">
                                </div>

                                <!-- * Upload Button -->
                                <button submit="">Upload Image</button>

                                <!-- * Attach Button -->
                                <button submit="">Attach Files</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- * Container 9: Co-Maker Job Information Input Fields -->
    <div class="na-container-3">

        <!-- * Small Container -->
        <div class="small-con-2">

            <!-- * Rowspan 1: Header -->
            <div class="rowspan">

                <!-- * Job Information -->
                <div class="input-wrapper">
                    <h2>Job Information</h2>
                    <span>(Co-Maker)</span>
                </div>

            </div>

            <!-- * Rowspan 2: Employment Status, Current Job / Position, Years Of Service and Company Name -->
            <div class="rowspan">


                <!-- * Employment Status -->
                <div class="input-wrapper">
                    <span>Employment Status</span>
                    <div class="select-box">

                        <div class="options-container" data-option-con6>

                            <div class="option" data-option-item6>

                                <input type="radio" class="radio" name="category" value="Employed" />
                                <label for="Employed">
                                    <h4>Employed</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item6>

                                <input type="radio" class="radio" name="category" value="Unemployed"/>
                                <label for="Unemployed">
                                    <h4>Unemployed</h4>
                                </label>

                            </div>

                        </div>
                        
                        <div class="selected" data-option-select6>
                        </div>

                    </div>
                </div>

                <!-- * Current Job / Position -->
                <div class="input-wrapper">

                    <!-- * Current Job -->
                    <span data-cb-current-job>Current Job / Position</span>
                    <input type="text" id="cbCurrentJob" name="currentJob" data-cb-current-job>

                    <!-- * Previous Job -->
                    <span data-cb-previous-job>Previous Job / Position</span>
                    <input type="text" id="cbPreviousJob" name="previousJob" data-cb-previous-job>

                </div>

                <!-- * Years Of Service -->
                <div class="input-wrapper">
                    <span>Years Of Service</span>
                    <input type="text" id="yoService" name="yoService">
                </div>

                <!-- * Company Name -->
                <div class="input-wrapper">
                    <span>Company Name</span>
                    <input type="text" id="compName" name="compName">
                </div>

            </div>


            <!-- * Rowspan 3: Company Address, Monthly Salary, Other Source of Income, and Do you own a Business?  -->
            <div class="rowspan">

                <!-- * Company Address -->
                <div class="input-wrapper">
                    <span>Company Address</span>
                    <input type="text" id="compAddr" name="compAddr">
                </div>

                <!-- * Monthly Salary -->
                <div class="input-wrapper">
                    <span>Monthly Salary</span>
                    <input type="number" id="monthSal" name="monthSal">
                </div>

                <!-- * Other Source Of Income -->
                <div class="input-wrapper">
                    <span>Other Source Of Income</span>
                    <input type="text" id="othSorOfInc" name="othSorOfInc">
                </div>

                <!-- * Do you own a Business?  -->
                <div class="input-wrapper">
                    <span>Do you own a Business?</span>

                    <!-- * Form Toggle -->

                    <div class="box-wrap">

                        <!-- * Rented -->
                        <div class="radio-btn-wrapper">
                            <input autocomplete="off" type="radio" name="formToggle" value="formToggleYes" id="formToggleYes">
                            <span>Yes</span>
                        </div>

                        <!-- * Owned -->
                        <div class="radio-btn-wrapper">
                            <input autocomplete="off" type="radio" name="formToggle" value="formToggleNo" id="formToggleNo">
                            <span>No</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- * Container 12: Signature Field -->
    <div class="na-container-12">

        <!-- * Small Container 7 -->
        <div class="small-con-7">

            <!-- * Rowspan 1: Header -->
            <div class="rowspan">

                <!-- * Signature Field Header -->
                <div class="input-wrapper">
                    <h2>I HEREBY CERTIFY THAT ALL THE INFORMATION ABOVE ARE TRUE AND CORRECT</h2>
                </div>

            </div>

            <!-- * Rowspan 2: Upload Applicant Signature, Upload Borrower Signature -->
            <div class="rowspan">

                <!-- * Signature Pad Box Wrapper 1 -->
                <div class="box-wrapper">

                    <!-- * Applicant Signature Pad -->
                    <!-- <div class="input-wrapper">
                        <div class="signature-wrapper">
                            <canvas class="signature-pad"></canvas>
                        </div>
                        <div class="clear-btn">
                            <button type="button" id="clearAppSig"><span> Clear </span></button>
                        </div>
                    </div> -->

                    <!-- * Applicant Signature Picture Upload -->
                    <div class="input-wrapper">
                        <div class="signature-wrapper-2">
                            <img id="applicantSig">
                            <span>Applicant’s Signature</span>
                        </div>
                    </div>

                    <!-- * Upload Applicant Signature Button -->
                    <div class="input-wrapper">
                        <button type="button">Upload Applicant Signature</button>
                    </div>

                </div>

                <!-- * Signature Pad Box Wrapper 2 -->
                <div class="box-wrapper">

                    <!-- * Co-Maker Signature Pad -->
                    <!-- <div class="input-wrapper">
                        <div class="signature-wrapper">
                            <canvas class="signature-pad"></canvas>
                        </div>
                        <div class="clear-btn">
                            <button type="button" id="clearCoSig"><span> Clear </span></button>
                        </div>
                    </div> -->

                    <!-- * Co-Maker Signature Picture Upload -->
                    <div class="input-wrapper">
                        <div class="signature-wrapper-2">
                            <img id="comSig">
                            <span>Co-Maker Signature</span>
                        </div>
                    </div>

                    <!-- * Upload Co-Maker Signature Button -->
                    <div class="input-wrapper">
                        <button type="button">Upload Co-Maker Signature</button>
                    </div>

                </div>

            </div>


        </div>

    </div>
    </form>
    <script>

        
        const openLoanDetailsButton = document.querySelector('#data-open-loan-details')
        const closeLoanDetailsButton = document.querySelector('#data-close-loan-details')
        const loanDetailsModal = document.querySelector('[data-loan-details-modal]')


        openLoanDetailsButton.addEventListener('click', () => {
            loanDetailsModal.showModal();
        })

        closeLoanDetailsButton.addEventListener('click', () => {
            loanDetailsModal.setAttribute("closing", "");
            loanDetailsModal.addEventListener("animationend", () => {
                loanDetailsModal.removeAttribute("closing");
                loanDetailsModal.close();
            }, { once: true });
        })

        loanDetailsModal.addEventListener('click', e => {
            loanDetailsModal.setAttribute("closing", "");
            loanDetailsModal.addEventListener("animationend", () => {

                const loanDetailsModalDimensions = loanDetailsModal.getBoundingClientRect()

                if (
                    e.clientX < loanDetailsModalDimensions.left ||
                    e.clientX > loanDetailsModalDimensions.right ||
                    e.clientY < loanDetailsModalDimensions.top ||
                    e.clientY > loanDetailsModalDimensions.bottom
                ) {
                    loanDetailsModal.removeAttribute("closing");
                }
                loanDetailsModal.close()

            }, { once: true })

        })

        // *** END --- Loan and Payement History Modal *** //
        
        // ** Select Dropdown 1
        const selectedOpt1 = document.querySelector('[data-option-select1]');
        const optionsContainer1 = document.querySelector('[data-option-con1]');
        const optionsList1 = document.querySelectorAll('[data-option-item1]');
       
        selectedOpt1.addEventListener("click", () => {           
            optionsContainer1.classList.toggle("active");
        });

        optionsList1.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt1.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer1.classList.remove("active");
            });
        });


        // ** Select Dropdown 2
        const selectedOpt2 = document.querySelector('[data-option-select2]');
        const optionsContainer2 = document.querySelector('[data-option-con2]');
        const optionsList2 = document.querySelectorAll('[data-option-item2]');

        selectedOpt2.addEventListener("click", () => {
            optionsContainer2.classList.toggle("active");
        });

        optionsList2.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt2.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer2.classList.remove("active");
            });
        });


        // ** Select Dropdown 3
        const selectedOpt3 = document.querySelector('[data-option-select3]');
        const optionsContainer3 = document.querySelector('[data-option-con3]');
        const optionsList3 = document.querySelectorAll('[data-option-item3]');

        selectedOpt3.addEventListener("click", () => {
            optionsContainer3.classList.toggle("active");
        });

        optionsList3.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt3.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer3.classList.remove("active");
            });
        });

        // * Borrower Job Information
        const previousJob = document.querySelectorAll('[data-previous-job]')
        const currentJob = document.querySelectorAll('[data-current-job]')

        for (const previousJobItems of previousJob) {
            previousJobItems.style.display = 'none'

            for (const currentJobItems of currentJob) {

                optionsContainer3.firstElementChild.addEventListener('click', () => {
                    previousJobItems.style.display = 'none'
                    currentJobItems.style.display = 'block'
                })

                optionsContainer3.lastElementChild.addEventListener('click', () => {
                    previousJobItems.style.display = 'block'
                    currentJobItems.style.display = 'none'
                })

            }
        }


        // ** Select Dropdown 4
        const selectedOpt4 = document.querySelector('[data-option-select4]');
        const optionsContainer4 = document.querySelector('[data-option-con4]');
        const optionsList4 = document.querySelectorAll('[data-option-item4]');

        selectedOpt4.addEventListener("click", () => {
            optionsContainer4.classList.toggle("active");
        });

        optionsList4.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt4.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer4.classList.remove("active");
            });
        });


        // ** Select Dropdown 5
        const selectedOpt5 = document.querySelector('[data-option-select5]');
        const optionsContainer5 = document.querySelector('[data-option-con5]');
        const optionsList5 = document.querySelectorAll('[data-option-item5]');

        selectedOpt5.addEventListener("click", () => {
            optionsContainer5.classList.toggle("active");
        });

        optionsList5.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt5.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer5.classList.remove("active");
            });
        });


        // * Civil Status Selector Form Toggle
        // const famBGFormSingle = document.querySelector('[data-family-background-single]')
        // const famBGFormMarried = document.querySelector('[data-family-background-married]')

        // optionsContainer2.children[0].addEventListener('click', () => {
        //     famBGFormSingle.style.display = 'none'
        //     famBGFormMarried.style.display = 'none'
        // })
        // optionsContainer2.children[1].addEventListener('click', () => {
        //     famBGFormSingle.style.display = 'none'
        //     famBGFormMarried.style.display = 'block'
        // })
        // optionsContainer2.children[2].addEventListener('click', () => {
        //     famBGFormMarried.style.display = 'none'
        //     famBGFormSingle.style.display = 'block'
        // })

        // ** Select Dropdown 6
        const selectedOpt6 = document.querySelector('[data-option-select6]');
        const optionsContainer6 = document.querySelector('[data-option-con6]');
        const optionsList6 = document.querySelectorAll('[data-option-item6]');

        selectedOpt6.addEventListener("click", () => {
            optionsContainer6.classList.toggle("active");
        });

        optionsList6.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt6.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer6.classList.remove("active");
            });
        });


        // * Co-Borrower Job Information
        const cbPreviousJob = document.querySelectorAll('[data-cb-previous-job]')
        const cbCurrentJob = document.querySelectorAll('[data-cb-current-job]')


        for (const cbPreviousJobItems of cbPreviousJob) {
            cbPreviousJobItems.style.display = 'none'

            for (const cbCurrentJobItems of cbCurrentJob) {

                optionsContainer6.firstElementChild.addEventListener('click', () => {
                    cbPreviousJobItems.style.display = 'none'
                    cbCurrentJobItems.style.display = 'block'
                })

                optionsContainer6.lastElementChild.addEventListener('click', () => {
                    cbPreviousJobItems.style.display = 'block'
                    cbCurrentJobItems.style.display = 'none'
                })

            }
        }


        // ** Select Dropdown 7
        const selectedOpt7 = document.querySelector('[data-option-select7]');
        const optionsContainer7 = document.querySelector('[data-option-con7]');
        const optionsList7 = document.querySelectorAll('[data-option-item7]');

        selectedOpt7.addEventListener("click", () => {
            optionsContainer7.classList.toggle("active");
        });

        optionsList7.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt7.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer7.classList.remove("active");
            });
        });

        // * Spouse Job Information
        const spousePreviousJob = document.querySelectorAll('[data-spouse-previous-job]')
        const spouseCurrentJob = document.querySelectorAll('[data-spouse-current-job]')

        for (const spousePreviousJobItems of spousePreviousJob) {
            spousePreviousJobItems.style.display = 'none'

            for (const spouseCurrentJobItems of spouseCurrentJob) {

                optionsContainer7.firstElementChild.addEventListener('click', () => {
                    spousePreviousJobItems.style.display = 'none'
                    spouseCurrentJobItems.style.display = 'block'
                })

                optionsContainer7.lastElementChild.addEventListener('click', () => {
                    spousePreviousJobItems.style.display = 'block'
                    spouseCurrentJobItems.style.display = 'none'
                })

            }
        }


        // ** Select Dropdown 8
        const selectedOpt8 = document.querySelector('[data-option-select8]');
        const optionsContainer8 = document.querySelector('[data-option-con8]');
        const optionsList8 = document.querySelectorAll('[data-option-item8]');

        selectedOpt8.addEventListener("click", () => {
            optionsContainer8.classList.toggle("active");
        });

        optionsList8.forEach(option => {
            option.addEventListener("click", () => {
                selectedOpt8.innerHTML = option.querySelector("label").innerHTML;
                optionsContainer8.classList.remove("active");
            });
        });


        // * Spouse Job Information
        const fdrPreviousJob = document.querySelectorAll('[data-fdr-previous-job]')
        const fdrCurrentJob = document.querySelectorAll('[data-fdr-current-job]')

        for (const fdrPreviousJobItems of fdrPreviousJob) {
            fdrPreviousJobItems.style.display = 'none'

            for (const fdrCurrentJobItems of fdrCurrentJob) {

                optionsContainer8.firstElementChild.addEventListener('click', () => {
                    fdrPreviousJobItems.style.display = 'none'
                    fdrCurrentJobItems.style.display = 'block'
                })

                optionsContainer8.lastElementChild.addEventListener('click', () => {
                    fdrPreviousJobItems.style.display = 'block'
                    fdrCurrentJobItems.style.display = 'none'
                })

            }
        }


        // ****** Child Form Toggle ***** //

        // * Add Child (Married)
        const childForm = document.querySelector('[data-child]')
        const childContainer = document.querySelector('[data-child-container]')

        let cloneCount = 1


        function addChild() {

            childForm.setAttribute('id', 'child-1')

            // * Clone the original element
            const clonedChild = childForm.cloneNode(true)

            // * Increment the clone count and modify the ID
            cloneCount++
            const newId = `child-${cloneCount}`
            clonedChild.id = newId

            // * Hide the increment button
            clonedChild.lastElementChild.children[0].style.visibility = 'hidden'


            // * Append the cloned element to the target container
            childContainer.appendChild(clonedChild)

        }

        // * Subtract Child (Married)
        function subChild() {

            // * Reset cloneCount when decrement
            cloneCount = 1

            // * Remove the the next sibling of child-1
            if (childContainer.children[7].nextElementSibling !== null) {
                childContainer.lastElementChild.remove()
            }

        }

        // * Add Child (Single)
        function addChildSingle() {

            const childForm = document.querySelector('[data-child-2]')
            const childContainer = document.querySelector('[data-child-container-2]')

            childForm.setAttribute('id', 'child-1')

            // * Clone the original element
            const clonedChild = childForm.cloneNode(true)

            // * Increment the clone count and modify the ID
            cloneCount++
            const newId = `child-${cloneCount}`
            clonedChild.id = newId

            // * Hide the increment button
            clonedChild.lastElementChild.children[0].style.visibility = 'hidden'


            // * Append the cloned element to the target container
            childContainer.appendChild(clonedChild)
        }

        // * Subtract Child (Single)
        function subChildSingle() {

            const childContainer = document.querySelector('[data-child-container-2]')

            // * Reset cloneCount when decrement
            cloneCount = 1

            // * Remove the the next sibling of child-1
            if (childContainer.children[7].nextElementSibling !== null) {
                childContainer.lastElementChild.remove()
            }

        }

        // ****** END --- Child Form Toggle ***** //



        // // * First Degree Relative Job Information
        // const fdrEmploymentStatus = document.getElementById('fdrEmpStat')
        // const fdrPreviousJob = document.querySelectorAll('[data-fdr-previous-job]')

        // for (const fdrPreviousJobItems of fdrPreviousJob) {
        //     fdrPreviousJobItems.style.display = 'none'

        //     fdrEmploymentStatus.addEventListener('change', () => {
        //         const fdrCurrentJob = document.querySelectorAll('[data-fdr-current-job]')

        //         for (const fdrCurrentJobItems of fdrCurrentJob) {
        //             // * If Employed is Selected show Current Job / Position
        //             if (fdrEmploymentStatus.selectedIndex === 1) {
        //                 fdrPreviousJobItems.style.display = 'none'
        //                 fdrCurrentJobItems.style.display = 'block'
        //                     // * If Unemployed is Selected show Previous Job / Position
        //             } else if (fdrEmploymentStatus.selectedIndex === 2) {
        //                 fdrPreviousJobItems.style.display = 'block'
        //                 fdrCurrentJobItems.style.display = 'none'
        //             }
        //         }

        //     })
        // }


        // * Business Information Form Toggle
        const yesToggle = document.getElementById('formToggleYes')
        const noToggle = document.getElementById('formToggleNo')

        yesToggle.addEventListener('click', _ => {

            const businessForm = document.querySelector('[data-business-form]')

            if (yesToggle.checked) {
                businessForm.style.display = 'block'
            }

            noToggle.addEventListener('click', _ => {
                if (noToggle.checked) {
                    businessForm.style.display = 'none'
                }
            })

        })

        // ***** Assets and Properties ***** //
        const vehicleFormToggleYes = document.getElementById('vehicleFormToggleYes')
        const vehicleFormToggleNo = document.getElementById('vehicleFormToggleNo')
        const vehicleContainer = document.querySelector('[data-vehicle-container]')
        
        vehicleContainer.style.opacity = '.4'
        vehicleContainer.style.pointerEvents = 'none'

        vehicleFormToggleYes.addEventListener('change', () => {

            if (vehicleFormToggleYes) {
                vehicleContainer.style.opacity = '1'
                vehicleContainer.style.pointerEvents = 'auto'
            } 

            vehicleFormToggleNo.addEventListener('change', () => {
                const vehicle = document.getElementById('ownVehicle')
                if (vehicleFormToggleNo) {
                    vehicleContainer.style.opacity = '.4'
                    vehicleContainer.style.pointerEvents = 'none'
                    vehicle.value = ''
                } 
            })

        })

        const propertyFormToggleYes = document.getElementById('propertyFormToggleYes')
        const propertyFormToggleNo = document.getElementById('propertyFormToggleNo')
        const propertyContainer = document.querySelector('[data-property-container]')
        
        propertyContainer.style.opacity = '.4'
        propertyContainer.style.pointerEvents = 'none'

        propertyFormToggleYes.addEventListener('change', () => {

            if (propertyFormToggleYes) {
                propertyContainer.style.opacity = '1'
                propertyContainer.style.pointerEvents = 'auto'
            } 

            propertyFormToggleNo.addEventListener('change', () => {
                const property = document.getElementById('ownProperty')
                if (propertyFormToggleNo) {
                    propertyContainer.style.opacity = '.4'
                    propertyContainer.style.pointerEvents = 'none'
                    property.value = ''
                } 
            })

        })


        // ***** Add and Subtract Vehicle ***** //
        // * Add Vehicle
        function addVehicle() {

            const vehicleForm = document.querySelector('[data-vehicle]')

            vehicleForm.setAttribute('id', 'vehicle-1')

            // * Clone the original element
            const clonedChild = vehicleForm.cloneNode(true)

            // * Increment the clone count and modify the ID
            cloneCount++
            const newId = `vehicle-${cloneCount}`
            clonedChild.id = newId

            // * Hide the increment button
            clonedChild.lastElementChild.children[1].children[0].style.visibility = 'hidden'


            // * Append the cloned element to the target container
            vehicleContainer.appendChild(clonedChild)

        }

        // * Subtract Vehicle
        function subVehicle() {

            const vehicleContainer = document.querySelector('[data-vehicle-container]')

            // * Reset cloneCount when decrement
            cloneCount = 1

            // * Remove the the next sibling of child-1
            if (vehicleContainer.firstElementChild.nextElementSibling !== null) {
                vehicleContainer.lastElementChild.remove()
            }

        }

        // ***** END ---- Add and Subtract Vehicle ***** //


        // ***** Add and Subtract Property ***** //

        // * Add Property
        function addProperty() {

            const propertyForm = document.querySelector('[data-property]')

            propertyForm.setAttribute('id', 'property-1')

            // * Clone the original element
            const clonedChild = propertyForm.cloneNode(true)

            // * Increment the clone count and modify the ID
            cloneCount++
            const newId = `property-${cloneCount}`
            clonedChild.id = newId

            // * Hide the increment button
            clonedChild.lastElementChild.children[1].children[0].style.visibility = 'hidden'


            // * Append the cloned element to the target container
            propertyContainer.appendChild(clonedChild)

        }

        // * Subtract Property
        function subProperty() {

            const propertyContainer = document.querySelector('[data-property-container]')

            // * Reset cloneCount when decrement
            cloneCount = 1

            // * Remove the the next sibling of property-1
            if (propertyContainer.firstElementChild.nextElementSibling !== null) {
                propertyContainer.lastElementChild.remove()
            }

        }

        // ***** END ---- Add and Subtract Property ***** //


        // ***** Add and Subtract Appliances ***** //

        // * Add Appliances
        function addAppliances() {

            const appliancesForm = document.querySelector('[data-appliances]')
            const appliancesContainer = document.querySelector('[data-appliances-container]')

            appliancesForm.setAttribute('id', 'property-1')

            // * Clone the original element
            const clonedChild = appliancesForm.cloneNode(true)

            // * Increment the clone count and modify the ID
            cloneCount++
            const newId = `property-${cloneCount}`
            clonedChild.id = newId

            // * Hide the increment button
            clonedChild.lastElementChild.children[0].style.visibility = 'hidden'


            // * Append the cloned element to the target container
            appliancesContainer.appendChild(clonedChild)

        }

        // * Subtract Appliances
        function subAppliances() {

            const appliancesContainer = document.querySelector('[data-appliances-container]')

            // * Reset cloneCount when decrement
            cloneCount = 1

            // * Remove the the next sibling of appliance-1
            if (appliancesContainer.firstElementChild.nextElementSibling !== null) {
                appliancesContainer.lastElementChild.remove()
            }

        }

        // ***** END ---- Add and Subtract Appliances ***** //


        // ***** Add and Subtract Bank ***** //

        // * Add Bank
        function addBank() {

            const bankForm = document.querySelector('[data-bank]')
            const bankContainer = document.querySelector('[data-bank-container]')

            bankForm.setAttribute('id', 'bank-1')

            // * Clone the original element
            const clonedChild = bankForm.cloneNode(true)

            // * Increment the clone count and modify the ID
            cloneCount++
            const newId = `bank-${cloneCount}`
            clonedChild.id = newId

            // * Hide the increment button
            clonedChild.lastElementChild.children[0].style.visibility = 'hidden'


            // * Append the cloned element to the target container
            bankContainer.appendChild(clonedChild)

        }

        // * Subtract Bank
        function subBank() {

            const bankContainer = document.querySelector('[data-bank-container]')

            // * Reset cloneCount when decrement
            cloneCount = 1

            // * Remove the the next sibling of appliance-1
            if (bankContainer.firstElementChild.nextElementSibling !== null) {
                bankContainer.lastElementChild.remove()
            }


        }
    </script>
</div>
