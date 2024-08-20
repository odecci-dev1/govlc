<div>
    
    <div>    
        <div class="reports-container">
            <div class="report-inner-container-2">
                <div class="header-wrapper">
                    <div class="inner-wrapper date-picker">
                        <h2>Loan Calculator</h2>                                      
                    </div>
                    <!-- * Print and Export Buttons -->
                    <div class="inner-wrapper">
                        <button wire:click="calculatorToggle" type="button"  class="button" style="margin-left: 1rem">
                            {{ !$openCalculator ? 'Open Calculator' : 'Close Calculator' }}
                        </button>
                    </div>
                </div>
                @if ($openCalculator)
                    <!-- * Loan Calculator -->
                    <div style="overflow-x: auto; margin-top: 2rem; padding: 2.4rem 2rem; border-radius: 1.5rem; box-shadow: 1px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                        <!-- * Rowspan 2: Applied Loan Amount, Terms of Payment, Purpose, and Approve for Releasing Button -->
                        <div style="display: flex; gap: 2rem;">

                            <!-- * Applied Loan Amount -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Applied Loan Amount</span>
                                <input autocomplete="off" type="text" id="appliedLoanAmnt" name="appliedLoanAmnt">
                            </div>

                            <!-- * Terms of Payment -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Terms of Payment</span>
                                <input autocomplete="off" type="text" id="termsOfPaymnt" name="termsOfPaymnt">
                            </div>

                            <!-- * Purpose -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Purpose</span>
                                <input autocomplete="off" type="text" id="loanPurpose" name="loanPurpose">
                            </div>

                            <!-- * Approve for Releasing Button -->
                            <div class="input-wrapper" style="flex: 1; justify-content: flex-end;">
                                <button type="button" class="button" style="margin-bottom: 0.6rem;">Button</button>
                            </div>

                        </div>

                        <!-- * Rowspan 3: Savings, Notarial Fee, Advance Payment, and Change Loan Payment Button -->
                        <div style="display: flex; gap: 2rem; margin: 2rem 0;">

                            <!-- * Savings -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Savings</span>
                                <input autocomplete="off" type="text" id="loanSavings" name="loanSavings">
                            </div>

                            <!-- * Notarial Fee -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Notarial Fee</span>
                                <input autocomplete="off" type="text" id="notarialFee" name="notarialFee">
                            </div>

                            <!-- * Advance Payment -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Advance Payment</span>
                                <input autocomplete="off" type="text" id="advPayment" name="advPayment">
                            </div>

                            <!-- * Change Loan Payment -->
                            <div class="input-wrapper" style="flex: 1; justify-content: flex-end;">
                                <button type="button" class="button" style="margin-bottom: 0.6rem;">Button</button>
                            </div>

                        </div>

                        <!-- * Rowspan 4: Interest, Releasing Amount, Daily Amount Due, and Decline Button -->
                        <div style="display: flex; gap: 2rem;">

                            <!-- * Interest -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Interest</span>
                                <input autocomplete="off" type="text" id="interest" name="interest">
                            </div>

                            <!-- * Releasing Amount -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Releasing Amount</span>
                                <input autocomplete="off" type="text" id="releasingAmnt" name="releasingAmnt">
                            </div>

                            <!-- * Daily Amount Due -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Daily Amount Due</span>
                                <input autocomplete="off" type="text" id="dailyAmntDue" name="dailyAmntDue">
                            </div>

                            <!-- * Decline Button -->
                            <div class="input-wrapper" style="flex: 1; justify-content: flex-end;">
                                <button type="button" class="declineButton" style="margin-bottom: 0.5rem; padding: 1rem 4rem; font-size: 1.1rem">Button</button>
                            </div>

                        </div>

                    </div>
                @endif
                <div class="header-wrapper" style="padding-top: 3rem;">
                    <div class="inner-wrapper date-picker">                                 
                        <div class="input-wrapper">
                            <div style="position: relative;">
                                <input style="width: 45rem; padding-left: 4rem" type="text" wire:model.live="keyword" placeholder="Search...">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="position: absolute; left: 10; top: 10; width: 20px; height: 20px;">
                                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            @error('member') <span class="text-required">{{ $message }}</span> @enderror              
                        </div>       
                    </div>              
                </div>
                <div class="body-wrapper" style="gap: 0; height:clamp(100% - 21rem, 40rem, 80vh); overflow-y: auto;">
                    <!-- * Container: Reports Table -->
                    <div class="reports-table-container">
        
                        <!-- * Table Container -->
                        <div class="table-container">
        
                            <!-- * Savings Table -->
                            <table id="savingsTable">
        
                                <!-- * Table Header -->
                                <tr>
                                    <th style="text-align: left;"><span class="th-name">Loan Name</span></th>
                                    <th style="text-align: left;"><span class="th-name">Created By</span></th>
                                    <th style="text-align: left;"><span class="th-name">Date Created</span></th>
                                </tr>
                                @if($data)
                                    @foreach($data as $d)
                                    <!-- * Savings Data -->
                                    <tr>
                                        <!-- * Member Name -->                               
                                        <td><span class="td-name">{{ !empty($d->member->full_name) ? $d->member->full_name : 'N/A'  }}</span></td>
                                        <td style="text-align: left;">
                                            <span class="td-name">{{ !empty($d->LoanAmount) ? number_format($d->LoanAmount, 2) : '0.00' }}</span>
                                        </td>
                                        <td style="text-align: left;"><span class="td-name">{{ !empty($d->DateReleased) ? date('Y-m-d', strtotime($d->DateReleased)) : '' }}</span></td>
                                    </tr>
                                    @endforeach
                                @endif
                            
                            </table>
                        
                        </div>
        
                        <!-- * Total Past Due Days Footer -->
                        <div class="total-collection-footer" style="display: flex; justify-content: space-between;">
                            <div style="margin: auto 0 auto 4rem;">
                                <p style="font-size: 1.4rem">
                                    {{$paginationPaging['startItem']}}-{{ $paginationPaging['endItem'] }} of <span style="font-weight: 700;">{{ $paginationPaging['totalRecord'] }}</span> Results 
                                </p>
                            </div>
                            <div class="footer-wrapper">
                                <p>Total Collection:</p> 
                                {{-- <span>{{ number_format($totalSavings, 2) }}</span> --}}
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
