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
                    <p class="p-bold">{{ isset($loansummary['areaName']) ? $loansummary['areaName'] : '' }}</p>
                    <div class="box-inner">
                        <div class="box-inner-wrapper">
                            <p>DATE:</p> 
                            <span id="printDate">{{ isset($loansummary['date']) ? date('F j, Y', strtotime($loansummary['date'])) : 'not found' }}</span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>DUE-DATE:</p> 
                            <span id="printDueDate">{{ isset($loansummary['dueDate']) ? date('F j, Y', strtotime($loansummary['dueDate'])) : 'not found' }}</span>
                        </div>
                    </div>
                </div>
                <!-- * Box-2 -->
                <div class="box">
                    <div class="box-inner">
                        <div class="box-inner-wrapper">
                            <p>LOAN AMOUNT:</p>
                            <span id="">{{ !empty($loansummary['approvedLoanAmount']) ? number_format($loansummary['approvedLoanAmount'], 2) : number_format((!empty($loansummary['principalLoan']) ? $loansummary['principalLoan'] : 0), 2) }}</span>
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
                            <span id="">{{ !empty($loansummary['advancePayment']) ? number_format($loansummary['advancePayment'], 2) : 'not found' }}</span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>HOLIDAYS:</p>
                            <span id=""></span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>USED SAVINGS:</p>
                            <span id=""></span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>LIFE INSURANCE:</p>
                            <span id=""></span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>DEDUCTED INTEREST:</p>
                            <span id=""></span>
                        </div>
                    </div>
                    <div class="box-inner">
                        <p>{{ isset($loansummary['loanAmount']) ? number_format($loansummary['loanAmount'], 2) : 'not found' }}</p>
                        <p>{{ isset($loansummary['total_InterestAmount']) ? number_format($loansummary['total_InterestAmount'], 2) : 'not found' }}</p>
                        <p>{{ isset($loansummary['notarialFee']) ? number_format($loansummary['notarialFee'], 2) : 'not found' }}</p>
                        <p class="underline">{{ isset($loansummary['loanInsurance']) ? number_format($loansummary['loanInsurance'], 2) : 'not found' }}</p>
                        <p class="underline-thick">{{ isset($loansummary['approvedReleasingAmount']) ? ($loansummary['approvedReleasingAmount'] == '' ? '0' : number_format($loansummary['approvedReleasingAmount'], 2)) : 'not found' }}</p>
                        <p>&nbsp;</p>
                        <p>{{ isset($loansummary['holidayAmount']) ? number_format($loansummary['holidayAmount'], 2) : '' }}</p>
                        <p>{{ !empty($loansummary['totalSavingsAmount']) ? number_format($loansummary['totalSavingsAmount'], 2) : '0.00' }}</p>
                        <p>{{ isset($loansummary['lifeInsurance']) ? number_format($loansummary['lifeInsurance'], 2) : '' }}</p>                                
                        <p>{{ !empty($loansummary['deductInterest']) ? ($loansummary['deductInterest'] == 2 ? '0.00' : ( number_format($loansummary['total_InterestAmount'] ??= 0.00, 2)))  : '0.00' }}</p>
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
                            <span id="">{{ isset($loansummary['createdBy']) ? $loansummary['createdBy'] : 'not found' }}</span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>APPROVED BY:</p>
                            <span id="">{{ isset($loansummary['releasedBy']) ? $loansummary['releasedBy'] : 'not found' }}</span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>RELEASED THRU {{ isset($loansummary['modeOfRelease']) ? strtoupper($loansummary['modeOfRelease']) : 'NOT SET' }} {!! ($loansummary['modeOfRelease'] ??='') == 'Check' ? '<br>Check Reference : ' . ($loansummary['modeOfReleaseReference'] ??='') : '' !!}</p>
                        </div>
                    </div>
                    <div class="box-inner">
                        <div class="box-inner-wrapper">
                            <p>RECEIVED FROM:</p>
                            <span id="">GOLD ONE VICTORY LENDING CORPORATION</span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>AMOUNT TO BE RECEIVED:</p> 
                            <span id="">{{ isset($loansummary['approvedReleasingAmount']) ? ($loansummary['approvedReleasingAmount'] == '' ? '0' : number_format($loansummary['approvedReleasingAmount'], 2)) : 'not found' }}</span>
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