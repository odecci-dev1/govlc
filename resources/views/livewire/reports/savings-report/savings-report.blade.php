<div>    
    <div class="reports-container">
    <div class="report-inner-container-2">
            <div class="header-wrapper">
                <div class="inner-wrapper date-picker">
                    <h2>Savings Report</h2>                                      
                </div>
                <!-- * Print and Export Buttons -->
                <div class="inner-wrapper">
                    <button class="button-2" data-print-button>Print</button>
                    <button class="button-2" data-export-button>Export</button>
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

                    <!-- * Savings Table -->
                    <table id="savingsTable">

                        <!-- * Table Header -->
                        <tr>

                            <!-- * Checkbox ALl-->
                            <!-- <th><input type="checkbox" class="checkbox" data-select-all-checkbox></th> -->

                            <!-- * Member Name -->
                            <th><span class="th-name">Member Name</span></th>

                            <!-- * Area -->
                            <th><span class="th-name">Area</span></th>

                            <!-- * Total Savings -->
                            <th>
                                <span class="th-name">Total Savings</span>
                            </th>

                        </tr>

                        <!-- * Savings Data -->
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>
                        <tr>

                            <!-- * Member Name -->
                            <td><span class="td-name">Mario Sakay</span></td>

                            <!-- * Area -->
                            <td><span class="td-name">Area 1</span></td>

                            <!-- * Total Savings -->
                            <td>
                                <span class="td-name">700.00</span>
                            </td>

                        </tr>

                    </table>
                
                </div>

                <!-- * Total Collection Footer -->
                <div class="total-collection-footer">
                    <div class="footer-wrapper">
                        <p>Total Collection:</p> 
                        <span id="">700.00</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>
