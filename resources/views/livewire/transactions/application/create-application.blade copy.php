<div >       
    @if(session('errmmessage'))
        <x-alert :message="session('errmmessage')" :words="'Action not successfull'" :header="'Error'"></x-alert>   
    @endif
    @if(session('mmessage'))
        <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
    @if($showDialog == 1)
        <x-dialog :message="'Are you sure you want to Permanently delete the selected data? '" :xmid="$mid" :confirmaction="'archive'" :header="'Deletion'"></x-dialog>   
    @endif
    @if($showDialog == 1)
        <x-asking-dialog :message="'Are you sure you want to Permanently delete the selected data? '" :xmid="$mid" :confirmaction="'archive'" :header="'Deletion'"></x-asking-dialog>   
    @endif

    <!-- * New-Application-Form-Container -->
    <form action="" class="na-form-con" autocomplete="off" >
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    <!-- * New Application Progress Bar Container -->
    <div class="na-progress-bar-container">
        <div class="progress-bar-level">

            <!-- * New Application Registration Level 1 -->
            <div class="level level1 active">
                <span>Registration</span>
            </div>

            <!-- * New Application Credit Investigation Level 2 -->
            <div class="line {{ $member['statusID'] >= 8 ? 'active' : '' }}" data-level-2></div>
            <div wire:click="viewByStatus('8')" class="level {{ $member['statusID'] >= 8 ? 'active' : '' }}" data-level-2>
                <span>Credit<br>Investigation</span>
            </div>

            <!-- * New Application Approval Level 3 -->
            <div class="line line3 {{ $member['statusID'] >= 9 ? 'active' : '' }}"></div>
            <div class="level level3 {{ $member['statusID'] >= 9 ? 'active' : '' }}">
                <span>Approval</span>
            </div>

            <!-- * New Application Releasing Level 4 -->
            <div class="line line3 {{ $member['statusID'] >= 10 ? 'active' : '' }}"></div>
            <div class="level level4 {{ $member['statusID'] >= 10 ? 'activeGreen' : '' }}">
                <span>Releasing</span>
            </div>

        </div>
    </div>

    @if($errors->any())
    <div class="na-requirements-sec">
        @foreach ($errors->all() as $error)
            <span class="text-required"><li>{{ $error }}</li></span>
        @endforeach       
    </div>
    @endif
    
    @if($member['statusID'] == 8)
                

                <!-- * New Application Notes and Remarks Section -->
                <div class="na-notes-remarks-sec">
                    <div class="wrapper-1">
                        <h3>Notes/Remarks</h3>
                        <div class="btn-wrapper">
                            <!-- <a href="new-application-approval.html"> -->
                                <button type="button" wire:click="submitForApproval" class="button" data-submit-for-approval>Submit for approval</button>
                            <!-- </a> -->
                            <button type="submit" class="declineButton" data-open-application-decline>Decline</button>
                        </div>
                    </div>
                    <textarea wire:model.lazy="loanDetails.remarks" class="wrapper-2"></textarea>

                </div>
    @elseif(in_array($member['statusID'], [9, 10, 15]))
    <div class="na-releasing-sec">

        <!-- * Rowspan 1: Loan Details Header -->
        <div class="rowspan">
            <div class="header-wrapper">
                <h3>Loan Details</h3>
                <button type="button" class="viewLoanDetailsButton" data-open-receipt-voucher>View Loan Summary</button>
            </div>
        </div>
            <!-- * Receipt Voucher Modal -->
            <dialog class="na-receipt-voucher-modal" data-receipt-voucher-modal>

            <!-- * Modal Container -->
            <div class="modal-container">

                <!-- * Receipt Voucher Container -->
                <div class="receipt-voucher-container">

                    <!-- * Button Wrapper -->
                    <div class="button-wrapper">
                        <button type="button" data-close-receipt-voucher>
                            <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="close">
                        </button>
                    </div>

                    <!-- * Header Wrapper -->
                    <div class="header-wrapper">
                        <p>LOAN SUMMARY</p>
                        <!-- <p>GOLD ONE VICTORY FINANCIAL CONSULTANCY</p>
                        <p>BALAGTAS, BULACAN</p>
                        <p>RECEIPT VOUCHER</p> -->
                    </div>

                    <!-- * Body Wrapper -->
                    <div class="body-wrapper">
                        <div class="box-wrapper">
                            <!-- * Box-1 -->
                            <div class="box">
                                <p>NAME: <span id="printClientName"> {{ $member['fname'] }}, {{ $member['lname'] }} {{ mb_substr($member['mname'], 0, 1) }}.</span></p>
                                <p class="p-bold">{{ isset($loansummary['areaName']) ? $loansummary['areaName'] : 'not found' }}</p>
                                <div class="box-inner">
                                    <div class="box-inner-wrapper">
                                        <p>DATE:</p> 
                                        <span id="printDate">{{ isset($loansummary['date']) ? date('F j, Y', strtotime($loansummary['date'])) : 'not found' }}</span>
                                    </div>
                                    <div class="box-inner-wrapper">
                                        <p>DUE-DATE:</p> 
                                        <span id="printDueDate">{{ isset($loansummary['date']) ? date('F j, Y', strtotime($loansummary['date'])) : 'not found' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- * Box-2 -->
                            <div class="box">
                                <div class="box-inner">
                                    <div class="box-inner-wrapper">
                                        <p>LOAN AMOUNT:</p>
                                        <span id="">{{ isset($loansummary['principalLoan']) ? number_format($loansummary['principalLoan'], 2) : 'not found' }}</span>
                                    </div>
                                    <div class="box-inner-wrapper">
                                        <p>INTEREST RATE:</p>
                                        <span id="">{{ isset($loansummary['interestRate']) ? $loansummary['interestRate'] * 100 : 'not found' }}%</span>
                                    </div>
                                    <div class="box-inner-wrapper">
                                        <p>NOTARIAL FEE:</p>
                                        <span id=""></span>
                                    </div>
                                    <div class="box-inner-wrapper">
                                        <p>LOAN INSURANCE:</p>
                                        <span id=""></span>
                                    </div>
                                    <div class="box-inner-wrapper">
                                        <p>LOAN RECEIVABLE:</p>
                                        <span id=""></span>
                                    </div>
                                    <div class="box-inner-wrapper p-red-text">
                                        <p class="p-red-text">FIRST PAYMENT:</p>
                                        <span id="">{{ isset($loansummary['total_InterestAmount']) ? number_format($loansummary['total_InterestAmount'], 2) : 'not found' }}</span>
                                    </div>
                                </div>
                                <div class="box-inner">
                                    <p>{{ isset($loansummary['loanAmount']) ? number_format($loansummary['loanAmount'], 2) : 'not found' }}</p>
                                    <p>{{ isset($loansummary['total_InterestAmount']) ? number_format($loansummary['total_InterestAmount'], 2) : 'not found' }}</p>
                                    <p>{{ isset($loansummary['notarialFee']) ? number_format($loansummary['notarialFee'], 2) : 'not found' }}</p>
                                    <p class="underline">{{ isset($loansummary['loanInsurance']) ? number_format($loansummary['loanInsurance'], 2) : 'not found' }}</p>
                                    <p class="underline-thick">{{ isset($loansummary['total_LoanReceivable']) ? number_format($loansummary['total_LoanReceivable'], 2) : 'not found' }}</p>
                                </div>
                            </div>
                            <!-- * Box-3 -->
                            <!-- <div class="box">
                                <p class="p-red-text">FIRST PAYMENT: <span id="">138</span></p>
                            </div> -->
                            <!-- * Box-4 -->
                            <div class="box">
                                <div class="box-inner">
                                    <div class="box-inner-wrapper">
                                        <p>PREPARED BY:</p>
                                        <span id="">{{ session()->get('auth_name') }}</span>
                                    </div>
                                    <div class="box-inner-wrapper">
                                        <p>APPROVED BY:</p>
                                        <span id="">{{ isset($loansummary['app_ApprovedBy_2']) ? $loansummary['app_ApprovedBy_2'] : 'not found' }}</span>
                                    </div>
                                    <div class="box-inner-wrapper">
                                        <p>RELEASED THRU CASH</p>
                                    </div>
                                </div>
                                <div class="box-inner">
                                    <div class="box-inner-wrapper">
                                        <p>RECEIVED FROM:</p>
                                        <span id="">GOLD ONE VICTORY LENDING CORPORATION</span>
                                    </div>
                                    <div class="box-inner-wrapper">
                                        <p>AMOUNT RECEIVED:</p> 
                                        <span id="">{{ isset($loansummary['total_LoanReceivable']) ? number_format($loansummary['total_LoanReceivable'], 2) : 'not found' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- * Box-5 -->
                            <!-- <div class="box">
                                <div class="box-inner">
                                    <p class="p-bold line-sig">CO-MAKER</p>
                                    <p>CONTACT NO.</p>
                                </div>
                                <div class="box-inner">
                                    <p class="p-bold line-sig">CLIENT</p>
                                    <p>CONTACT NO.</p>
                                </div>
                            </div> -->
                        </div>
                    </div>

                </div>

            </div>

            </dialog>
            <script>
                //loan summary
                const receiptVoucherModal = document.querySelector('[data-receipt-voucher-modal]')
                const openReceiptVoucherModal = document.querySelector('[data-open-receipt-voucher]')

                // * If this element is in the DOM, run else do nothing
                if (receiptVoucherModal && openReceiptVoucherModal) {
                    const closeReceiptVoucherModal = document.querySelector('[data-close-receipt-voucher]')


                    openReceiptVoucherModal.addEventListener('click', () => {
                        receiptVoucherModal.showModal();
                    })

                    closeReceiptVoucherModal.addEventListener('click', () => {
                        receiptVoucherModal.setAttribute("closing", "");
                        receiptVoucherModal.addEventListener("animationend", () => {
                            receiptVoucherModal.removeAttribute("closing");
                            receiptVoucherModal.close();
                        }, { once: true });
                    })
                    
                }
                
            </script>
        @if(in_array($member['statusID'], [10, 15]))
        <!-- * Rowspan 2: Mode of Release and Denomination and Check Number Toggle -->
        <div class="rowspan">

            <!-- * Mode of Release -->
            <div class="input-wrapper">
                <span>Mode of Release</span>
                <div class="select-box">

                    <div class="options-container " data-option-con10>

                        <div class="option" data-option-item10>

                            <input type="radio" wire:model.lazy="loanDetails.modeOfRelease" class="radio" id="modeOfRelease1" name="modeOfRelease" value="Cash" />
                            <label for="modeOfRelease1">
                                <h4>Cash</h4>
                            </label>

                        </div>

                        <div class="option" data-option-item10>

                            <input type="radio" wire:model.lazy="loanDetails.modeOfRelease" class="radio" id="modeOfRelease2" name="modeOfRelease" value="Check" />
                            <label for="modeOfRelease2">
                                <h4>Check</h4>
                            </label>

                        </div>

                    </div>

                    <div class="selected {{ $member['statusID'] == 10 ? 'inpt-editable' : '' }}" style="font-weight: bold;" data-option-select10>
                        {{ isset($loanDetails['modeOfRelease']) ? $loanDetails['modeOfRelease'] : '' }}
                    </div>                    
                </div>
                @error('loanDetails.modeOfRelease') <span class="text-required">{{ $message }}</span> @enderror
            </div>

            <!-- * Denomination -->
            @if(isset($loanDetails['modeOfRelease']))               
                <div class="input-wrapper" data-toggle-mor-1>
                    @if($loanDetails['modeOfRelease'] == 'Cash')
                        <span>Denomination <img class="img-edit" style="{{ in_array($member['statusID'], [10]) ? 'visibility: visible' : '' }}" src="{{ URL::to('/') }}/assets/icons/modal-icon/asking.svg" alt=""></span>
                        <input autocomplete="off" wire:model.lazy="loanDetails.denomination" class="{{ $member['statusID'] == 10 ? 'inpt-editable' : '' }}" type="text" id="denomination" name="denomination">
                    @endif
                    @if($loanDetails['modeOfRelease'] == 'Check')
                        <span>Check Number</span>
                        <input autocomplete="off" wire:model.lazy="loanDetails.denomination" class="{{ $member['statusID'] == 10 ? 'inpt-editable' : '' }}" type="text" id="denomination" name="denomination">
                    @endif
                   
                    @error('loanDetails.denomination') <span class="text-required">{{ $message }}</span> @enderror
                </div>                                            
            @endif

        </div>
        <script>
            const selectedOpt10 = document.querySelector('[data-option-select10]');

            if (selectedOpt10) {

                const optionsContainer10 = document.querySelector('[data-option-con10]');
                const optionsList10 = document.querySelectorAll('[data-option-item10]');

                selectedOpt10.addEventListener("click", () => {
                    optionsContainer10.classList.toggle("active");
                });

                optionsList10.forEach(option => {
                    option.setAttribute('value', option.children[0].value)
                    option.addEventListener("click", () => {
                        selectedOpt10.innerHTML = option.querySelector("label").innerHTML;
                        optionsContainer10.classList.remove("active");
                        selectedOpt10.setAttribute('value', option.children[0].value);
                    });
                });
            }

        </script>
        @endif

        <!-- * Rowspan 2: Loan Type, Loan Amount, Purpose, and Approve for Releasing Button -->
        <div class="rowspan">

            <!-- * Loan Type -->
            <div class="input-wrapper">
                <span>Loan Type</span>
                <input wire:model.lazy="loanDetails.loanType" disabled autocomplete="off" type="text">
            </div>

            <!-- * Loan Amount -->
            <div class="input-wrapper">
                <span>Loan Amount</span>
                <input wire:model.lazy="loanDetails.loanAmount"  disabled autocomplete="off" type="text" >
                @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror
                <!-- dito -->
            </div>

            <!-- * Purpose --> 
            <!-- * Terms of Payment -->
            <div class="input-wrapper">
                <span>Terms of Payment</span>
                <!-- <input disabled wire:model.lazy="loanDetails.terms" autocomplete="off" type="text" > -->
                <div class="select-box"  style="{{ in_array($member['statusID'], [10, 15]) ? 'pointer-events: none; color: #808080;' : '' }}">

                                <div class="options-container" data-type-opt-con>
                     
                                    @if(isset($termsOfPaymentList))
                                        @foreach($termsOfPaymentList as $topList)
                                        <div class="option" data-type-loan-opt data-individual-loan-link>

                                            <input type="radio" wire:model="loanDetails.topId" class="radio" value="{{ $topList['topId'] }}" id="topId{{ $topList['topId'] }}" name="top" />
                                            <label for="topId{{ $topList['topId'] }}">
                                                <h4>{{ $topList['termsofPayment'] }}</h4>
                                            </label>

                                        </div>
                                        @endforeach
                                    @endif
                                    
                                </div>
                                
                                <div class="selected" style="font-weight: bold;" data-type-loan-select>
                                    {{ $getLoanTermsname != '' ? $getLoanTermsname : $loanDetails['loantermsName'] }}
                                </div>

                </div>
                @error('loanDetails.topId') <span class="text-required">{{ $message }}</span> @enderror
            </div>

            <script>
                              
            const selected = document.querySelector('[data-type-loan-select]')
            const optionsContainer = document.querySelector('[data-type-opt-con')
            const optionsList = document.querySelectorAll('[data-type-loan-opt]')

            selected.addEventListener("click", () => {
                optionsContainer.classList.toggle("active");
            });

            optionsList.forEach(option => {
                option.addEventListener("click", () => {
                    //selected.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer.classList.remove("active");
                });
            });  
            </script>          
           
        
            @if($member['statusID'] == 9)   
               
                    <div class="input-wrapper">   
                        @if($loanDetails['app_ApprovedBy_1'] != '')             
                            @if($loanDetails['app_ApprovedBy_1'] == session()->get('auth_userid'))
                                <p style="font-size:1.5rem;color:darkgoldenrod; text-align: center;">Waiting for Approval...</p>  <!-- This will show if same user is  approved this application-->
                                <p style="font-size:1.5rem;color:darkgoldenrod; text-align: center;">
                                    Initial approval last 
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['years'] > 0) <span style="font-weight: bold; font-size:1.6rem;">{{ $loanDetails['app_ApprovalDate_1_timeint']['years'] }} Years</span> @endif
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['months'] > 0) <span style="font-weight: bold; font-size:1.6rem;">{{ $loanDetails['app_ApprovalDate_1_timeint']['months'] }} Months</span> @endif
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['days'] > 0) <span style="font-weight: bold; font-size:1.6rem;">{{ $loanDetails['app_ApprovalDate_1_timeint']['days'] }} Days</span> @endif
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['hours'] > 0) <span style="font-weight: bold; font-size:1.6rem;">{{ $loanDetails['app_ApprovalDate_1_timeint']['hours'] }} Hours</span> @endif
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['hours'] > 0) <span style="font-weight: bold; font-size:1.6rem;">{{ $loanDetails['app_ApprovalDate_1_timeint']['minutes'] }} Minutes</span> @endif                                    
                                    ago
                                </p>
                            @else
                                <p style="font-size:1.5rem;color:green;">Approved By: {{ $loanDetails['app_ApprovedBy_1_name'] }}  </p>                                                                                  
                                <p style="font-size:1.5rem;color:green;">
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['years'] > 0) <span id="ciTimeWeek">{{ $loanDetails['app_ApprovalDate_1_timeint']['years'] }} Years</span> @endif
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['months'] > 0) <span id="ciTimeWeek">{{ $loanDetails['app_ApprovalDate_1_timeint']['months'] }} Months</span> @endif
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['days'] > 0) <span id="ciTimeDay">{{ $loanDetails['app_ApprovalDate_1_timeint']['days'] }} Days</span> @endif
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['hours'] > 0) <span id="ciTimeHour">{{ $loanDetails['app_ApprovalDate_1_timeint']['hours'] }} Hours</span> @endif
                                    @if($loanDetails['app_ApprovalDate_1_timeint']['hours'] > 0) <span id="ciTimeHour">{{ $loanDetails['app_ApprovalDate_1_timeint']['minutes'] }} Minutes</span> @endif
                                    ago
                                </p>  <!-- this will show to another approving officer-->                                                            
                            @endif          
                        @endif    
                        @if($loanDetails['app_ApprovedBy_1'] != session()->get('auth_userid'))
                            <button type="button" wire:click="approveForReleasing" class="button">Approve for Releasing</button>                                   
                        @endif                                                      
                    </div>       
                            
            @elseif($member['statusID'] == 10)
            <!-- * Approve for Releasing Button -->
            <div class="input-wrapper input-wrapper-release">
                <button type="button" wire:click="signForRelease" class="releaseButton" data-sign-for-releasing-button>Sign For Releasing</button>
            </div>
            @elseif($member['statusID'] == 15)
            <div class="input-wrapper input-wrapper-release">
                <button type="button" wire:click="completeApplication" class="releaseButton" data-application-complete-button>Complete</button>
            </div>
            @endif

        </div>

        <!-- * Rowspan 3: Terms of Payment, Number of No Payment, Number of Loans, and Change Loan Payment Button -->
        <div class="rowspan">

            <div class="input-wrapper">
                <span>Purpose</span>
                <input wire:model.lazy="loanDetails.purpose" disabled autocomplete="off" type="text" >
            </div>

           
            @if($member['statusID'] == 9)   
             <!-- * Number of No Payment -->
            <div class="input-wrapper">
                <span>Total Savings</span>
                <input wire:model.lazy="loanDetails.totalSavingsAmount" disabled autocomplete="off" type="number">
                @error('loanDetails.totalSavingsAmount') <span class="text-required">{{ $message }}</span> @enderror
            </div>

            <!-- * Number of Loans -->
            <div class="input-wrapper">
                <span>Notarial Fee</span>
                <input wire:model.lazy="loanDetails.notarialFee" autocomplete="off" type="number">
                @error('loanDetails.notarialFee') <span class="text-required">{{ $message }}</span> @enderror
            </div>
            @endif

            @if($member['statusID'] == 10)   
             <!-- * Number of No Payment -->
            <div class="input-wrapper">
                <span>Total Savings</span>
                <input wire:model.lazy="loanDetails.totalSavings" disabled autocomplete="off" type="number">
                @error('loanDetails.savings') <span class="text-required">{{ $message }}</span> @enderror
            </div>

            <!-- * Number of Loans -->
            <div class="input-wrapper">
                <span>Savings To Be Use</span>
                <input wire:model.lazy="loanDetails.savingsToUse" class="{{ $member['statusID'] == 10 ? 'inpt-editable' : '' }}" autocomplete="off" type="number">
                @error('loanDetails.notarialFee') <span class="text-required">{{ $message }}</span> @enderror
            </div>
            @endif

            @if(in_array($member['statusID'], [9]))    
            <!-- * Change Loan Payment -->
            <!-- <div class="input-wrapper">
                <button type="button" class="button">Change Loan Payment</button>
            </div> -->
            @else
                <div class="input-wrapper input-wrapper-decline">
                    <button type="button" class="declineButton" data-open-application-decline>Decline</button>
                </div>
            @endif

        </div>

        @if($member['statusID'] == 9)   
        <div class="rowspan">

            <div class="input-wrapper">
                <span>Advance Payment</span>
                <input wire:model.lazy="loanDetails.advancePayment" autocomplete="off" type="text" >
                @error('loanDetails.advancePayment') <span class="text-required">{{ $message }}</span> @enderror
            </div>

            <!-- * Number of No Payment -->
            <div class="input-wrapper">
                <span>Interest</span>
                <input wire:model.lazy="loanDetails.total_InterestAmount" autocomplete="off" type="number">
                @error('loanDetails.interest') <span class="text-required">{{ $message }}</span> @enderror
            </div>

            <!-- * Number of Loans -->
            <div class="input-wrapper" style="padding-bottom: 0;">
                <span>Releasing Amount</span>
                <input wire:model.lazy="loanDetails.total_LoanReceivable" autocomplete="off" type="number">
                @error('loanDetails.total_LoanReceivable') <span class="text-required">{{ $message }}</span> @enderror
            </div>
             <!-- * Decline Button -->
             @if($member['statusID'] == 9)    
            <div class="input-wrapper input-wrapper-decline">
                <button type="button" class="declineButton" data-open-application-decline>Decline</button>
            </div>
            @elseif($member['statusID'] == 10)  
            <!-- <div class="input-wrapper input-wrapper-decline">
                <button type="button" class="declineButton">Cancel</button>
            </div>   -->
            @endif
        </div>
        @endif

        <div class="rowspan">

            @if($member['statusID'] == 9)   
            <div class="input-wrapper">
                <span>Daily Amount Due</span>
                <input wire:model.lazy="loanDetails.dailyCollectibles" autocomplete="off" type="text" >
                @error('loanDetails.dailyCollectibles') <span class="text-required">{{ $message }}</span> @enderror
            </div>
            @endif

            <!-- * Number of No Payment -->
            <div class="input-wrapper">
                <span>Number of No Payment</span>
                <input disabled wire:model.lazy="loanDetails.noofnopayment" autocomplete="off" type="number">
            </div>

            <!-- * Number of Loans -->
            <div class="input-wrapper">
                <span>Number of Loans</span>
                <input disabled wire:model.lazy="loanDetails.noofloans" autocomplete="off" type="number">
            </div>
             
        </div>

        <!-- * Rowspan 4: Approved by:, Notes and Decline Button -->
        <div class="rowspan">

            <!-- * Approved by: -->
            <div class="input-wrapper">
                <span>Approved by (From CI) :</span>
                <input disabled wire:model.lazy="loanDetails.approvedBy" autocomplete="off" type="text" id="approvedBy" name="approvedBy">
            </div>

            <!-- * Notes -->
            <div class="input-wrapper">
                <span>Notes &nbsp;<p>(if approving officer is not available)</p></span>
                <input {{ in_array($member['statusID'], [10, 15]) ? 'disabled' : '' }} wire:model.lazy="loanDetails.notes" autocomplete="off" type="text" >
            </div>

        </div>

        </div>    
        
        @if(in_array($member['statusID'], [10, 15]))
                <div class="na-cash-courier">

                    <!-- * Small Container -->
                    <div class="small-con-2">

                        <!-- * Rowspan 1: Header -->
                        <div class="rowspan">

                            <!-- * Cash and Courier -->
                            <div class="input-wrapper">
                                <h2>Cash and Courier</h2>
                            </div>

                        </div>

                        <!-- * Rowspan 2: Employee or Client Toggle -->
                        <div class="rowspan">

                            <!-- * Employee and Client Radio Buttons -->
                            <div class="input-wrapper">

                                <div class="box-wrap">

                                    <!-- * Employee -->
                                    <div class="radio-btn-wrapper">
                                        <span>Employee</span>
                                        <input autocomplete="off" type="radio" wire:model.lazy="loanDetails.courier" name="courier" value="Employee" id="employee">
                                    </div>

                                    <!-- * Client -->
                                    <div class="radio-btn-wrapper">
                                        <span>Client</span>
                                        <input autocomplete="off" type="radio" wire:model.lazy="loanDetails.courier" name="courier" value="Client" id="client">
                                    </div>

                                </div>
                                @error('loanDetails.courier') <span class="text-required">{{ $message }}</span> @enderror
                            </div>
                            @if(isset($loanDetails['courier']))
                            <div class="toggle-container">

                                @if($loanDetails['courier'] == 'Employee')
                                <!-- * Search Wrapper -->
                                <div class="input-wrapper" data-employee-search-toggle>
                                    <span>Employee Name</span>
    
                                    <!-- * Primary Search Bar -->
                                    <div class="primary-search-bar">
                                        <div class="row">
                                            <input wire:model.lazy="loanDetails.courieremployee" wire:click="openSearchEmployee" style="{{ $member['statusID'] == 10 ? 'border: 1px solid #d6a330 !important;' : '' }} font-size: 1.3rem;" type="search" placeholder="Search" autocomplete="off">
                                            <button type="button">                                                
                                            </button>
                                        </div>
                                        <div  class="result-box" data-search-results>
                                        </div>
                                    </div>
                                    @error('loanDetails.courieremployee') <span class="text-required">{{ $message }}</span> @enderror
                                </div>                                
                                @endif
    
                                @if($loanDetails['courier'] == 'Client')
                                <!-- * Client Name -->
                                <div class="input-wrapper" data-client-name-toggle>
                                    <div class="input-wrapper">
                                        <span>Client Name</span>
                                        <input wire:model.lazy="loanDetails.courierclient" class="{{ $member['statusID'] == 10 ? 'inpt-editable' : '' }}" autocomplete="off" type="text" >
                                        @error('loanDetails.courierclient') <span class="text-required">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                @endif

                            </div>

                            @if($loanDetails['courier'] != '')
                            <!-- * Contact Number -->
                            <div class="input-wrapper" data-contact-number-toggle>
                                <div class="input-wrapper">
                                    <span>Contact No:</span>
                                    <input wire:model.lazy="loanDetails.couriercno" class="{{ $member['statusID'] == 10 ? 'inpt-editable' : '' }}" autocomplete="off" type="number">
                                    @error('loanDetails.couriercno') <span class="text-required">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @endif
                            @endif


                        </div>

                    </div>

                </div>
        @endif
    @endif            

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
                        <button type="button" class="viewLoanDetailsButton" id="data-open-loan-details">View loan & payment history</button>
                    </div>

                    <!-- * Buttons -->
                    <div class="btn-wrapper">

                        <!-- * Save -->
                        @if($type == 'create')
                        <button wire:click="store(1)" type="button" wire:loading.attr="disabled" class="button" data-save>Save</button>

                        <!-- * Save & Apply for loan -->
                        <a href="#">
                            <button type="button" wire:click="store(2)"  wire:loading.attr="disabled" class="button" onclick="activeProgressButton()" data-proceed-to-ci>Save & Proceed to CI</button>
                        </a>
                        @elseif($type == 'view')
                            @if($member['statusID'] == 7)
                                <button wire:click="update(1)" type="button" class="button" data-save>Update</button>
                                <button wire:click="update(2)" onclick="showAskingDialog()" type="button" class="button" data-save>Submit And Proceed to CI</button>                      
                            @elseif($member['statusID'] == 8)
                                <div class="CI-time-wrapper">
                                    <img src="{{ URL::to('/') }}/assets/icons/time.svg" alt="Time">
                                    <div class="box">
                                        <span>CI Time</span>
                                        <span id="ciTime">
                                            @if($loanDetails['ci_time']['years'] > 0) <span id="ciTimeWeek">{{ $loanDetails['ci_time']['years'] }}</span>Y @endif
                                            @if($loanDetails['ci_time']['months'] > 0) <span id="ciTimeWeek">{{ $loanDetails['ci_time']['months'] }}</span>M @endif
                                            @if($loanDetails['ci_time']['days'] > 0) <span id="ciTimeDay">{{ $loanDetails['ci_time']['days'] }}</span>D @endif
                                            @if($loanDetails['ci_time']['hours'] > 0) <span id="ciTimeHour">{{ $loanDetails['ci_time']['hours'] }}</span>H @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                        @elseif($type == 'add')
                            <button wire:click="store" type="button" class="button" data-save>Add To Group</button>    
                        @endif

                    </div>

                </div>

                <!-- * Rowspan 2: First Name, Middle Name , Last Name, and Suffix -->
                <div class="rowspan">

                    <!-- * First Name -->
                    <div class="input-wrapper">
                        <span>First Name</span>
                        <input wire:model.lazy="member.fname" autocomplete="off" type="text">
                        @error('member.fname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Middle Name -->
                    <div class="input-wrapper">
                        <span>Middle Name</span>
                        <input wire:model.lazy="member.mname" autocomplete="off" type="text">
                        @error('member.mname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Last Name -->
                    <div class="input-wrapper">
                        <span>Last Name</span>
                        <input wire:model.lazy="member.lname"  autocomplete="off" type="text">
                        @error('member.lname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Suffix -->
                    <div class="input-wrapper">
                        <span>Suffix</span>
                        <input wire:model.lazy="member.suffix" autocomplete="off" type="text">
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

                                    <input type="radio"  wire:model.lazy="member.gender" class="radio" id="Male" value="Male" />
                                    <label for="Male">
                                        <h4>Male</h4>
                                    </label>

                                </div>

                                <div class="option"  data-option-item1>

                                    <input type="radio" wire:model.lazy="member.gender" class="radio" id="Female" value="Female"/>
                                    <label for="Female">
                                        <h4>Female</h4>
                                    </label>

                                </div>

                            </div>
                            
                            <div class="selected" style="font-weight: bold;" data-option-select1>
                                {{ isset($member['gender']) ? $member['gender'] : '' }}
                            </div>

                        </div>
                        @error('member.gender') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Date Of Birth -->
                    <div class="input-wrapper">
                        <span>Date Of Birth</span>
                        <input wire:model.lazy="member.dob" wire:change="getmemberAge" autocomplete="off" type="date"  >
                        @error('member.dob') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Age -->
                    <div class="input-wrapper">
                        <span>Age</span>
                        <input wire:model.lazy="member.age" disabled="disabled"  autocomplete="off" type="number"  >
                        @error('member.age') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Place Of Birth -->
                    <div class="input-wrapper">
                        <span>Place Of Birth</span>
                        <input wire:model.lazy="member.pob" autocomplete="off" type="text"  >
                        @error('member.pob') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Civil Status -->
                    <div class="input-wrapper">
                        <span>Civil Status</span>
                        <div class="select-box">

                            <div class="options-container" data-option-con2>

                                <div class="option" data-option-item2>

                                    <input wire:model="member.civil_Status" type="radio" class="radio" id="mem_Widow" value="Widow" />
                                    <label for="mem_Widow">
                                        <h4>Widow</h4>
                                    </label>

                                </div>

                                <div class="option" data-option-item2>

                                    <input wire:model="member.civil_Status" type="radio" class="radio" id="mem_Married" value="Married"/>
                                    <label for="mem_Married">
                                        <h4>Married</h4>
                                    </label>

                                </div>

                                <div class="option" data-option-item2>

                                    <input wire:model="member.civil_Status" type="radio" class="radio" id="mem_Single" value="Single"/>
                                    <label for="mem_Single">
                                        <h4>Single</h4>
                                    </label>

                                </div>

                            </div>
                            
                            <div class="selected" style="font-weight: bold;" data-option-select2>
                                {{ isset($member['civil_Status']) ? $member['civil_Status'] : '' }}
                            </div>

                        </div>
                        @error('member.civil_Status') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                </div>

                <!-- * Rowspan 4: Contact Number and Email Address -->
                <div class="rowspan">

                    <!-- * Contact Number -->
                    <div class="input-wrapper">
                        <div class="input-wrapper">
                            <span>Contact Number</span>
                            <input wire:model.lazy="member.cno" autocomplete="off" type="number">
                            @error('member.cno') <span class="text-required">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <!-- * Email Address -->
                    <div class="input-wrapper">
                        <div class="input-wrapper">
                            <span>Email Address</span>
                            <input wire:model.lazy="member.emailAddress" autocomplete="off" type="email">
                            @error('member.emailAddress') <span class="text-required">{{ $message }}</span>@enderror
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
                                <input  wire:model.lazy="member.house_Stats" autocomplete="off" type="radio" value="1" name="house_Stats" id="mem_rented">
                            </div>

                            <!-- * Owned -->
                            <div class="radio-btn-wrapper">
                                <span>Owned</span>
                                <input  wire:model.lazy="member.house_Stats" autocomplete="off" type="radio" value="2" name="house_Stats" id="mem_owned">
                            </div>

                            <!-- * Free Use -->
                            <div class="radio-btn-wrapper">
                                <span>Free Use</span>
                                <input  wire:model.lazy="member.house_Stats" autocomplete="off" type="radio" value="3" name="house_Stats" id="mem_freeUse">
                            </div>

                        </div>
                        @error('member.house_Stats') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * House No./ Bldg. No./ Room No./ Subdivision/ Street -->
                    <div class="input-wrapper">
                        <span>House No./ Bldg. No./ Room No./ Subdivision/ Street</span>
                        <input wire:model.lazy="member.houseNo" autocomplete="off" type="text">
                        @error('member.houseNo') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                </div>

                <!-- * Rowspan 6: Barangay, City / Municipality, Province / Region, and Country -->
                <div class="rowspan">

                    <!-- * Barangay -->
                    <div class="input-wrapper">
                        <span>Barangay</span>
                        <input wire:model.lazy="member.barangay" autocomplete="off" type="text" >
                        @error('member.barangay') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * City / Municipality -->
                    <div class="input-wrapper">
                        <span>City / Municipality</span>
                        <input wire:model.lazy="member.city" autocomplete="off" type="text">
                        @error('member.city') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Province / Region -->
                    <div class="input-wrapper">
                        <span>Province / Region</span>
                        <input wire:model.lazy="member.province" autocomplete="off" type="text">
                        @error('member.province') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Country -->
                    <div class="input-wrapper">
                        <span>Country</span>
                        <input wire:model.lazy="member.country" autocomplete="off" type="text">
                        @error('member.country') <span class="text-required">{{ $message }}</span>@enderror
                    </div>


                </div>

                <!-- * Rowspan 7: Zip Code and Years Of Stay -->
                <div class="rowspan">

                    <!-- * Zip Code -->
                    <div class="input-wrapper">
                        <span>Zip Code</span>
                        <input wire:model.lazy="member.zipCode" type="number">
                    </div>

                    <!-- * Years Of Stay -->
                    <div class="input-wrapper">
                        <span>Years of stay on the mentioned address</span>
                        <input wire:model.lazy="member.yearsStay" type="number">
                        @error('member.yearsStay') <span class="text-required">{{ $message }}</span>@enderror
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
                            @if(file_exists(public_path('storage/members_profile/'.(isset($this->member['profile']) ? $this->member['profile'] : 'xxxxxxxxx'))))                                
                                <input type="image" class="profile" style="padding: 2px;" src="{{ asset('storage/members_profile/'.$member['profile']) }}" alt="upload-image">                                             
                            @elseif(isset($member['profile']))
                                <input type="image" class="profile" style="padding: 2px;" src="{{ $member['profile']->temporaryUrl() }}" alt="upload-image">                                             
                            @else
                                <input type="image" class="profile" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image">
                            @endif         
                        </div>
                        @error('member.profile') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                        <div class="btn-wrapper">
                            <!-- * Upload Button -->
                            <input type="file"  wire:model="member.profile" class="input-image upload-profile-image-btn" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-borrower-image-btn></input>
                            <!-- * Attach Button -->
                            <input type="file" wire:model="member.attachments" class="input-image attach-file-btn" accept=".txt, .pdf, .docx, .xlsx" multiple data-attach-file-btn></input>
                        </div>
                        @error('member.attachments') <span class="text-required" style="text-align: center;">{{ $message }}</span> @enderror
                        <div class="file-wrapper" data-attach-file-container>
                          
                            @if(isset($member['attachments']))
                                @if($member['attachments'] == $member['old_attachments'])                            
                                        @foreach($member['attachments'] as $attachments)                                                     
                                            <div type="button" class="fileButton">
                                                <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">                                           
                                                @if(file_exists(public_path('storage/members_attachments/'.(isset($attachments) ? $attachments : $attachments->getClientOriginalName() ))))
                                                    @php
                                                        $getfilename = $attachments;
                                                        $filenamearray = explode("_", $getfilename);
                                                        $filename = isset($filenamearray[3]) ? $filenamearray[3] : '';
                                                    @endphp                                               
                                                    <a href="{{ url('storage/members_attachments/'.$attachments) }}" title="{{ $filename }}" target="_blank">                                                                                              
                                                        {{ strlen($filename) > 10 ? strtolower(substr($filename, 0, 10)) . '...' : $filename }}asd
                                                    </a>                                               
                                                @endif                                
                                            </div>                                        
                                        @endforeach
                                @else
                                        @if(isset($member['attachments']))                            
                                            @foreach($member['attachments'] as $attachments)                                                     
                                                <div type="button" class="fileButton">
                                                    <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">
                                                    <a href="" target="_blank" title="{{ $attachments->getClientOriginalName() }}">                                                    
                                                        {{ strlen($attachments->getClientOriginalName()) > 10 ? strtolower(substr($attachments->getClientOriginalName(), 0, 10)) . '...' : $attachments->getClientOriginalName() }}
                                                    </a>                                       
                                                </div>                                                
                                            @endforeach
                                        @endif   
                                @endif  
                            @endif
                         
                        </div>

                    </div>

                </div>

                <div class="box-wrap">

                    <!-- * Colspan 2: Monthly Bills - Electricity Bill, Water Bill, and Daily Expenses -->
                    <div class="colspan">

                        <h3>Monthly Bills <span>(Estimated):</span></h3>

                        <!-- * Electricity Bill -->
                        <div class="input-wrapper">
                            <span>Electricity Bill</span>
                            <input wire:model.lazy="member.electricBill" type="number">
                            @error('member.electricBill') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Water Bill -->
                        <div class="input-wrapper">
                            <span>Water Bill</span>
                            <input wire:model.lazy="member.waterBill" type="number">
                            @error('member.waterBill') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Other Bills -->
                        <div class="input-wrapper">
                            <span>Other Bills</span>
                            <input wire:model.lazy="member.otherBills" type="number">
                            @error('member.otherBills') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Daily Expenses -->
                        <div class="input-wrapper">
                            <span>Daily Expenses</span>
                            <input wire:model.lazy="member.dailyExpenses" type="number">
                            @error('member.dailyExpenses') <span class="text-required">{{ $message }}</span>@enderror
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

                                <input wire:model.lazy="member.emp_Status" type="radio" class="radio" id="Employed" value="1" />
                                <label for="Employed">
                                    <h4>Employed</h4>
                                </label>

                            </div>

                            <div class="option" data-option-item3>

                                <input wire:model.lazy="member.emp_Status" type="radio" class="radio" id="Unemployed" value="0"/>
                                <label for="Unemployed">
                                    <h4>Unemployed</h4>
                                </label>
                            </div>

                        </div>
                        
                        <div class="selected" style="font-weight: bold;" data-option-select3>
                            {{ $member['emp_Status'] != '' ? ($member['emp_Status'] == 1 ? 'Employed' : 'Unemployed') : '' }}
                        </div>

                    </div>
                    @error('member.emp_Status') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Current Job / Position -->
                <div class="input-wrapper">

                    <!-- * Current Job -->
                    @if(isset($member['emp_Status']))
                        @if($member['emp_Status'] == '1' || $member['emp_Status'] == '')
                            <span data-current-job>Current Job / Position</span>
                            <input wire:model.lazy="member.jobDescription"  type="text" data-current-job>
                        @endif
                    @endif

                    <!-- * Previous Job -->
                    @if(isset($member['emp_Status']))
                        @if($member['emp_Status'] == '0')
                        <span  data-previous-job>Previous Job / Position</span>
                        <input wire:model.lazy="member.jobDescription" type="text" data-previous-job>
                        @endif
                    @endif
                    @error('member.jobDescription') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Years Of Service -->
                <div class="input-wrapper">
                    <span>Years Of Service</span>
                    <input wire:model.lazy="member.yos" type="text">
                    @error('member.yos') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Company Name -->
                <div class="input-wrapper">
                    <span>Company Name</span>
                    <input wire:model.lazy="member.companyName" type="text">
                    @error('member.companyName') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 3: Company Address, Monthly Salary, Other Source of Income, and Do you own a Business?  -->
            <div class="rowspan">

                <!-- * Company Address -->
                <div class="input-wrapper">
                    <span>Company Address</span>
                    <input wire:model.lazy="member.companyAddress" type="text">
                    @error('member.companyAddress') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Monthly Salary -->
                <div class="input-wrapper">
                    <span>Monthly Salary</span>
                    <input wire:model.lazy="member.monthlySalary" type="number">
                    @error('member.monthlySalary') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Other Source Of Income -->
                <div class="input-wrapper">
                    <span>Other Source Of Income</span>
                    <input  wire:model.lazy="member.otherSOC" type="text">
                    @error('member.otherSOC') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Do you own a Business?  -->
                <div class="input-wrapper">
                    <span>Do you own a Business?</span>

                    <!-- * Form Toggle -->

                    <div class="box-wrap">

                        <!-- * Rented -->
                        <div class="radio-btn-wrapper">
                            <input  wire:model="member.bO_Status" autocomplete="off" type="radio" name="mem_bO_Status" value="1" >
                            <span>Yes</span>
                        </div>

                        <!-- * Owned -->
                        <div class="radio-btn-wrapper">
                            <input  wire:model="member.bO_Status" autocomplete="off" type="radio" name="mem_bO_Status" value="2">
                            <span>No</span>
                        </div>

                    </div>
                    @error('member.bO_Status') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

        </div>

    </div>

    <!-- * Imported from New Member Application -->
    <!-- * Container 4(a): Family Background Information (Married)-->
    @if(isset($member['civil_Status']))
        @if($member['civil_Status'] == 'Married')
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
                        <input wire:model.lazy="member.f_Fname" autocomplete="off" type="text">
                        @error('member.f_Fname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Middle Name -->
                    <div class="input-wrapper">
                        <span>Middle Name</span>
                        <input wire:model.lazy="member.f_Mname" autocomplete="off" type="text" >
                        @error('member.f_Mname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Last Name -->
                    <div class="input-wrapper">
                        <span>Last Name</span>
                        <input wire:model.lazy="member.f_Lname" autocomplete="off" type="text">
                        @error('member.f_Lname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Suffix -->
                    <div class="input-wrapper">
                        <span>Suffix</span>
                        <input wire:model.lazy="member.f_Suffix" autocomplete="off" type="text">
                        @error('member.f_Suffix') <span class="text-required">{{ $message }}</span>@enderror
                    </div>


                    <!-- * Date Of Birth -->
                    <div class="input-wrapper">
                        <span>Date Of Birth</span>
                        <input wire:model.lazy="member.f_DOB" autocomplete="off" type="date">
                        @error('member.f_DOB') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Age -->
                    <div class="input-wrapper">
                        <span>Age</span>
                        <input wire:model.lazy="member.f_Age" autocomplete="off" type="number">
                        @error('member.f_Age') <span class="text-required">{{ $message }}</span>@enderror
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

                                    <input wire:model.lazy="member.f_Emp_Status" type="radio" class="radio" id="f_mem_Employed" value="1" />
                                    <label for="f_mem_Employed">
                                        <h4>Employed</h4>
                                    </label>

                                </div>

                                <div class="option" data-option-item7>

                                    <input wire:model.lazy="member.f_Emp_Status" type="radio" class="radio" id="f_mem_Unemployed" value="0"/>
                                    <label for="f_mem_Unemployed">
                                        <h4>Unemployed</h4>
                                    </label>

                                </div>

                            </div>
                            
                            <div class="selected" style="font-weight: bold;" data-option-select7>
                                {{ $member['f_Emp_Status'] != '' ? ($member['f_Emp_Status'] == 1 ? 'Employed' : 'Unemployed') : '' }}
                            </div>

                        </div>
                        @error('member.f_Emp_Status') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <script>
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
                       
                    </script>

                    <!-- * Current Job / Position -->
                    <div class="input-wrapper">

                        <!-- * Current Job -->
                        @if(isset($member['f_Emp_Status']))
                            @if($member['f_Emp_Status'] == '1' || $member['f_Emp_Status'] == '')
                            <span data-spouse-current-job>Current Job / Position</span>
                            <input wire:model.lazy="member.f_Job" type="text" data-spouse-current-job>
                            @endif
                        @endif

                        @if(isset($member['f_Emp_Status']))
                            @if($member['f_Emp_Status'] == '0')
                            <!-- * Previous Job -->
                            <span data-spouse-previous-job>Previous Job / Position</span>
                            <input wire:model.lazy="member.f_Job" type="text" data-spouse-previous-job>
                            @endif
                        @endif
                        @error('member.f_Job') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Years Of Service -->
                    <div class="input-wrapper">
                        <span>Years Of Service</span>
                        <input wire:model.lazy="member.f_YOS" type="text">
                        @error('member.f_YOS') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Company Name -->
                    <div class="input-wrapper">
                        <span>Company Name</span>
                        <input wire:model.lazy="member.f_CompanyName" type="text">
                        @error('member.f_CompanyName') <span class="text-required">{{ $message }}</span>@enderror
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
                        <input  wire:model.lazy="member.f_NOD" type="number">
                        @error('member.f_NOD') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                </div>

                <!-- * Rowspan 6: Empty Rowspan -->
                <div class="rowspan">

                </div>

                <!-- * Rowspan 7: Subheader - Children(s) Information -->
                <div class="rowspan" data-child-sibling>

                    <!-- * Family Background Information -->
                    <div class="input-wrapper">
                        <h3>Children(s) Information married</h3>
                    </div>

                </div>

                <!-- * Rowspan 8: First Name, Middle Name , Last Name, Age, Name Of School and Add/Subtract Button -->
               
                @if(count($cntmemchild) > 0)    
                    @foreach($cntmemchild as $cntchild)
                    <div class="rowspan child" data-child>                    
                            <!-- * First Name -->
                            <div class="input-wrapper">
                                <span>First Name</span>
                                <input  wire:model.lazy="inpchild.fname{{ $cntchild }}" autocomplete="off" type="text" >
                                @error('inpchild.fname'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Middle Name -->
                            <div class="input-wrapper">
                                <span>Middle Name</span>
                                <input wire:model.lazy="inpchild.mname{{ $cntchild }}" autocomplete="off" type="text">
                                @error('inpchild.mname'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Last Name -->
                            <div class="input-wrapper">
                                <span>Last Name</span>
                                <input wire:model.lazy="inpchild.lname{{ $cntchild }}" autocomplete="off" type="text">
                                @error('inpchild.lname'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Age -->
                            <div class="input-wrapper">
                                <span>Age</span>
                                <input wire:model.lazy="inpchild.age{{ $cntchild }}" autocomplete="off" type="number">
                                @error('inpchild.age'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Name Of School -->
                            <div class="input-wrapper">
                                <span>Name Of School</span>
                                <input wire:model.lazy="inpchild.school{{ $cntchild }}" autocomplete="off" type="text">
                                @error('inpchild.school'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Add and Subtract Button  -->
                            <div class="input-wrapper">
                                @if($cntchild == 1)
                                <button type="button" wire:click="addChild">+</button>
                                @else
                                <button type="button" wire:click="subChild({{ $cntchild }})">-</button>
                                @endif
                            </div>                        
                    </div>
                    @endforeach
                @endif

            </div>

        </div>
        @endif
    @endif

    @if(isset($member['civil_Status']))
        @if($member['civil_Status'] == 'Single')
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
                        <input wire:model.lazy="member.f_Fname" autocomplete="off" type="text">
                        @error('member.f_Fname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Middle Name -->
                    <div class="input-wrapper">
                        <span>Middle Name</span>
                        <input wire:model.lazy="member.f_Mname" autocomplete="off" type="text">
                        @error('member.f_Mname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Last Name -->
                    <div class="input-wrapper">
                        <span>Last Name</span>
                        <input wire:model.lazy="member.f_Lname" autocomplete="off" type="text">
                        @error('member.f_Lname') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Suffix -->
                    <div class="input-wrapper">
                        <span>Suffix</span>
                        <input wire:model.lazy="member.f_Suffix" autocomplete="off" type="text">
                        @error('member.f_Suffix') <span class="text-required">{{ $message }}</span>@enderror
                    </div>


                    <!-- * Date Of Birth -->
                    <div class="input-wrapper">
                        <span>Date Of Birth</span>
                        <input wire:model.lazy="member.f_DOB" autocomplete="off" type="date">
                        @error('member.f_DOB') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Age -->
                    <div class="input-wrapper">
                        <span>Age</span>
                        <input wire:model.lazy="member.f_Age" autocomplete="off" type="number">
                        @error('member.f_Age') <span class="text-required">{{ $message }}</span>@enderror
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

                                    <input wire:model.lazy="member.f_Emp_Status" type="radio" class="radio" id="f_mem_Employed" value="1" />
                                    <label for="f_mem_Employed">
                                        <h4>Employed</h4>
                                    </label>

                                </div>

                                <div class="option" data-option-item8>

                                    <input wire:model.lazy="member.f_Emp_Status" type="radio" class="radio" id="f_mem_Unemployed" value="0"/>
                                    <label for="f_mem_Unemployed">
                                        <h4>Unemployed</h4>
                                    </label>

                                </div>

                            </div>
                            
                            <div class="selected" style="font-weight: bold;" data-option-select8>
                                {{ $member['f_Emp_Status'] != '' ? ($member['f_Emp_Status'] == 1 ? 'Employed' : 'Unemployed') : '' }}
                            </div>
                            @error('member.f_Emp_Status') <span class="text-required">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <script>
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
                    </script>

                    <!-- * Current Job / Position -->
                    <div class="input-wrapper">

                        @if(isset($member['f_Emp_Status']))
                            @if($member['f_Emp_Status'] == '1' || $member['f_Emp_Status'] == '')
                            <!-- * Current Job -->
                            <span data-fdr-current-job>Current Job / Position</span>
                            <input wire:model.lazy="member.f_Job" type="text"  data-fdr-current-job>
                            @endif
                        @endif    

                        @if(isset($member['f_Emp_Status']))
                            @if($member['f_Emp_Status'] == '0')
                            <!-- * Previous Job -->
                            <span data-fdr-previous-job>Previous Job / Position</span>
                            <input wire:model.lazy="member.f_Job" type="text" data-fdr-previous-job>
                            @endif
                        @endif
                        @error('member.f_Job') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Years Of Service -->
                    <div class="input-wrapper">
                        <span>Years Of Service</span>
                        <input wire:model.lazy="member.f_YOS" type="text" >
                        @error('member.f_YOS') <span class="text-required">{{ $message }}</span>@enderror
                    </div>

                    <!-- * Company Name -->
                    <div class="input-wrapper">
                        <span>Company Name</span>
                        <input wire:model.lazy="member.f_CompanyName" type="text">
                        @error('member.f_CompanyName') <span class="text-required">{{ $message }}</span>@enderror
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
                        <input wire:model.lazy="member.f_NOD" type="number">
                        @error('member.f_NOD') <span class="text-required">{{ $message }}</span>@enderror
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
                @if(count($cntmemchild) > 0)    
                    @foreach($cntmemchild as $cntchild)
                    <div class="rowspan child" data-child-2>
                       
                            <!-- * First Name -->
                            <div class="input-wrapper">
                                <span>First Name</span>
                                <input  wire:model.lazy="inpchild.fname{{ $cntchild }}" autocomplete="off" type="text" >
                                @error('inpchild.fname'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Middle Name -->
                            <div class="input-wrapper">
                                <span>Middle Name</span>
                                <input wire:model.lazy="inpchild.mname{{ $cntchild }}" autocomplete="off" type="text">
                                @error('inpchild.mname'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Last Name -->
                            <div class="input-wrapper">
                                <span>Last Name</span>
                                <input wire:model.lazy="inpchild.lname{{ $cntchild }}" autocomplete="off" type="text">
                                @error('inpchild.lname'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Age -->
                            <div class="input-wrapper">
                                <span>Age</span>
                                <input wire:model.lazy="inpchild.age{{ $cntchild }}" autocomplete="off" type="number">
                                @error('inpchild.age'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Name Of School -->
                            <div class="input-wrapper">
                                <span>Name Of School</span>
                                <input wire:model.lazy="inpchild.school{{ $cntchild }}" autocomplete="off" type="text">
                                @error('inpchild.school'.$cntchild) <span class="text-required">{{ $message }}</span>@enderror
                            </div>

                            <!-- * Add and Subtract Button  -->
                            <div class="input-wrapper">
                                @if($cntchild == 1)
                                <button type="button" wire:click="addChild">+</button>
                                @else
                                <button type="button" wire:click="subChild({{ $cntchild }})">-</button>
                                @endif
                            </div>                             
                    </div>
                    @endforeach
                @endif

            </div>

        </div>
    @endif
@endif
    <!-- * Imported from New Member Application -->
    <!-- * Container 5: Business Information -->
    @if(isset($member['bO_Status']))
    @if($member['bO_Status'] == 1)
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
                    <input wire:model.lazy="membusinfo.businessName" type="text" >
                    @error('membusinfo.businessName') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Business Type -->
                <div class="input-wrapper">
                    <span>Business Type</span>
                    <input wire:model.lazy="membusinfo.businessType" type="text"  >
                    @error('membusinfo.businessType') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Business Address -->
                <div class="input-wrapper">
                    <span>Business Address</span>
                    <input wire:model.lazy="membusinfo.businessAddress" type="text">
                    @error('membusinfo.businessAddress') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 3: Rented or Owned, Years Of Business, Number Of Employees, Salary / Day, Value Of Stocks and Amount Of Sales / Day  -->
            <div class="rowspan">

                <div class="input-wrapper">

                    <div class="box-wrap">

                        <!-- * Rented -->
                        <div class="radio-btn-wrapper">
                            <span>Rented</span>
                            <input wire:model.lazy="membusinfo.b_status" autocomplete="off" type="radio" name="mem_b_status" value="5">                            
                        </div>

                        <!-- * Owned -->
                        <div class="radio-btn-wrapper">
                            <span>Owned</span>
                            <input wire:model.lazy="membusinfo.b_status" autocomplete="off" type="radio" name="mem_b_status" value="6">
                        </div>

                    </div>
                    @error('membusinfo.b_status') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Years Of Business -->
                <div class="input-wrapper">
                    <span>Years Of Business</span>
                    <input  wire:model.lazy="membusinfo.yob" type="text">
                    @error('membusinfo.yob') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Number Of Employees -->
                <div class="input-wrapper">
                    <span>Number Of Employees</span>
                    <input wire:model.lazy="membusinfo.noe" type="number">
                    @error('membusinfo.noe') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Salary / Day -->
                <div class="input-wrapper">
                    <span>Salary / Day</span>
                    <input wire:model.lazy="membusinfo.salary" type="text">
                    @error('membusinfo.salary') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Value Of Stocks -->
                <div class="input-wrapper">
                    <span>Value Of Stocks</span>
                    <input wire:model.lazy="membusinfo.vos" type="number">
                    @error('membusinfo.vos') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Amount Of Sales / Day -->
                <div class="input-wrapper">
                    <span>Amount Of Sales / Day</span>
                    <input wire:model.lazy="membusinfo.aos" type="text">
                    @error('membusinfo.aos') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>

            <!-- * Rowspan 4: Add Business and Attach Files Buttons -->
            <div class="rowspan">

                <!-- * Buttons -->
                <div class="btn-wrapper">

                    <!-- * Add Business -->
                    <button wire:click="addBusinessInfo" type="button">Add Business</button>

                    <!-- * Attach Files -->
                    <button type="button">Attach Files</button>

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
                    @if(count($businfo) > 0)
                        @foreach($businfo as $key => $value)
                            <tr>
                                <td>{{ $value['businessName'] }}</td>
                                <td>{{ $value['businessType'] }}</td>
                                <td>{{ $value['businessAddress'] }}</td>
                                <td>{{ $value['yob'] }}</td>
                                <!-- * Table Edit and Delete Button -->
                                <td class="td-btns">
                                    <div class="td-btn-wrapper">
                                        <button class="a-btn-edit">Edit</button>
                                        <button class="a-btn-delete">Delete</button>
                                    </div>
                                </td>
                            </tr>     
                        @endforeach
                    @endif              
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
    @endif
    @endif                    
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
                                    <input wire:model="hasvehicle" name="hasvehicle" autocomplete="off" type="radio"  value="1">
                                    <span>Yes</span>
                                </div>

                                <!-- * No -->
                                <div class="radio-btn-wrapper">
                                    <input wire:model="hasvehicle" name="hasvehicle" autocomplete="off" type="radio"   value="0">
                                    <span>No</span>
                                </div>

                            </div>

                        </div>


                        <!-- * Rowspan 3: Vehicle Input Field -->
                        <div class="box-wrap-2" data-vehicle-container>
                            <div class="input-wrapper" data-vehicle >
                                <span>If yes please specify,</span>

                                @if(count($vehicle) > 0)
                                    @foreach($vehicle as $key => $value)
                                    <div class="rowspan-2 child" style="{{ isset($hasvehicle) ? ($hasvehicle == 1 ? '' : 'pointer-events: none; opacity: 0.4;') : 'pointer-events: none; opacity: 0.4;' }}">
                                        <!-- * Vehicle Input Field -->
                                        <div class="input-wrapper">
                                            <input wire:model.lazy="inpvehicle.vehicle{{ $key }}" autocomplete="off" type="text">
                                            @error('inpvehicle.vehicle'.$key) <span class="text-required">{{ $message }}</span>@enderror
                                        </div>                                       
                                        <!-- * Add and Subtract Button  -->
                                        <div class="input-wrapper">
                                            @if($key == 1)
                                            <button type="button" wire:click="addVehicle">+</button>
                                            @else
                                            <button type="button" wire:click="subVehicle({{ $key }})">-</button>
                                            @endif
                                        </div>

                                    </div>
                                    @endforeach
                                @endif           
                                                               
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
                                    <input wire:model="hasproperties" autocomplete="off" type="radio" name="hasproperties" value="1" >
                                    <span>Yes</span>
                                </div>

                                <!-- * No -->
                                <div class="radio-btn-wrapper">
                                    <input wire:model="hasproperties" autocomplete="off" type="radio" name="hasproperties" value="0">
                                    <span>No</span>
                                </div>

                            </div>

                        </div>

                        <div class="box-wrap-2" data-property-container>
                            <div class="input-wrapper" data-property>
                                <span>If yes please specify,</span>


                                <!-- * Rowspan 5: Property Input Field -->
                                @if(count($properties) > 0)
                                    @foreach($properties as $key => $value)
                                        <div class="rowspan-2 child"  style="{{ isset($hasproperties) ? ($hasproperties == 1 ? '' : 'pointer-events: none; opacity: 0.4;') : 'pointer-events: none; opacity: 0.4;' }}">
                                            <!-- * Vehicle Input Field -->
                                            <div class="input-wrapper">
                                                <input wire:model="inpproperties.property{{ $key }}"  autocomplete="off" type="text">
                                                @error('inpproperties.property'.$key) <span class="text-required">{{ $message }}</span>@enderror
                                            </div>

                                            <!-- * Add and Subtract Button  -->
                                            <div class="input-wrapper">
                                            @if($key == 1)
                                                <button type="button" wire:click="addProperty">+</button>
                                            @else
                                                <button type="button" wire:click="subProperty({{ $key }})">-</button>
                                            @endif
                                            </div>

                                        </div>
                                    @endforeach
                                @endif
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
                        @if(count($appliances) > 0)
                            @foreach($appliances as $key => $value)
                            <div class="rowspan child" data-appliances>
                                <!-- * Appliances -->
                                <div class="input-wrapper">
                                    <span>Appliances</span>
                                    <input wire:model="inpappliances.appliance{{ $key }}" autocomplete="off" type="text">
                                    @error('inpappliances.appliance'.$key) <span class="text-required">{{ $message }}</span>@enderror
                                </div>

                                <!-- * Brand / Model -->
                                <div class="input-wrapper">
                                    <span>Brand / Model</span>
                                    <input wire:model="inpappliances.brand{{ $key }}" autocomplete="off" type="text">
                                    @error('inpappliances.brand'.$key) <span class="text-required">{{ $message }}</span>@enderror
                                </div>

                                <!-- * Add and Subtract Button  -->
                                <div class="input-wrapper">
                                    @if($key == 1)
                                    <button type="button" wire:click="addAppliances">+</button>
                                    @else
                                    <button type="button" wire:click="subAppliances({{ $key }})">-</button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endif
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
                        @if(count($bank) > 0)
                                @foreach($bank as $key => $value)
                                <div class="rowspan child" data-bank>

                                    <!-- * Bank account -->
                                    <div class="input-wrapper">
                                        <span>Bank account</span>
                                        <input wire:model="inpbank.account{{ $key }}" autocomplete="off" type="bankAcc">
                                        @error('inpbank.account'.$key) <span class="text-required">{{ $message }}</span>@enderror
                                    </div>

                                    <!-- * Address -->
                                    <div class="input-wrapper">
                                        <span>Address</span>
                                        <input wire:model="inpbank.address{{ $key }}" autocomplete="off" type="bankAddr">
                                        @error('inpbank.address'.$key) <span class="text-required">{{ $message }}</span>@enderror
                                    </div>

                                    <!-- * Add and Subtract Button  -->
                                    <div class="input-wrapper">
                                        @if($key == 1)
                                        <button type="button" wire:click="addBank">+</button>
                                        @else
                                        <button type="button" wire:click="subBank({{ $key }})">-</button>
                                        @endif
                                    </div>


                                </div>
                                @endforeach
                        @endif        
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
                    <input wire:model.lazy="member.loanAmount" type="number">
                    @error('member.loanAmount') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Terms Of Payment -->
                <div class="input-wrapper">
                    <span>Terms Of Payment</span>
                    <input wire:model.lazy="member.termsOfPayment" disabled type="text" >
                    @error('member.termsOfPayment') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Purpose -->
                <div class="input-wrapper">
                    <span>Purpose</span>
                    <input wire:model.lazy="member.purpose" type="text">
                    @error('member.purpose') <span class="text-required">{{ $message }}</span>@enderror
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
                            <input wire:model.lazy="comaker.co_Fname" autocomplete="off" type="text" id="fName" name="fName">
                            @error('comaker.co_Fname') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Middle Name -->
                        <div class="input-wrapper">
                            <span>Middle Name</span>
                            <input wire:model.lazy="comaker.co_Mname" autocomplete="off" type="text" id="midName" name="midName">
                            @error('comaker.co_Mname') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Last Name -->
                        <div class="input-wrapper">
                            <span>Last Name</span>
                            <input wire:model.lazy="comaker.co_Lname" autocomplete="off" type="text" id="lName" name="lName">
                            @error('comaker.co_Lname') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Suffix -->
                        <div class="input-wrapper">
                            <span>Suffix</span>
                            <input wire:model.lazy="comaker.co_Suffix" autocomplete="off" type="text" id="suffix" name="suffix">
                            @error('comaker.co_Suffix') <span class="text-required">{{ $message }}</span>@enderror
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

                                        <input type="radio" wire:model="comaker.co_Gender" id="comakerGendermale" class="radio" value="Male" />
                                        <label for="comakerGendermale">
                                            <h4>Male</h4>
                                        </label>

                                    </div>

                                    <div class="option"  data-option-item4>

                                        <input type="radio" wire:model="comaker.co_Gender" id="comakerGenderfemale" class="radio" value="Female"/>
                                        <label for="comakerGenderfemale">
                                            <h4>Female</h4>
                                        </label>

                                    </div>

                                </div>
                                
                                <div class="selected" style="font-weight: bold;" data-option-select4>
                                    {{ isset($comaker['co_Gender']) ? $comaker['co_Gender'] : '' }}
                                </div>

                            </div>
                            @error('comaker.co_Gender') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Date Of Birth -->
                        <div class="input-wrapper">
                            <span>Date Of Birth</span>
                            <input wire:model.lazy="comaker.co_DOB" autocomplete="off" type="date">
                            @error('comaker.co_DOB') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Age -->
                        <div class="input-wrapper">
                            <span>Age</span>
                            <input wire:model.lazy="comaker.co_Age" autocomplete="off" type="number" id="age" name="age">
                            @error('comaker.co_Age') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Place Of Birth -->
                        <div class="input-wrapper">
                            <span>Place Of Birth</span>
                            <input wire:model.lazy="comaker.co_POB" autocomplete="off" type="text" id="poBirth" name="poBirth">
                            @error('comaker.co_POB') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Civil Status -->
                        <div class="input-wrapper">
                            <span>Civil Status</span>
                            <div class="select-box">

                                <div class="options-container" data-option-con5>

                                    <div class="option" data-option-item5>

                                        <input wire:model="comaker.co_Civil_Status" type="radio" id="comakerWidow" name="co_Civil_Status" class="radio" value="Widow" />
                                        <label for="comakerWidow">
                                            <h4>Widow</h4>
                                        </label>

                                    </div>

                                    <div class="option" data-option-item5>

                                        <input wire:model="comaker.co_Civil_Status" type="radio" id="comakerMarried" name="co_Civil_Status" class="radio" value="Married"/>
                                        <label for="comakerMarried">
                                            <h4>Married</h4>
                                        </label>

                                    </div>

                                    <div class="option" data-option-item5>

                                        <input wire:model="comaker.co_Civil_Status" type="radio" id="comakerSingle" name="co_Civil_Status" class="radio" value="Single"/>
                                        <label for="comakerSingle">
                                            <h4>Single</h4>
                                        </label>

                                    </div>

                                </div>
                                
                                <div class="selected" style="font-weight: bold;" data-option-select5>
                                    {{ isset($comaker['co_Civil_Status']) ? $comaker['co_Civil_Status'] : '' }}
                                </div>

                            </div>
                            @error('comaker.co_Civil_Status') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                    </div>

                    <!-- * Rowspan 4: Contact Number and Email Address -->
                    <div class="rowspan">

                        <!-- * Contact Number -->
                        <div class="input-wrapper">
                            <div class="input-wrapper">
                                <span>Contact Number</span>
                                <input wire:model.lazy="comaker.co_Cno" autocomplete="off" type="number">
                                @error('comaker.co_Cno') <span class="text-required">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- * Email Address -->
                        <div class="input-wrapper">
                            <div class="input-wrapper">
                                <span>Email Address</span>
                                <input wire:model.lazy="comaker.co_EmailAddress" autocomplete="off" type="email">
                                @error('comaker.co_EmailAddress') <span class="text-required">{{ $message }}</span>@enderror
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
                                    <input wire:model.lazy="comaker.co_House_Stats" autocomplete="off" type="radio" name="co_House_Stats" value="1">
                                </div>

                                <!-- * Owned -->
                                <div class="radio-btn-wrapper">
                                    <span>Owned</span>
                                    <input wire:model.lazy="comaker.co_House_Stats" autocomplete="off" type="radio" name="co_House_Stats" value="2">
                                </div>

                                <!-- * Free Use -->
                                <div class="radio-btn-wrapper">
                                    <span>Free Use</span>
                                    <input wire:model.lazy="comaker.co_House_Stats" autocomplete="off" type="radio" name="co_House_Stats" value="3">
                                </div>

                            </div>
                            @error('comaker.co_House_Stats') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * House No./ Bldg. No./ Room No./ Subdivision/ Street -->
                        <div class="input-wrapper">
                            <span>House No./ Bldg. No./ Room No./ Subdivision/ Street</span>
                            <input  wire:model.lazy="comaker.co_HouseNo" autocomplete="off" type="text">
                            @error('comaker.co_HouseNo') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                    </div>

                    <!-- * Rowspan 6: Barangay, City / Municipality, Province / Region, and Country -->
                    <div class="rowspan">

                        <!-- * Barangay -->
                        <div class="input-wrapper">
                            <span>Barangay</span>
                            <input  wire:model.lazy="comaker.co_Barangay" autocomplete="off" type="text">
                            @error('comaker.co_Barangay') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * City / Municipality -->
                        <div class="input-wrapper">
                            <span>City / Municipality</span>
                            <input  wire:model.lazy="comaker.co_City" autocomplete="off" type="text">
                            @error('comaker.co_City') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Province / Region -->
                        <div class="input-wrapper">
                            <span>Province / Region</span>
                            <input  wire:model.lazy="comaker.co_Province" autocomplete="off" type="text" >
                            @error('comaker.co_Province') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Country -->
                        <div class="input-wrapper">
                            <span>Country</span>
                            <input  wire:model.lazy="comaker.co_Country" autocomplete="off" type="text">
                            @error('comaker.co_Country') <span class="text-required">{{ $message }}</span>@enderror
                        </div>


                    </div>

                    <!-- * Rowspan 7: Zip Code and Years Of Stay -->
                    <div class="rowspan">

                        <!-- * Zip Code -->
                        <div class="input-wrapper">
                            <span>Zip Code</span>
                            <input wire:model.lazy="comaker.co_ZipCode" type="number" id="zipCode" name="zipCode">
                            @error('comaker.co_ZipCode') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                        <!-- * Years Of Stay -->
                        <div class="input-wrapper">
                            <span>Years of stay on the mentioned address</span>
                            <input wire:model.lazy="comaker.co_YearsStay" type="number" id="yoStay" name="yoStay">
                            @error('comaker.co_YearsStay') <span class="text-required">{{ $message }}</span>@enderror
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
                                <div class="input-wrapper" data-upload-image-co-borrower-hover-container>                                   
                                    @if(isset($comaker['profile']))
                                    <input type="image" class="profile" style="width: 150px; height: 150px;" src="{{ $comaker['profile']->temporaryUrl() }}" alt="upload-image">
                                    @else
                                    <input type="image" class="profile" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image">
                                    @endif      
                                </div>
                                @error('comaker.profile') <span class="error">{{ $message }}</span> @enderror
                                <div class="btn-wrapper">
                                        <!-- * Upload Button -->
                                        <input type="file"  wire:model="comaker.profile" class="input-image upload-profile-image-btn" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-borrower-image-btn></input>
                                        <!-- * Attach Button -->
                                        <input type="file" wire:model="comaker.attachments" class="input-image attach-file-btn" accept=".txt, .pdf, .docx, .xlsx" multiple data-attach-file-btn></input>
                                </div>

                                <div class="file-wrapper" data-attach-file-container2>
                                @if(isset($comaker['attachments']))
                                    @foreach($comaker['attachments'] as $comakerattachments)
                                
                                        <div type="button" class="fileButton">
                                            <img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">
                                            <a href="{{ $comakerattachments->path() }}" target="_blank" alt="file.png">{{ $comakerattachments->getClientOriginalName() }}</a>                                       
                                        </div>
                                        <!-- <button type="button" class="fileButton"><img src="{{ URL::to('/') }}/assets/icons/file.svg" alt="file.png">{{ $comakerattachments->getClientOriginalName() }}</button> -->
                                    @endforeach
                                @endif
                                </div>

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
                                <input wire:model.lazy="comaker.co_Emp_Status" type="radio"  id="comakerEmployed"  class="radio" value="1" />
                                <label for="comakerEmployed">
                                    <h4>Employed</h4>
                                </label>
                            </div>                              
                           
                            <div class="option" data-option-item6>
                                <input wire:model.lazy="comaker.co_Emp_Status" type="radio"  id="comakerUnemployed"  class="radio" value="0"/>
                                <label for="comakerUnemployed">
                                    <h4>Unemployed</h4>
                                </label>
                            </div>

                        </div>
                        
                        <div class="selected" style="font-weight: bold;" data-option-select6>                           
                            {{ $comaker['co_Emp_Status'] != '' ? ($comaker['co_Emp_Status'] == 1 ? 'Employed' : 'Unemployed') : '' }}
                        </div>

                    </div>
                    @error('comaker.co_Emp_Status') <span class="text-required">{{ $message }}</span>@enderror
                </div>                

                <!-- * Current Job / Position -->
                <div class="input-wrapper">

                    @if(isset($comaker['co_Emp_Status']))
                        @if($comaker['co_Emp_Status'] == '1' || $comaker['co_Emp_Status'] == '')
                        <!-- * Current Job -->
                        <span data-cb-current-job>Current Job / Position</span>
                        <input wire:model.lazy="comaker.co_JobDescription" type="text"  data-cb-current-job>
                        @endif
                    @endif    

                    @if(isset($comaker['co_Emp_Status']))
                        @if($comaker['co_Emp_Status'] == '0')
                        <!-- * Previous Job -->
                        <span data-cb-previous-job>Previous Job / Position</span>
                        <input wire:model.lazy="comaker.co_JobDescription" type="text" data-cb-previous-job>
                        @endif
                    @endif
                    @error('comaker.co_JobDescription') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Years Of Service -->
                <div class="input-wrapper">
                    <span>Years Of Service</span>
                    <input wire:model.lazy="comaker.co_YOS" type="text" id="yoService" name="yoService">
                    @error('comaker.co_YOS') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Company Name -->
                <div class="input-wrapper">
                    <span>Company Name</span>
                    <input wire:model.lazy="comaker.co_CompanyName" type="text" id="compName" name="compName">
                    @error('comaker.co_CompanyName') <span class="text-required">{{ $message }}</span>@enderror
                </div>

            </div>


            <!-- * Rowspan 3: Company Address, Monthly Salary, Other Source of Income, and Do you own a Business?  -->
            <div class="rowspan">

                <!-- * Company Address -->
                <div class="input-wrapper">
                    <span>Company Address</span>
                    <input wire:model.lazy="comaker.co_CompanyID" type="text" id="compAddr" name="compAddr">
                    @error('comaker.co_CompanyID') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Monthly Salary -->
                <div class="input-wrapper">
                    <span>Monthly Salary</span>
                    <input wire:model.lazy="comaker.co_MonthlySalary" type="number" id="monthSal" name="monthSal">
                    @error('comaker.co_MonthlySalary') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Other Source Of Income -->
                <div class="input-wrapper">
                    <span>Other Source Of Income</span>
                    <input wire:model.lazy="comaker.co_OtherSOC" type="text" id="othSorOfInc" name="othSorOfInc">
                    @error('comaker.co_OtherSOC') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Do you own a Business?  -->
                <div class="input-wrapper">
                    <span>Do you own a Business?</span>

                    <!-- * Form Toggle -->

                    <div class="box-wrap">

                        <!-- * Rented -->
                        <div class="radio-btn-wrapper">
                            <input wire:model.lazy="comaker.co_BO_Status" autocomplete="off" type="radio" name="co_BO_Status" value="1">
                            <span>Yes</span>
                        </div>

                        <!-- * Owned -->
                        <div class="radio-btn-wrapper">
                            <input  wire:model.lazy="comaker.co_BO_Status" autocomplete="off" type="radio" name="co_BO_Status" value="0">
                            <span>No</span>
                        </div>

                    </div>
                    @error('comaker.co_BO_Status') <span class="text-required">{{ $message }}</span>@enderror    
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
                            <img id="comSig">
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
                                <!-- employee searching -->
                                <dialog class="ng-modal" data-new-group-modal wire:ignore>
                                    <div class="modal-container">

                                        <!-- * Exit Button -->
                                        <button type="button" class="exit-button" id="data-close-new-group-modal">
                                            <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
                                        </button>

                                        <!-- * Search for existing member -->
                                        <div class="rowspan">

                                            <!-- * Search for existing member -->
                                            <h3>Search for field officer</h3>

                                            <div class="wrapper">

                                                <!-- * Search Bar -->
                                                <div class="search-wrap">
                                                    <input type="search" wire:model="searchempkeyword" placeholder="Search field officer">
                                                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                                                </div>


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
                                                    <th><input type="checkbox" class="checkbox" id="allCheckbox" onchange="checkAll(this)"></th> -->

                                                            <!-- * Header Name -->
                                                            <th><span class="th-name">Name</span></th>

                                                            <!-- * Header Action-->
                                                            <th><span class="th-name">Action</span></th>

                                                        </tr>

                                                        @if(isset($emplist) > 0)
                                                            @foreach($emplist as $fol)
                                                            <tr>
                                                                <!-- * Officer Name -->
                                                                <td>

                                                                    <!-- * Officers' Name-->
                                                                    <div class="td-wrapper">
                                                                        <!-- <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana"> <span class="td-num">1</span> -->
                                                                        <span class="td-name">{{ $fol['lname'] . ', ' . $fol['fname'] . ' ' . mb_substr($fol['mname'], 0, 1) . '.' }}</span>
                                                                    </div>

                                                                </td>

                                                                <!-- * Action -->
                                                                <td class="td-btns">
                                                                    <div class="td-btn-wrapper">                                           
                                                                        <button type="button" wire:click="selectEmployee('{{ $fol['fname'] . ' ' . $fol['lname'] }}')" class="a-btn-trash-2">Select</button>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            @endforeach
                                                        @endif     

                                                    

                                                    </table>

                                                </div>

                                                <!-- * Pagination Container -->
                                                <div class="pagination-container">

                                                    <!-- * Pagination Links -->
                                                    <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg"
                                                            alt="caret-left"></a>
                                                    <a href="#">1</a>
                                                    <a href="#">2</a>
                                                    <a href="#">3</a>
                                                    <a href="#">4</a>
                                                    <a href="#">5</a>
                                                    <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg"
                                                            alt="caret-right"></a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </dialog>
                                <!-- employee searching -->

                                <!-- modal for declining -->
                                <dialog class="na-application-decline-modal" data-application-decline-modal>
                                    <!-- * Modal Container -->
                                    <div class="modal-container">

                                            <!-- * Reason for declining Modal Container -->
                                            <div class="application-decline-modal-container">

                                                <!-- * Button Wrapper -->
                                                <div class="button-wrapper">
                                                    <button type="button" data-close-application-decline>
                                                            <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="close">
                                                    </button>
                                                </div>

                                                <!-- * Small Container -->
                                                <div class="small-con">

                                                        <!-- * Rowspan 1: Header -->
                                                        <div class="rowspan">
                                                            <h2>Reason for declining</h2>
                                                        </div>

                                                        <!-- * Rowspan 2: Reason for declining Container -->
                                                        <div class="rowspan">
                                                            <textarea name="" rows="15" id=""placeholder="Enter the reason here..."></textarea>
                                                        </div>
                                                        
                                                        <!-- * Rowspan 3: Button Wrapper -->
                                                        <div class="rowspan">
                                                            <button type="button" class="button" data-submit-decline-reason>Submit</button>
                                                        </div>

                                                </div>

                                            </div>
                                    </div>

                                </dialog>
                                <!-- modal for declining -->
    </form>
    <script>

        document.addEventListener('livewire:load', function () {
            window.showAskingDialog = function(){              
                @this.call('showAskingDialog');        
            };

            const dataNewGroupModal = document.querySelector('[data-new-group-modal]')
            const openNewGroupModal = document.querySelector('#data-open-new-group-modal')
            const closeNewGroupModal = document.querySelector('#data-close-new-group-modal')
            const addNewGroupModal = document.querySelector('[data-add-new-group-modal]')

            closeNewGroupModal.addEventListener('click', () => {
                    dataNewGroupModal.setAttribute("closing", "");
                    dataNewGroupModal.addEventListener("animationend", () => {
                        dataNewGroupModal.removeAttribute("closing");
                        dataNewGroupModal.close();
                    }, {
                        once: true
                    });
            })

            window.livewire.on('openSearchEmployeeModal', message => {
                dataNewGroupModal.showModal()
            });

            window.livewire.on('closeSearchEmployeeModal', message => {
                dataNewGroupModal.close();
            });

            window.livewire.on('openUrlPrintingVoucher', data =>{
                window.open(data.url, '_blank');
            });


        })
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
        // const cbPreviousJob = document.querySelectorAll('[data-cb-previous-job]')
        // const cbCurrentJob = document.querySelectorAll('[data-cb-current-job]')


        // for (const cbPreviousJobItems of cbPreviousJob) {
        //     cbPreviousJobItems.style.display = 'none'

        //     for (const cbCurrentJobItems of cbCurrentJob) {

        //         optionsContainer6.firstElementChild.addEventListener('click', () => {
        //             cbPreviousJobItems.style.display = 'none'
        //             cbCurrentJobItems.style.display = 'block'
        //         })

        //         optionsContainer6.lastElementChild.addEventListener('click', () => {
        //             cbPreviousJobItems.style.display = 'block'
        //             cbCurrentJobItems.style.display = 'none'
        //         })

        //     }
        // }
        


        // ** Select Dropdown 8       

        // * Spouse Job Information
        // const fdrPreviousJob = document.querySelectorAll('[data-fdr-previous-job]')
        // const fdrCurrentJob = document.querySelectorAll('[data-fdr-current-job]')

        // for (const fdrPreviousJobItems of fdrPreviousJob) {
        //     fdrPreviousJobItems.style.display = 'none'

        //     for (const fdrCurrentJobItems of fdrCurrentJob) {

        //         optionsContainer8.firstElementChild.addEventListener('click', () => {
        //             fdrPreviousJobItems.style.display = 'none'
        //             fdrCurrentJobItems.style.display = 'block'
        //         })

        //         optionsContainer8.lastElementChild.addEventListener('click', () => {
        //             fdrPreviousJobItems.style.display = 'block'
        //             fdrCurrentJobItems.style.display = 'none'
        //         })

        //     }
        // }

        // ** Loan Type Dropdown
          


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

        // ** Select Dropdown 10 (Mode of Payment)
        
        // * Mode of Release Toggle

        // * Decline Application Modal
        // ***** Modal with Submit Button redirect to another page ***** //
        function submitModalFunction(open, close, submit, modal, url) {
            open.addEventListener('click', () => {
                modal.showModal()
            })

            close.addEventListener('click', () => {
                modal.setAttribute("closing", "");
                modal.addEventListener("animationend", () => {
                    modal.removeAttribute("closing")
                    modal.close()
                }, { once: true })
            
            })

            submit.addEventListener("click", () => {
                location.href = url
            })
        }

        const declineApplicationModal = document.querySelector('[data-application-decline-modal]')

        if (declineApplicationModal) {
            const openDeclineApplicationModal = document.querySelector('[data-open-application-decline]')
            const closeDeclineApplicationModal = document.querySelector('[data-close-application-decline]')
            const submitDeclineReason = document.querySelector('[data-submit-decline-reason]')
            url = 'new-application.html'

            submitModalFunction(
                openDeclineApplicationModal, 
                closeDeclineApplicationModal,
                submitDeclineReason,
                declineApplicationModal,
                url)

        }
        
    </script>
</div>
