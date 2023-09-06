<div>
    <!-- * New-Application-Form-Container -->
    <form action="" id="newApplicationForm" method="GET" class="na-form-con" autocomplete="off">

<!-- * New Application Progress Bar Container -->
<div class="na-progress-bar-container">
    <div class="progress-bar-level">

        <!-- * New Application Registration Level 1 -->
        <div class="level level1 active">
            <span>Registration</span>
        </div>

        <!-- * New Application Credit Investigation Level 2 -->
        <div class="line active" data-level-2></div>
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
            <!-- <a href="new-application-approval.html"> -->
                <button type="submit" class="button" data-submit-for-approval>Submit for approval</button>
            <!-- </a> -->
            <button type="button" class="declineButton">Decline</button>
        </div>
    </div>
    <div class="wrapper-2">
        <p>The subject has maintained a good credit score over the years, indicating a strong credit worthiness and a positive repayment history.</p>
    </div>

</div>

<!-- * View Borrower Container 1 -->
<div class="view-borrower-con">

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
                    <button type="button" class="viewLoanDetailsButton" id="data-open-loan-details">View loan & payment history</button>
                </div>

                <!-- * CI Time -->
                <div class="CI-time-wrapper">
                    <img src="{{ URL::to('/') }}/assets/icons/time.svg" alt="Time">
                    <div class="box">
                        <span>CI Time</span>
                        <span id="ciTime">
                            <span id="ciTimeWeek">1</span>W
                        <span id="ciTimeDay">3</span>D
                        <span id="ciTimeHour">4</span>H
                        </span>
                    </div>
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

                        <div class="options-container" data-option-con1>

                            <div class="option" data-option-item1>

                                <input type="radio" class="radio" name="category" value="Male" />
                                <label for="Male">
                                    <h4>Male</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item1>

                                <input type="radio" class="radio" name="category" value="Female" />
                                <label for="Female">
                                    <h4>Female</h4>
                                </label>

                            </div>

                        </div>

                        <div class="selected" data-option-select1>
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

                        <div class="options-container" data-option-con2>

                            <div class="option" data-option-item2>

                                <input type="radio" class="radio" name="category" value="Widow" />
                                <label for="Widow">
                                    <h4>Widow</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item2>

                                <input type="radio" class="radio" name="category" value="Married" />
                                <label for="Married">
                                    <h4>Married</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item2>

                                <input type="radio" class="radio" name="category" value="Single" />
                                <label for="Single">
                                    <h4>Single</h4>
                                </label>

                            </div>

                        </div>

                        <div class="selected" data-option-select2>
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
    </div>

    <!-- * Container 2: Upload Images, Files and Monthly Bills Input Fields -->
    <div class="na-container-2">

        <!-- * Small Container -->
        <div class="small-con">

            <div class="box-wrap">

                <!-- * Colspan 1: Upload Image and Attach Files Buttons  -->
                <div class="colspan">

                    <!-- * Upload Image -->
                    <div class="input-wrapper" data-upload-image-hover-container>
                        <img type="image" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" data-borrower-image-container>
                    </div>

                    <div class="btn-wrapper">
                        <!-- * Upload Button -->
                        <input type="file" submit="" class="input-image upload-profile-image-btn" data-upload-borrower-image-btn></input>
                        <!-- * Attach Button -->
                        <button type="button" submit="" class="button">Attach Files</button>
                    </div>

                    <div class="btn-wrapper">
                        <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">File.png</button>
                        <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.pdf">File.pdf</button>
                    </div>

                    <button type="button" class="transparentButton3">Show All</button>
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

