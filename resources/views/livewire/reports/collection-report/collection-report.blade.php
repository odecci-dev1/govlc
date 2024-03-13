<div>
    <script src="{{ asset('jquery-master/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('jquery-master/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery.print/jQuery.print.js') }}"></script>  
    <div class="reports-container">
    <div class="report-inner-container-2">
            <div class="header-wrapper">
                <div class="inner-wrapper date-picker">
                    <h2>Collection Report</h2>                                      
                </div>
                <!-- * Print and Export Buttons -->
                <div class="inner-wrapper">
                    <button class="button-2" wire:click="print" type="button" data-print-button>Print</button>
                    <button wire:click="exportCollectionReport" type="button" class="button-2" data-export-button>Export</button>
                </div>
            </div>
            <div class="header-wrapper" style="padding-top: 3rem;">
                <div class="inner-wrapper date-picker">                                 
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date Start</span>
                        <input type="date" wire:model.lazy="datestart" class="">
                        @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
                    </div>
                    <div class="input-wrapper">
                        <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date End</span>
                        <input type="date" wire:model.lazy="dateend" class="">
                        @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
                    </div>                                     
                </div>              
            </div>
        <div class="body-wrapper">
            <!-- * Container: Reports Table -->
            <div class="reports-table-container">

                <!-- * Table Container -->
                <div class="table-container">

                    <!-- * Collection Table -->
                    <table>

                        <!-- * Table Header -->
                        <tr>

                            <!-- * Checkbox ALl-->
                            <!-- <th><input type="checkbox" class="checkbox" data-select-all-checkbox></th> -->

                            <!-- * Area -->
                            <th><span class="th-name">Area</span></th>

                            <!-- * Field Officer -->
                            <th><span class="th-name">Field Officer</span></th>

                            <!-- * Total Collection -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Collection</span>
                            </th>

                            <!-- * Total Savings -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Savings</span>
                            </th>

                            <!-- * Total Lapses -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Lapses</span> 
                            </th>

                            <!-- * Total Advance -->
                            <th style="text-align: right;">
                                <span class="th-name">Total Advances</span> 
                            </th>

                            <!-- * Cash Remit -->
                            <th style="text-align: right;">
                                <span class="th-name">Cash Remitted</span> 
                            </th>

                            <!-- * Total NP -->
                            <th style="text-align: center;">
                                <span class="th-name">Total NP</span> 
                            </th>

                            <th>
                                <span class="th-name">Collection Date</span> 
                            </th>
                        </tr>

                        <!-- * All Members Data -->
                            @if($res)
                                @foreach($res as $data)
                                <tr>

                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ $data['areaName'] }}</span></td>

                                    <td><span class="td-name">{{ $data['fieldOfficer'] }}</span></td>
                                
                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalCollection']) ? number_format($data['totalCollection'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalSavings']) ? number_format($data['totalSavings'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalLapses']) ? number_format($data['totalLapses'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalAdvance']) ? number_format($data['totalAdvance'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['cashRemit']) ? number_format($data['cashRemit'], 2) : '0.00' }}</span>
                                    </td>

                                    <td  style="text-align: center;">
                                        <span class="td-name">{{ !empty($data['totalNP']) ? $data['totalNP'] : 0 }}</span>
                                    </td>

                                    <td>
                                        <span class="td-name">{{ !empty($data['dateCollected']) ? date('Y-m-d', strtotime($data['dateCollected'])) : 0 }}</span>
                                    </td>

                                </tr>
                                @endforeach
                            @endif

                    </table>
                
                </div>

                <!-- * Total Collection Footer -->
                <div class="total-collection-footer">
                    <div class="footer-wrapper">
                        <p>Total Collection:</p> 
                        <span id="">{{ number_format($res->sum('totalCollection'), 2) }}</span>
                    </div>
                </div>

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