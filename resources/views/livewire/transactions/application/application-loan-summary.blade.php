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
                    <p>NAME: <span id="printClientName"> {{ $member['lname'] }}, {{ $member['fname'] }} {{ mb_substr($member['mname'], 0, 1) }}.</span></p>
                    <p class="p-bold">{{ isset($loansummary['areaName']) ? $loansummary['areaName'] : '' }}</p>
                    <div class="box-inner">
                        <div class="box-inner-wrapper">
                            <p>DATE:</p> 
                            <span id="printDate">{{ date_format($currentDate,'m/d/Y') }}</span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>DUE-DATE:</p> 
                            <span id="printDueDate">{{  date_format($dueDate,'m/d/Y')  }}</span>
                        </div>
                    </div>
                </div>
                <!-- * Box-2 -->
                <div class="box">
                    <div class="box-inner">
                        <div class="box-inner-wrapper">
                            <p>LOAN AMOUNT:</p>
                            <span id="">{{  number_format($loanPrincipal, 2) }}</span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>INTEREST RATE:</p>
                            <span id="">{{  $interestRate * 100  }}%</span>
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
                            <span id="">{{ number_format($advancePayment, 2) }}</span>
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
                        <p>{{ number_format($loanAmount,2) }}</p>
                        <p>{{ number_format($interestAmount,2) }}</p>
                        <p>{{ number_format($notarialFee,2) }}</p>
                        <p class="underline">{{ number_format($loanInsurance,2) }}</p>
                        <p class="underline-thick">{{number_format($loanReceivables,2) }}</p>
                        <p>&nbsp;</p>
                        <p>{{ number_format($holidayPayment,2)}}</p>
                        <p>{{ !empty($loansummary['totalSavingUsed']) ? number_format($loansummary['totalSavingUsed'], 2) : '0.00' }}</p>
                        <p>{{ number_format($lifeInsurance,2) }}</p>                                
                        <p>{{ number_format($deductInterest,2) }}</p>
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
                            <span id="">{{ $loanDetails['prepearedBy'] }}</span>
                        </div>
                        <div class="box-inner-wrapper">
                            <p>APPROVED BY:</p>
                            <span id="">{{ $loanDetails['approvedBy'] }}</span>
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
                            <span id="">{{ number_format($loanReceivables,2) }}</span>
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