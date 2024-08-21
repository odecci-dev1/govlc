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
                                <th>Application ID</th>
                                <th>Loan Amount</th>
                                <th>Savings</th>
                                <th>Penalty</th>
                                <th>Date Released</th>
                                <th>Due Date</th>     
                                <th>Status</th> 
                                <th style="width: 1%;">Option</th>                                      
                            </tr>
                            @if($loanhistory)                                                           
                                @foreach($loanhistory as $lhistory)
                                <tr wire:click="getPaymentHistory('{{ $lhistory['NAID'] }}')">
                                    <td>{{ $lhistory['NAID']}}</td>                                  
                                    <td>{{ $lhistory['loanhistory']['LoanAmount'] }}</td>                                  
                                    <td>0</td>
                                    {{-- <td>{{ $lhistory['member']['memberSavings'][0]['TotalSavingsAmount']  }}</td> --}}
                                    <td>{{ $lhistory['loanhistory']['Penalty'] }}</td>
                                    <td>{{ $lhistory['loanhistory']['OutstandingBalance'] }}</td>
                                    <td>{{ date('m/d/Y', strtotime($lhistory['loanhistory']['DateReleased'] )) }}</td>
                                    <td>{{ date('m/d/Y', strtotime($lhistory['loanhistory']['DueDate'] )) }}</td>   
                                    <td>{{ $lhistory->Status == 14 ? 'On going':'In process'}}</td>  
                                    <td class="td-btns" style="width: 1%;">
                                        <div class="td-btn-wrapper">
                                            <a href="{{ URL::to('/') }}/tranactions/application/view/{{ $lhistory['NAID'] }}" class="a-btn-view-2">View</a>                         
                                        </div>
                                    
                                    </td>                                                                  
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

                                <th>Paid Amount</th>
                                <th>Collector</th>
                                <th>Payment Date</th>
                                <th>Payment Type</th>
                                <th>Payment Status</th>
                            </tr>
                            <tr>
                                @if($paymenthistory)
                                    @foreach($paymenthistory as $history)
                                    <tr>
                                        <td>{{ $history['collectedAmount'] }}</td>
                                        <td>{{ $history['collector'] }}</td>
                                        <td>{{ ($history['paymentDate']) ? date('m/d/Y', strtotime($history['paymentDate'])):'' }}</td>
                                        <td>{{ $history['paymentType'] }}</td>
                                        <td>{{ $history['Payment_Status'] }}</td>
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