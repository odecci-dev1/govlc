<div>
    <script src="{{ asset('jquery-master/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('jquery-master/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery.print/jQuery.print.js') }}"></script>    
    <!-- * Filter Modal -->
   
        <div class="reports-container">
        <div class="report-inner-container-2">
            <div class="header-wrapper">
                <div class="inner-wrapper date-picker">
                    <h2>Release Report</h2>                                      
                </div>
                <!-- * Print and Export Buttons -->
                <div class="inner-wrapper">
                    <button class="button-2" wire:click="print" type="button"  data-print-button>Print</button>                
                    <button wire:click="exportReleaseReport" type="button" class="button-2" data-print-button>Export</button>
                </div>
            </div>
            <div class="header-wrapper" style="padding-top: 3rem;">
                <div class="inner-wrapper date-picker">                                 
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date Start</span>
                        <input type="date" wire:model.lazy="datestart" class="">
                    </div>
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date End</span>
                        <input type="date" wire:model.lazy="dateend" class="">
                    </div>                                     
                </div>              
            </div>
            <div class="body-wrapper">
                <!-- * Container: Reports Table -->
                <div class="reports-table-container" id="reports-table-container">

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

                                <!-- * Date Released -->
                                <th>
                                    <span class="th-name">Date Released</span> 
                                </th>

                            </tr>

                            <!-- * Release Data -->
                            @if($data)
                                @foreach($data as $data)
                                <tr>

                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ $data['naid'] }}</span></td>

                                    <!-- * Member Name -->
                                    <td><span class="td-name">{{ $data['borrower'] }}</span></td>

                                    <!-- * Co Borrower -->
                                    <td>
                                        <span class="td-name">{{ $data['co_Borrower'] }}</span>
                                    </td>

                                    <!-- * Area -->
                                    <td>
                                        <span class="td-name">{{ $data['area'] }}</span>
                                    </td>

                                    <!-- * Loan Type -->
                                    <td>
                                        <span class="td-name">{{ $data['loanType'] }}</span> 
                                    </td>

                                    <!-- * Loan Amount -->
                                    <td>
                                        <span class="td-name">{{ number_format($data['loanAmount'], 2) }}</span> 
                                    </td>

                                    <!-- * Advance Payment -->
                                    <td>
                                        <span class="td-name">{{ !empty($data['advancePayment']) ? number_format($data['advancePayment'], 2) : 0.00 }}</span> 
                                    </td>

                                    <!-- * Terms -->
                                    <td>
                                        <span class="td-name">{{ !empty($data['termofPayment']) ? $data['termofPayment'] : 'No terms' }}</span> 
                                    </td>

                                    <!-- * Due Date -->
                                    <td>
                                        <span class="td-name">{{ !empty($data['dueDate']) ? date('Y-m-d', strtotime($data['dueDate'])) : 'Empty date' }}</span> 
                                    </td>

                                    <!-- * Date Released -->
                                    <td>
                                        <span class="td-name">{{ $data['releasingDate'] }}</span> 
                                    </td>

                                </tr>
                                @endforeach
                            @endif
                            

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
     document.addEventListener('livewire:load', function () {         
        window.livewire.on('printReport', message => {
                $.print(message.data, {
                    globalStyles: false,
                    mediaPrint: true,
                    stylesheet: null,
                    noPrintSelector: ".no-print",
                    iframe: true,
                    append: null,
                    prepend: null,
                    manuallyCopyFormValues: true,
                    deferred: $.Deferred(),
                    timeout: 750,
                    title: null,
                });                             
        });            
    });           
</script>