<!-- * Loan and Payment Details Modal -->
<dialog class="na-loan-details-modal" data-loan-details-modal>

    <!-- * Modal Container -->
    <div class="modal-container">

        <!-- * Daily Payment History -->
        <dialog class="daily-payment-modal" data-daily-payment-history-modal>

            <!-- * Daily Payment History Modal Container -->
            <div class="daily-payment-modal-container">

                <!-- * Button Wrapper -->
                <div class="button-wrapper">
                    <button type="button" data-close-daily-payment-modal>
                            <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="close">
                    </button>
                </div>

                <!-- * Container 13: Daily Payment History Table -->
                <div class="na-container-9">

                    <!-- * Small Container -->
                    <div class="small-con-5">

                        <!-- * Rowspan 1: Header -->
                        <div class="rowspan">

                            <!-- * Loan History -->
                            <div class="input-wrapper">
                                <h2>Daily Payment History</h2>
                            </div>

                        </div>

                        <!-- * Rowspan 2: Payment History Details -->
                        <div class="rowspan">
                            <div class="box-wrapper">
                                <div class="detail-wrapper">
                                    <div class="detail-inner-wrapper">
                                        <span>Name:</span>
                                    </div>
                                    <div class="detail-inner-wrapper">
                                        <span>Dela Cruz, Juana</span>
                                    </div>
                                </div>
                                <div class="detail-wrapper">
                                    <div class="detail-inner-wrapper">
                                        <span>Loan Reference Number:</span>
                                    </div>
                                    <div class="detail-inner-wrapper">
                                        <span>REF-0000001</span>
                                    </div>
                                </div>
                                <div class="detail-wrapper">
                                    <div class="detail-inner-wrapper">
                                        <span>Loan Amount:</span>
                                    </div>
                                    <div class="detail-inner-wrapper">
                                        <span>5,000</span>
                                    </div>
                                </div>
                                <div class="detail-wrapper">
                                    <div class="detail-inner-wrapper">
                                        <span>First Payment:</span>
                                    </div>
                                    <div class="detail-inner-wrapper">
                                        <span>1,000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-wrapper">
                                <div class="detail-wrapper">
                                    <div class="detail-inner-wrapper">
                                        <span>Loan Balance:</span>
                                    </div>
                                    <div class="detail-inner-wrapper">
                                        <span>5,000</span>
                                    </div>
                                </div>
                                <div class="detail-wrapper">
                                    <div class="detail-inner-wrapper">
                                        <span>Overall Savings:</span>
                                    </div>
                                    <div class="detail-inner-wrapper">
                                        <span>2,000</span>
                                    </div>
                                </div>
                                <div class="detail-wrapper">
                                    <div class="detail-inner-wrapper">
                                        <span>Date Release:</span>
                                    </div>
                                    <div class="detail-inner-wrapper">
                                        <span>July 6, 2023</span>
                                    </div>
                                </div>
                                <div class="detail-wrapper">
                                    <div class="detail-inner-wrapper">
                                        <span>Due Date</span>
                                    </div>
                                    <div class="detail-inner-wrapper">
                                        <span>Sept 6, 2023</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- * Rowspan 3: Daily Payment History Table -->
                        <div class="rowspan table">

                            <table>
                                <!-- * Table Header -->
                                <tr>
                                    <th>No. of Days</th>
                                    <th>Date</th>
                                    <th>Amount Paid</th>
                                    <th>Savings</th>
                                    <th>Advance</th>
                                    <th>Lapses</th>
                                </tr>

                                <!-- * Table Data -->
                                <tr>
                                    <td>3</td>
                                    <td>July 3, 2023</td>
                                    <td>500</td>
                                    <td>1,000</td>
                                    <td>3,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>July 3, 2023</td>
                                    <td>500</td>
                                    <td>1,000</td>
                                    <td>3,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>July 3, 2023</td>
                                    <td>500</td>
                                    <td>1,000</td>
                                    <td>3,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>July 3, 2023</td>
                                    <td>500</td>
                                    <td>1,000</td>
                                    <td>3,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>July 3, 2023</td>
                                    <td>500</td>
                                    <td>1,000</td>
                                    <td>3,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>July 3, 2023</td>
                                    <td>500</td>
                                    <td>1,000</td>
                                    <td>3,000</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>July 3, 2023</td>
                                    <td>500</td>
                                    <td>1,000</td>
                                    <td>3,000</td>
                                    <td>0</td>
                                </tr>

                            </table>

                        </div>

                        <div class="show-more">
                            <span class="transparentButton4">Show more</span>
                        </div>

                    </div>

                </div>

            </div>

        </dialog>

        <!-- * Button Wrapper -->
        <div class="button-wrapper">
            <button type="button" id="data-close-loan-details">
                <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="close">
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
                <div class="rowspan table">

                    <table>
                        <!-- * Table Header -->
                        <tr>
                            <th>Loan Reference no.</th>
                            <th>Loan Amount</th>
                            <th>Savings</th>
                            <th>Penalty</th>
                            <th>Date Released</th>
                            <th>Due Date</th>
                            <th>Date of Full Payment</th>
                            <th>No. of NP's</th>
                        </tr>

                        <!-- * Table Data -->
                        <tr>
                            <td>REF-0000001</td>
                            <td>4,000</td>
                            <td>3,000</td>
                            <td>1,000</td>
                            <td>April 2, 2023</td>
                            <td>July 3, 2023</td>
                            <td>August 1, 2023</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>REF-0000002</td>
                            <td>7,000</td>
                            <td>5,000</td>
                            <td>2,000</td>
                            <td>June 22, 2023</td>
                            <td>August 23, 2023</td>
                            <td>September 23, 2023</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>REF-0000003</td>
                            <td>4,000</td>
                            <td>3,000</td>
                            <td>1,000</td>
                            <td>April 2, 2023</td>
                            <td>July 3, 2023</td>
                            <td>August 1, 2023</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>REF-0000004</td>
                            <td>7,000</td>
                            <td>5,000</td>
                            <td>2,000</td>
                            <td>June 22, 2023</td>
                            <td>August 23, 2023</td>
                            <td>September 23, 2023</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>REF-0000005</td>
                            <td>4,000</td>
                            <td>3,000</td>
                            <td>1,000</td>
                            <td>April 2, 2023</td>
                            <td>July 3, 2023</td>
                            <td>August 1, 2023</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>REF-0000006</td>
                            <td>7,000</td>
                            <td>5,000</td>
                            <td>2,000</td>
                            <td>June 22, 2023</td>
                            <td>August 23, 2023</td>
                            <td>September 23, 2023</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>REF-0000007</td>
                            <td>4,000</td>
                            <td>3,000</td>
                            <td>1,000</td>
                            <td>April 2, 2023</td>
                            <td>July 3, 2023</td>
                            <td>August 1, 2023</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>REF-0000008</td>
                            <td>7,000</td>
                            <td>5,000</td>
                            <td>2,000</td>
                            <td>June 22, 2023</td>
                            <td>August 23, 2023</td>
                            <td>September 23, 2023</td>
                            <td>4</td>
                        </tr>



                    </table>


                </div>

                <div class="show-more ">
                    <span class="transparentButton4">Show more</span>
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
                <div class="rowspan table">

                    <table>

                        <!-- * Table Header -->
                        <tr>
                            <th>Loan Reference no.</th>
                            <th>Date Released</th>
                            <th>Due Date</th>
                            <th>Loan Amount</th>
                            <th>Overall Savings</th>
                            <th>Total Balance</th>
                            <th>Total Amount Paid</th>
                            <th>Total Savings</th>
                        </tr>

                        <!-- * Table Data -->
                        <tr data-open-daily-payment-modal>
                            <td>REF-0000001</td>
                            <td>July 6, 2023</td>
                            <td>Sept 6, 2023</td>
                            <td>5,000</td>
                            <td>2,000</td>
                            <td>4,254</td>
                            <td>2,000</td>
                            <td>2,500</td>
                        </tr>
                        <tr data-open-daily-payment-modal>
                            <td>REF-0000002</td>
                            <td>June 2, 2023</td>
                            <td>Aug 2, 2023</td>
                            <td>8,000</td>
                            <td>3,250</td>
                            <td>6,958</td>
                            <td>3,670</td>
                            <td>3,200</td>
                        </tr>
                        <tr data-open-daily-payment-modal>
                            <td>REF-0000003</td>
                            <td>Sept 13, 2023</td>
                            <td>Aug 6, 2023</td>
                            <td>5,000</td>
                            <td>2,000</td>
                            <td>4,254</td>
                            <td>2,000</td>
                            <td>2,500</td>
                        </tr>
                        <tr data-open-daily-payment-modal>
                            <td>REF-0000004</td>
                            <td>Oct 21, 2023</td>
                            <td>Nov 9, 2023</td>
                            <td>8,000</td>
                            <td>3,250</td>
                            <td>6,958</td>
                            <td>3,670</td>
                            <td>3,200</td>
                        </tr>
                        <tr data-open-daily-payment-modal>
                            <td>REF-0000005</td>
                            <td>July 6, 2023</td>
                            <td>Sept 6, 2023</td>
                            <td>5,000</td>
                            <td>2,000</td>
                            <td>4,254</td>
                            <td>2,000</td>
                            <td>2,500</td>
                        </tr>
                        <tr data-open-daily-payment-modal>
                            <td>REF-0000006</td>
                            <td>June 2, 2023</td>
                            <td>Aug 2, 2023</td>
                            <td>8,000</td>
                            <td>3,250</td>
                            <td>6,958</td>
                            <td>3,670</td>
                            <td>3,200</td>
                        </tr>
                        <tr data-open-daily-payment-modal>
                            <td>REF-0000007</td>
                            <td>Sept 13, 2023</td>
                            <td>Aug 6, 2023</td>
                            <td>5,000</td>
                            <td>2,000</td>
                            <td>4,254</td>
                            <td>2,000</td>
                            <td>2,500</td>
                        </tr>
                        <tr data-open-daily-payment-modal>
                            <td>REF-0000008</td>
                            <td>Oct 21, 2023</td>
                            <td>Nov 9, 2023</td>
                            <td>8,000</td>
                            <td>3,250</td>
                            <td>6,958</td>
                            <td>3,670</td>
                            <td>3,200</td>
                        </tr>

                    </table>

                </div>

                <div class="show-more">
                    <span class="transparentButton4">Show more</span>
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

                            <input type="radio" class="radio" name="category" value="Unemployed" />
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

                    <div class="options-container" data-option-con7>

                        <div class="option" data-option-item7>

                            <input type="radio" class="radio" name="category" value="Employed" />
                            <label for="Employed">
                                <h4>Employed</h4>
                            </label>

                        </div>

                        <div class="option" data-option-item7>

                            <input type="radio" class="radio" name="category" value="Unemployed" />
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

                    <div class="options-container" data-option-con8>

                        <div class="option" data-option-item8>

                            <input type="radio" class="radio" name="category" value="Employed" />
                            <label for="Employed">
                                <h4>Employed</h4>
                            </label>

                        </div>

                        <div class="option" data-option-item8>

                            <input type="radio" class="radio" name="category" value="Unemployed" />
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
        <div class="rowspan table">

            <table>

                <!-- * Table Header -->
                <tr>
                    <th>Business Name</th>
                    <th>Business Type</th>
                    <th>Business Address</th>
                    <th>Years of Business</th>
                    <th>Action</th>
                </tr>
                <!-- * Table Data -->
                <tr>
                    <td>Baskin'</td>
                    <td>Sole Proprietorship</td>
                    <td>Germany</td>
                    <td>2</td>

                    <!-- * Table Edit and Delete Button -->
                    <td class="td-btns">

                        <div class="td-btn-wrapper">
                            <button class="a-btn-edit">Edit</button>
                            <button class="a-btn-trash-2">Delete</button>
                        </div>

                    </td>

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
                            <button class="a-btn-trash-2">Delete</button>
                        </div>

                    </td>

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
                            <button class="a-btn-trash-2">Delete</button>
                        </div>

                    </td>

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
                            <button class="a-btn-trash-2">Delete</button>
                        </div>

                    </td>

                </tr>

            </table>


        </div>

        <!-- * Rowspan 6: Pagination -->
        <div class="rowspan">

            <!-- * Pagination Container -->
            <div class="pagination-container">

                <!-- * Pagination Links -->
                <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left"></a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right"></a>

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
                        <div class="input-wrapper" data-vehicle>
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
                        <div class="input-wrapper-add">
                            <span>Brand / Model</span>
                            <div class="inner-container-wrapper">
                                <!-- * Input Inner Wrapper -->
                                <div class="input-inner-wrapper">
                                    <input autocomplete="off" type="text" id="brandModel" name="brandModel">
                                </div>
                                <!-- * Add and Subtract Button  -->
                                <div class="input-inner-wrapper">
                                    <button type="button" class="addOrSubButton" onclick="addAppliances()">+</button>
                                    <button type="button" class="addOrSubButton" onclick="subAppliances()">-</button>
                                </div>
                            </div>
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
                        <div class="input-wrapper-add">
                            <span>Address</span>
                            <div class="inner-container-wrapper">
                                <!-- * Input Inner Wrapper -->
                                <div class="input-inner-wrapper">
                                    <input autocomplete="off" type="text" id="bankAddr" name="brandModel">
                                </div>
                                <!-- * Add and Subtract Button  -->
                                <div class="input-inner-wrapper">
                                    <button type="button" class="addOrSubButton" onclick="addBank()">+</button>
                                    <button type="button" class="addOrSubButton" onclick="subBank()">-</button>
                                </div>
                            </div>
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
<div class="view-co-borrower-con-1">

    <!-- * Container 1: Co-Borrower New Application Form Fields and Buttons -->
    <div class="view-inner-con-1">

        <!-- * Big Container -->
        <div class="big-con">

            <!-- * Form Header -->

            <!-- * Rowspan 1: Rowspan Header: Header and Buttons -->
            <div class="rowspan">

                <!-- * Header Wrapper -->
                <div class="header-wrapper">
                    <div class="header-inner-wrapper">
                        <!-- <div class="box-wrapper">
                            <img src="{{ URL::to('/') }}/assets/icons/arrow-left.svg" alt="Left Button" data-back-to-members-table>
                        </div> -->
                        <div class="box-wrapper">
                            <h2>Co-Maker Information</h2>
                        </div>
                    </div>
                    <!-- <button type="button" id="data-open-loan-details">View loan & payment history</button> -->
                </div>

                <!-- * Buttons -->
                <!-- <div class="btn-wrapper"> -->

                <!-- * Save -->
                <!-- <button type="button" id="saveBtn" class="button" data-save>Save</button>

                </div> -->

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

                            <div class="option" data-option-item4>

                                <input type="radio" class="radio" name="category" value="Male" />
                                <label for="Male">
                                    <h4>Male</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item4>

                                <input type="radio" class="radio" name="category" value="Female" />
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

                                <input type="radio" class="radio" name="category" value="Married" />
                                <label for="Married">
                                    <h4>Married</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item5>

                                <input type="radio" class="radio" name="category" value="Single" />
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

                <!-- * Relationship to the Borrower -->
                <div class="input-wrapper">
                    <span> Relationship to the Borrower</span>
                    <input type="text" id="relatioshipToBorrower" name="relatioshipToBorrower">
                    </input>
                </div>

            </div>

            <!-- * Rowspan 8: Empty Rowspan -->
            <!-- <div class="rowspan"> -->
            <!-- <button type="button" class="viewLoanDetailsButton" id="data-open-loan-details">View loan & payment history</button> -->
            <!-- </div> -->

        </div>

        <!-- * Small Container -->
        <div class="small-con">

            <div class="box-wrap">

                <!-- * Colspan 1: Upload Image and Attach Files Buttons  -->
                <div class="colspan">

                    <!-- * Upload Image -->
                    <div class="input-wrapper" data-upload-image-co-borrower-hover-container>
                        <img type="image" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" data-co-borrower-image-container>
                    </div>

                    <div class="btn-wrapper">
                        <!-- * Upload Button -->
                        <input type="file" class="input-image upload-profile-image-btn" data-upload-co-borrower-image-btn></input>
                        <!-- * Attach Button -->
                        <button type="button" class="button">Attach Files</button>
                    </div>

                    <div class="btn-wrapper">
                        <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">File.png</button>
                        <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.pdf">File.pdf</button>
                    </div>

                    <button type="button" class="transparentButton3">Show All</button>
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

                            <input type="radio" class="radio" name="category" value="Unemployed" />
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

                    <!-- * Yes -->
                    <div class="radio-btn-wrapper">
                        <input autocomplete="off" type="radio" name="formToggle" value="formToggleYes" id="formToggleYes">
                        <span>Yes</span>
                    </div>

                    <!-- * No -->
                    <div class="radio-btn-wrapper">
                        <input autocomplete="off" type="radio" name="formToggle" value="formToggleNo" id="formToggleNos">
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
                        <img id="applicantSignature">
                        <span>Applicant’s Signature</span>
                    </div>
                </div>

                <!-- * Upload Applicant Signature Button -->
                <div class="input-wrapper">
                    <input type="file" class="input-image" id="imageUploadApplicantSign">
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
                        <img id="coMakerSignature">
                        <span>Co-Maker Signature</span>
                    </div>
                </div>

                <!-- * Upload Co-Maker Signature Button -->
                <div class="input-wrapper">
                    <input type="file" class="input-image" id="imageUploadCoMakerSign">
                </div>

            </div>

        </div>


    </div>

</div>

</form>
</div>
