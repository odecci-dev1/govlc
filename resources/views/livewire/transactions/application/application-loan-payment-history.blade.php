<dialog class="na-loan-details-modal" data-loan-details-modal wire:ignore.self>

        <!-- * Modal Container -->
        <div class="modal-container">

            <!-- * Button Wrapper -->
            <div class="button-wrapper">
                <button type="button" id="data-close-loan-details" wire:click="resetLoanHistory">
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
                                <th>Status</th>                               
                            </tr>
                            @if($loanhistory)                                                           
                                @foreach($loanhistory as $lhistory)
                                <tr wire:click="getPaymentHistory('{{ $lhistory['naid'] }}')">
                                    <td>{{ $lhistory['loanPrincipal'] }}</td>                                  
                                    <td>{{ $lhistory['totalSavingsAmount'] }}</td>
                                    <td>{{ $lhistory['penalty'] }}</td>
                                    <td>{{ $lhistory['amountDue'] }}</td>
                                    <td>{{ $lhistory['releasingDate'] }}</td>
                                    <td>{{ date('m-d-Y', strtotime($lhistory['dueDate'])) }}</td>   
                                    <td>{{ $lhistory['status'] }}</td>                                      
                                </tr>   
                                @endforeach
                            @endif                        

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
                    <div class="rowspan"  style="overflow-y: auto;">
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
                                @if($paymenthistory)
                                    @foreach($paymenthistory as $paymenthistory)
                                    <tr>
                                        <td>{{ $paymenthistory['loanPrincipal'] }}</td>        
                                        <td>{{ $paymenthistory['amountDue'] }}</td>
                                        <td>{{ $paymenthistory['collectedAmount'] }}</td>
                                        <td>{{ $paymenthistory['fieldOfficer'] }}</td>
                                        <td>{{ date('m-d-Y', strtotime($paymenthistory['dateOfFullPayment'])) }}</td>
                                        <td>{{ $paymenthistory['payment_Method'] }}</td>
                                        <td>{{ $paymenthistory['penalty'] }}</td>
                                    </tr>   
                                    @endforeach
                                @endif                                         
                            </tr>                                                       
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </dialog>