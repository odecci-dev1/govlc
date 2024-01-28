<div>
    <script src="{{ asset('jquery-master/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('jquery-master/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery.print/jQuery.print.js') }}"></script>    
    <!-- * Filter Modal -->
   
        <div class="reports-container">
        <div class="report-inner-container-2">
            <div class="header-wrapper">
                <div class="inner-wrapper date-picker">
                    <h2>Declined Applications Report</h2>                                      
                </div>
                <!-- * Print and Export Buttons -->
                <div class="inner-wrapper">
                  
                </div>
            </div>
            <div class="header-wrapper" style="padding-top: 1rem;">
                <div class="inner-wrapper date-picker">                                 
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Search here . . .</span>
                        <input type="text" wire:model="keyword" class="" style="width: 40rem;">
                        @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
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

                                <!-- * Loan Amount -->
                                <th>
                                    <span class="th-name">Loan Amount</span> 
                                </th>

                                <!-- * Date Released -->
                                <th>
                                    <span class="th-name">Remarks for declining</span> 
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
                                   
                                    <!-- * Loan Amount -->
                                    <td>
                                        <span class="td-name">{{ number_format($data['loanAmount'], 2) }}</span> 
                                    </td>

                                    <td>
                                        <span class="td-name">{{ $data['remarks'] }}</span> 
                                    </td>

                                </tr>
                                @endforeach
                            @endif
                            

                        </table>
                    
                    </div>

                    @if($paginationPaging['totalPage'] > 1)
                    <div class="pagination-container" style="overflow-x: auto;">

                        <!-- * Pagination Links -->
                        <a href="#" wire:click="setPage({{ $this->paginationPaging['prevPage'] }})"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left"></a>
                        @for($x = 1; $x <= $paginationPaging['totalPage']; $x++)
                        <a href="#" wire:click="setPage({{ $x }})" class="{{ $paginationPaging['currentPage'] == $x ? 'font-size-1_4em color-app' : '' }}">{{ $x }}</a>
                        @endfor
                        <a href="#" wire:click="setPage({{ $this->paginationPaging['nextPage'] }})"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right"></a>

                    </div>
                    @endif
                    
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
