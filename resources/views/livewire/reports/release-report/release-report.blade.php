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
                    <button wire:click="exportReport" type="button" class="button-2" data-print-button>Export</button>
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
            <div class="body-wrapper" style="gap: 0; height:clamp(100% - 21rem, 40rem, 80vh); overflow-y: auto;">
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
                            @forelse ($members as $member)
                                <tr>

                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ $member->NAID }}</span></td>

                                    <!-- * Member Name -->
                                    <td><span class="td-name">{{ $member->member->full_name }}</span></td>

                                    <!-- * Co Borrower -->
                                    <td>
                                        <span class="td-name">{{ $member->comaker->Lnam . $member->comaker->full_name }}</span>
                                    </td>

                                    <!-- * Area -->
                                    <td>
                                        <span class="td-name">{{ !empty($member->areaName) ? $member->areaName : 'N/A' }}</span> 
                                    </td>

                                    <!-- * Loan Type -->
                                    <td>
                                        <span class="td-name">{{ $member->loantype->LoanTypeName }}</span> 
                                    </td>

                                    <!-- * Loan Amount -->
                                    <td>
                                        <span class="td-name">{{ number_format($member->detail->ApprovedLoanAmount, 2) }}</span> 
                                    </td>
                                    <!-- * Advance Payment -->
                                    <td>
                                        <span class="td-name">{{ !empty($member->detail->ApprovedAdvancePayment) ? number_format($member->detail->ApprovedAdvancePayment, 2) : 0.00 }}</span> 
                                    </td>

                                    <!-- * Terms -->
                                    <td>
                                        <span class="td-name">{{ !empty($member->termsofpayment->NameOfTerms) ? $member->termsofpayment->NameOfTerms : 'No terms' }}</span> 
                                    </td>

                                    <!-- * Due Date -->
                                    <td>
                                        <span class="td-name">{{ !empty($member->loanHistory->DueDate) ? date('m-d-Y', strtotime($member->loanHistory->DueDate)) : 'Empty date' }}</span> 
                                    </td>

                                    <!-- * Date Released -->
                                    <td>
                                        <span class="td-name">{{ !empty($member->loanHistory->DateReleased) ? date('m-d-Y', strtotime($member->loanHistory->DateReleased)) : 'Empty date' }}</span> 
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    
                    </div>

                    <!-- * Total Release Footer -->
                    <div class="total-collection-footer" style="display: flex; justify-content: space-between;">
                        <div style="margin: auto 0 auto 4rem;">
                            <p style="font-size: 1.4rem">
                                {{$paginationPaging['startItem']}}-{{ $paginationPaging['endItem'] }} of <span style="font-weight: 700;">{{ $paginationPaging['totalRecord'] }}</span> Results 
                            </p>
                        </div>
                        <div class="footer-wrapper">
                            {{-- <p>Total Savings:</p> 
                            <span>{{ number_format($totalSavings, 2) }}</span> --}}
                        </div>
                    </div>

                </div>

                <div style="display: flex; flex-direction: column">
                    @if($paginationPaging['totalPage'])
                        <div class="pagination-container">
    
                            <a href="#" wire:click.prevent="goToFirstPage">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L12.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M4.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L6.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <!-- Previous Button -->
                            @if($paginationPaging['prevPage'])
                                <a href="#" wire:click.prevent="setPage({{ $paginationPaging['prevPage'] }})">
                                    <img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left">
                                </a>
                            @endif
                    
                            <!-- Pagination Buttons -->
                            @php
                                $startPage = max(1, $paginationPaging['currentPage'] - 2);
                                $endPage = min($paginationPaging['totalPage'], $paginationPaging['currentPage'] + 2);
                    
                                if ($endPage - $startPage < 4) {
                                    if ($startPage > 1) {
                                        $startPage = max(1, $endPage - 4);
                                    } else {
                                        $endPage = min($paginationPaging['totalPage'], $startPage + 4);
                                    }
                                }
                            @endphp
                    
                            @for ($i = $startPage; $i <= $endPage; $i++)
                                <a href="#" wire:click.prevent="setPage({{ $i }})" class="{{ $paginationPaging['currentPage'] == $i ? 'font-size-1_4em color-app' : '' }}">{{ $i }}</a>
                            @endfor
                    
                            <!-- Next Button -->
                            @if($paginationPaging['nextPage'])
                                <a href="#" wire:click.prevent="setPage({{ $paginationPaging['nextPage'] }})">
                                    <img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right">
                                </a>
                            @endif
    
                            <a href="#" wire:click.prevent="goToLastPage">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M13.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M19.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    @endif
                    <p style="text-align: center; font-size: 1.2rem; opacity: 0.7;">
                        Page <span style="font-weight: 700;">{{$paginationPaging['currentPage']}}</span> of {{$paginationPaging['totalPage']}}
                    </p>
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