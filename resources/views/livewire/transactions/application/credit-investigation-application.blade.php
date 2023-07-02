<div>
    <!-- * New Application Modal -->
    <dialog class="na-modal" data-new-application-modal>

    <div class="modal-container">
        <!-- * Exit Button -->
        <button class="exit-button" id="data-close-new-application-modal">
            <img src="../res/assets/icons/x-circle.svg" alt="exit">
        </button>

        <!-- * Choose Type of Loan -->
        <div class="rowspan">
            <h3>Choose Type of Loan</h3>

            <!-- * Type Of Loan Dropdown Menu -->
            <div class="loan-type-dropdown" data-bor-dropdown>

                <!-- * Gender -->
                <div class="input-wrapper">
                    <div class="select-box">
                        <select name="typeOfLoan" id="typeOfLoan">
                            <option disabled selected value></option>
                            <option value="Individual Loan">Individual Loan</option>
                            <option value="Group Loan">Group Loan</option>
                            <option value="Sample Loan">Sample Loan</option>
                        </select>
                    </div>
                </div>

            </div>

        </div>

        <!-- * Search for existing member -->
        <div class="rowspan">

            <!-- * Search for existing member -->
            <h3>Search for existing member</h3>

            <div class="wrapper">

                <!-- * Search Bar -->
                <div class="search-wrap">
                    <input type="search" id="search" name="search" placeholder="Search name or member ID">
                    <img src="../res/assets/icons/magnifyingglass.svg" alt="search">
                </div>

                <!-- * Create New Button -->
                <button class="button">Create New</button>

            </div>


        </div>

        <!-- * Table -->
        <div class="rowspan">

            <!-- * Container: Table and Pagination -->
            <div class="na-table-con">

                <!-- * Table Container -->
                <div class="table-container">

                    <!-- * Members Table -->
                    <table>

                        <!-- * Table Header -->
                        <tr>

                            <!-- * Checkbox ALl
                            <th><input type="checkbox" id="allCheckbox" onchange="checkAll(this)"></th> -->

                            <!-- * Header Name -->
                            <th><span class="th-name">Name</span></th>

                            <!-- * Header Member ID -->
                            <th><span class="th-name">Member ID</span></th>

                        </tr>


                        <!-- * Members Data -->
                        <tr>

                            <!-- * Checkbox Opt
                            <td><input type="checkbox" id="checkbox" data-checkbox></td> -->

                            <td>

                                <!-- * Data Name-->
                                <span class="td-name">Dela Cruz, Juana</span>

                            </td>

                            <td>

                                <!-- * Data Member ID-->
                                <span class="td-name">778 8596 2125</span>

                            </td>


                        </tr>

                    </table>

                </div>

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

    </dialog>

    <!-- * New-Application-Form-Container -->
    <form action="" class="na-form-con" autocomplete="off">

    <!-- * New Application Progress Bar Container -->
    <div class="na-progress-bar-container">
        <div class="progress-bar-level">

            <!-- * New Application Registration Level 1 -->
            <div class="level level1 active">
                <span>Registration</span>
            </div>

            <!-- * New Application Credit Investigation Level 2 -->
            <div class="line" data-level-2></div>
            <div class="level active" data-level-2>
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

    <!-- * New Application Requirements Section -->
    <div class="na-requirements-sec">
        <h5>
            Missing Requirements:
            <span>Proof of Income,</span>
            <span>Barangay ID</span>
        </h5>
    </div>

    <!-- * New Application Notes and Remarks Section -->
    <div class="na-notes-remarks-sec">
        <div class="wrapper-1">
            <h3>Notes/Remarks</h3>
            <div class="btn-wrapper">
                <a href="new-application-approval.html">
                    <button type="button" class="button">Submit for approval</button>
                </a>
                <button type="button" class="declineButton">Decline</button>
            </div>
        </div>
        <div class="wrapper-2">
            <p>The subject has maintained a good credit score over the years, indicating a strong credit worthiness and a positive repayment history.</p>
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
                        <button type="button" id="saveBtn" class="button" data-save>Save</button>

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
                            <select name="Gender" id="gender">
                            <option value="0"></option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
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
                            <select name="Civil Status" id="civStat" data-civil-status>
                                <option value="0"></option>
                                <option value="Widow">Widow</option>
                                <option value="Married">Married</option>
                                <option value="Single">Single</option>
                            </select>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
                        <select name="empStat" id="empStat">
                        <option value="0"></option>
                        <option value="1">Employed</option>
                        <option value="2">Unemployed</option>
                        </select>
                    </div>
                </div>

                <!-- * Current Job / Position -->
                <div class="input-wrapper">
                    <span>Current Job / Position</span>
                    <input type="text" id="currentJob" name="currentJob">
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
    <div class="nm-container-4" data-family-background-married>

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
                        <select name="empStat" id="empStat">
                            <option value="0"></option>
                            <option value="1">Employed</option>
                            <option value="2">Unemployed</option>
                        </select>
                    </div>
                </div>

                <!-- * Current Job / Position -->
                <div class="input-wrapper">
                    <span>Current Job / Position</span>
                    <input type="text" id="currentJob" name="currentJob">
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
            <div class="rowspan">

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
                    <button type="button" onclick="addChild()">+</button>
                    <button type="button" onclick="subChild()">-</button>
                </div>


            </div>

        </div>

    </div>

    <!-- * Container 4(b): Family Background Information (Single)-->
    <div class="nm-container-4" data-family-background-single>

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
                        <select name="empStat" id="empStat">
                            <option value="0"></option>
                            <option value="1">Employed</option>
                            <option value="2">Unemployed</option>
                        </select>
                    </div>
                </div>

                <!-- * Current Job / Position -->
                <div class="input-wrapper">
                    <span>Current Job / Position</span>
                    <input type="text" id="currentJob" name="currentJob">
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


    <!-- * Container 6 (Wrapper): Assets and Properties, Appliances and Bank Accounts -->
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
                    <div class="rowspan" data-vehicle-container>

                        <!-- * Do you own motor vehicles? -->
                        <div class="input-wrapper">

                            <span>Do you own motor vehicles?</span>

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

                        <span>If yes please specify,</span>

                        <!-- * Rowspan 3: Vehicle Input Field -->
                        <div class="rowspan-2 child" data-vehicle>

                            <!-- * Vehicle Input Field -->
                            <div class="input-wrapper">
                                <input autocomplete="off" type="text" id="ownVehicle" name="ownVehicle">
                            </div>

                            <!-- * Add and Subtract Button  -->
                            <div class="input-wrapper">
                                <button type="button" onclick="addVehicle()">+</button>
                                <button type="button" onclick="subVehicle()">-</button>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- * Rowspan Container 3: Do you own real property? -->
                <div class="rowspan-container">

                    <!-- * Rowspan 4: Do you own real property? -->
                    <div class="rowspan" data-property-container>

                        <!-- * Do you own real property? -->
                        <div class="input-wrapper">
                            <span>Do you own real property?</span>

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

                        <span>If yes please specify,</span>
                        <!-- * Rowspan 5: Property Input Field -->
                        <div class="rowspan-2 child" data-property>

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
        <!-- * Container 10: Appliances and Bank Accounts -->
        <div class="na-container-10">

            <!-- * Small Container -->
            <div class="small-con-6">

                <div class="box-wrap" data-appliances-container>

                    <!-- * Rowspan 1: Appliances -->
                    <div class="rowspan">

                        <h2>Appliances</h2>

                    </div>


                    <!-- * Rowspan 2: Appliances and Brand / Model -->
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

                <div class="box-wrap" data-bank-container>

                    <!-- * Rowspan 3: Bank Accounts -->
                    <div class="rowspan">

                        <h2>Bank Accounts</h2>

                    </div>


                    <!-- * Rowspan 4: Bank account and Address -->
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
                                <select name="Gender" id="gender">
                                <option value="0"></option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
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
                                <select name="Civil Status" id="civStat" data-civil-status>
                                    <option value="0"></option>
                                    <option value="Widow">Widow</option>
                                    <option value="Married">Married</option>
                                    <option value="Single">Single</option>
                                </select>
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
                        <select name="empStat" id="empStat">
                        <option value="0"></option>
                        <option value="1">Employed</option>
                        <option value="2">Unemployed</option>
                        </select>
                    </div>
                </div>

                <!-- * Current Job / Position -->
                <div class="input-wrapper">
                    <span>Current Job / Position</span>
                    <input type="text" id="currentJob" name="currentJob">
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>


            </div>

        </div>



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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>


            </div>

        </div>



    </div>

    <!-- * Container 12: Signature Field -->
    <div class="na-container-10">

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
</div>
