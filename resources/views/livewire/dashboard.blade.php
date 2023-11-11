<div>
            <div class="md-con-1">
                <div class="wrapper">
                    <p>Active Member</p>
                    <p>{{ $data['activeMemberCount'] }}</p>
                </div>
                <div class="wrapper">
                    <p>Loan Balance</p>
                    <p>{{ number_format(isset($data['totalLoanBalance']) ? $data['totalLoanBalance'] : 0, 2) }}</p>
                </div>
                <div class="wrapper">
                    <p>Total Interest</p>
                    <p>{{ number_format(isset($data['totalInterest']) ? $data['totalInterest'] : 0, 2) }}</p>
                </div>
                <div class="wrapper">
                    <p>Loan Colection</p>
                    <p>{{ number_format(isset($data['totalLoanCollection']) ? $data['totalLoanCollection'] : 0, 2) }}</p>
                </div>
                <div class="wrapper">
                    <p>Advance Payment</p>
                    <p>{{ number_format(isset($data['totaolAdvancePayment']) ? $data['totaolAdvancePayment'] : 0, 2) }}</p>
                </div>
                <div class="wrapper">
                    <p>Other Deductions</p>
                    <p>{{ number_format(isset($data['totalOtherDeductions']) ? $data['totalOtherDeductions'] : 0, 2) }}</p>
                </div>
                <div class="wrapper">
                    <p>Total Active Standing</p>
                    <p>{{ number_format(isset($data['totalActiveStanding']) ? $data['totalActiveStanding'] : 0, 2) }}</p>
                </div>
                <div class="wrapper">
                    <p>#FP</p>
                    <p>{{ $data['totalFullPayment'] }}</p>
                </div>
                <div class="wrapper">
                    <p>#CR</p>
                    <p>{{ $data['totalCR'] }}</p>
                </div>
                <div class="wrapper">
                    <p>Total ending active member</p>
                    <p>{{ isset($data['totalEndingActiveMember']) ? $data['totalEndingActiveMember'] : 0 }}</p>
                </div>
            </div>

            <!-- * Wrapper for Container 1 & 2-->

            <div class="con-wrapper">

                <!-- * Dashboard Container 2 -->
                <div class="md-con-2">
                    <div class="card-wrapper">
                        <div class="card">
                            <div class="p-wrap">
                                <p>Savings Outstanding</p>
                                <p>{{ isset($data['totalSvaingsOutstanding']) ? number_format($data['totalSvaingsOutstanding'], 2) : 0.00 }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="p-wrap">
                                <p>Daily Overall Collection</p>
                                <p>{{ isset($data['totalDailyOverallCollection']) ? number_format($data['totalDailyOverallCollection'], 2) : 0.00 }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="p-wrap">
                                <p>New Accounts Overall</p>
                                <p>{{ isset($data['totalNewAccountsOverall']) ? $data['totalNewAccountsOverall'] : 0.00 }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="p-wrap">
                                <p>Application for Approval</p>
                                <p>{{ isset($data['totalNewAccountsOverall']) ? $data['totalApplicationforApproval'] : 0.00 }}</p>
                            </div>
                            <div class="tag-wrap">
                                <button class="transparentButton">View All</button>
                            </div>
                        </div>
                    </div>
                    <!-- * Big Card -->
                    <div class="big-card">
                        <div class="div-1">
                            <h2 style="font-size: 2.5rem;">Active Members</h2>
                            <div class="btn-wrapper">
                                <button class="button" style="font-size: 1.5rem !important;">Select Area</button>
                                <!-- * Filter Dropdown Button -->
                                <div class="dropdown-button">
                                    <div class="dropdown-select-box">
    
                                        <div class="dropdown-options-container" data-option-con0>
    
                                            <div class="dropdown-option" data-option-item0>
    
                                                <input type="radio" class="radio" name="category" value="7 Days" />
                                                <label for="7 Days">
                                                    <h4>7 Days</h4>
                                                </label>
    
                                            </div>
    
                                            <div class="dropdown-option" data-option-item0>
    
                                                <input type="radio" class="radio" name="category" value="Option 2" />
                                                <label for="Option 2">
                                                    <h4>Option 2</h4>
                                                </label>
    
                                            </div>
    
                                            <div class="dropdown-option" data-option-item0>
    
                                                <input type="radio" class="radio" name="category" value="Option 3" />
                                                <label for="Option 3">
                                                    <h4>Option 3</h4>
                                                </label>
    
                                            </div>
    
                                            <div class="dropdown-option" data-option-item0>
    
                                                <input type="radio" class="radio" name="category" value="Option 4" />
                                                <label for="Option 4">
                                                    <h4>Option 4</h4>
                                                </label>
    
                                            </div>
    
                                        </div>
    
                                        <div class="dropdown-selected" data-option-select0>
                                            <h4>Select Filter</h4>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- * Line Chart -->
                        <div class="div-2">
                            <div class="graph">
                                <canvas id="Chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- * Dashboard Container 3 -->
                <div class="md-con-3">
                    <div class="card-2">
                        <div class="div-1">
                            <h3>Total Income</h3>
                            <p>200,000</p>
                            <p>10 days left to achieve the target.</p>
                        </div>
                        <div class="divider"></div>
                        <div class="div-2">
                            <div class="circle-div">
                                <div class="progress-value">
                                    <p>50%</p>
                                    <p>100,000</p>
                                    <p>As of last entry</p>
                                </div>
                            </div>
                            <p>Last month target <span>Achieved</span></p>
                        </div>
                    </div>
                    <div class="card-2 ">
                        <h3>Top Collectibles Per Area</h3>
                        <div class="div-1">
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Area 3</p>
                                    <p>900.00</p>
                                </div>
                            </div>
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Area 1</p>
                                    <p>500.00</p>
                                </div>
                            </div>
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Area 4</p>
                                    <p>300.00</p>
                                </div>
                            </div>
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Area 2</p>
                                    <p>300.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="div-2">
                            <button class="button">View All</button>
                        </div>
                    </div>
                </div>

            </div>


            <div class="con-wrapper tlpa">
                <div class="md-con-2 tlpa">
                    <!-- * Big Card -->
                    <div class="big-card">
                        <div class="div-1">
                            <div class="btn-wrapper">
                                <button class="button"  style="font-size: 1.5rem !important;">View All</button>
                                <!-- * Filter Dropdown Button -->
                                <div class="dropdown-button">
                                    <div class="dropdown-select-box">
    
                                        <div class="dropdown-options-container" data-option-con00>
    
                                            <div class="dropdown-option" data-option-item00>
    
                                                <input type="radio" class="radio" name="category" value="7 Days" />
                                                <label for="7 Days">
                                                    <h4>7 Days</h4>
                                                </label>
    
                                            </div>
    
                                            <div class="dropdown-option" data-option-item00>
    
                                                <input type="radio" class="radio" name="category" value="Option 2" />
                                                <label for="Option 2">
                                                    <h4>Option 2</h4>
                                                </label>
    
                                            </div>
    
                                            <div class="dropdown-option" data-option-item00>
    
                                                <input type="radio" class="radio" name="category" value="Option 3" />
                                                <label for="Option 3">
                                                    <h4>Option 3</h4>
                                                </label>
    
                                            </div>
    
                                            <div class="dropdown-option" data-option-item00>
    
                                                <input type="radio" class="radio" name="category" value="Option 4" />
                                                <label for="Option 4">
                                                    <h4>Option 4</h4>
                                                </label>
    
                                            </div>
    
                                        </div>
    
                                        <div class="dropdown-selected" data-option-select00>
                                            <h4>Select Filter</h4>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- * Table -->
                        <div class="div-2">
                            <div class="table-container">

                                <!-- * All Members Table -->
                                <table id="borrowerTable">
            
                                    <!-- * Table Header -->
                                    <tr>
            
                                        <th></th>
            
                                        <!-- * Area -->
                                        <th><span class="th-name">Area</span></th>
            
                                        <!-- * Acrive Collection -->
                                        <th><span class="th-name">Acrive Collection</span></th>
            
                                        <!-- * New Account -->
                                        <th>
                                            <span class="th-name">New Account</span>
                                        </th>
            
                                        <!-- * # NPS -->
                                        <th>
                                            <span class="th-name"># NPS</span>
                                        </th>
            
                                        <!-- * Past Due Collection -->
                                        <th>
                                            <span class="th-name">Past Due Collection</span>
                                        </th>
            
                                    </tr>
            
                                    <!-- * Data Table -->
                                    <tr>
            
                                        <!-- * Td Num-->
                                        <td>
                                            <span class="td-num"></span>
                                        </td>
            
                                        <!-- * Area -->
                                        <td>
                                            <span class="td-name">Area 5</span>
                                        </td>
            
                                        <!-- * Acrive Collection -->
                                        <td>
                                            <span class="td-name">0.00</span>
                                        </td>
            
                                        <!-- * New Account-->
                                        <td class="td-name">1</td>
            
                                        <!-- * # NPS -->
                                        <td class="td-bal">0</td>
            
                                        <!-- * Past Due Collection -->
                                        <td class="td-due">1,200.00</td>
            
                                    </tr>
                                    <tr>
            
                                        <!-- * Td Num-->
                                        <td>
                                            <span class="td-num"></span>
                                        </td>
            
                                        <!-- * Area -->
                                        <td>
                                            <span class="td-name">Area 5</span>
                                        </td>
            
                                        <!-- * Acrive Collection -->
                                        <td>
                                            <span class="td-name">0.00</span>
                                        </td>
            
                                        <!-- * New Account-->
                                        <td class="td-name">1</td>
            
                                        <!-- * # NPS -->
                                        <td class="td-bal">0</td>
            
                                        <!-- * Past Due Collection -->
                                        <td class="td-due">1,200.00</td>
            
                                    </tr>
                                    <tr>
            
                                        <!-- * Td Num-->
                                        <td>
                                            <span class="td-num"></span>
                                        </td>
            
                                        <!-- * Area -->
                                        <td>
                                            <span class="td-name">Area 5</span>
                                        </td>
            
                                        <!-- * Acrive Collection -->
                                        <td>
                                            <span class="td-name">0.00</span>
                                        </td>
            
                                        <!-- * New Account-->
                                        <td class="td-name">1</td>
            
                                        <!-- * # NPS -->
                                        <td class="td-bal">0</td>
            
                                        <!-- * Past Due Collection -->
                                        <td class="td-due">1,200.00</td>
            
                                    </tr>
                                    <tr>
            
                                        <!-- * Td Num-->
                                        <td>
                                            <span class="td-num"></span>
                                        </td>
            
                                        <!-- * Area -->
                                        <td>
                                            <span class="td-name">Area 5</span>
                                        </td>
            
                                        <!-- * Acrive Collection -->
                                        <td>
                                            <span class="td-name">0.00</span>
                                        </td>
            
                                        <!-- * New Account-->
                                        <td class="td-name">1</td>
            
                                        <!-- * # NPS -->
                                        <td class="td-bal">0</td>
            
                                        <!-- * Past Due Collection -->
                                        <td class="td-due">1,200.00</td>
            
                                    </tr>
                                    <tr>
            
                                        <!-- * Td Num-->
                                        <td>
                                            <span class="td-num"></span>
                                        </td>
            
                                        <!-- * Area -->
                                        <td>
                                            <span class="td-name">Area 5</span>
                                        </td>
            
                                        <!-- * Acrive Collection -->
                                        <td>
                                            <span class="td-name">0.00</span>
                                        </td>
            
                                        <!-- * New Account-->
                                        <td class="td-name">1</td>
            
                                        <!-- * # NPS -->
                                        <td class="td-bal">0</td>
            
                                        <!-- * Past Due Collection -->
                                        <td class="td-due">1,200.00</td>
            
                                    </tr>
                                    <tr>
            
                                        <!-- * Td Num-->
                                        <td>
                                            <span class="td-num"></span>
                                        </td>
            
                                        <!-- * Area -->
                                        <td>
                                            <span class="td-name">Area 5</span>
                                        </td>
            
                                        <!-- * Acrive Collection -->
                                        <td>
                                            <span class="td-name">0.00</span>
                                        </td>
            
                                        <!-- * New Account-->
                                        <td class="td-name">1</td>
            
                                        <!-- * # NPS -->
                                        <td class="td-bal">0</td>
            
                                        <!-- * Past Due Collection -->
                                        <td class="td-due">1,200.00</td>
            
                                    </tr>
                                    <tr>
            
                                        <!-- * Td Num-->
                                        <td>
                                            <span class="td-num"></span>
                                        </td>
            
                                        <!-- * Area -->
                                        <td>
                                            <span class="td-name">Area 5</span>
                                        </td>
            
                                        <!-- * Acrive Collection -->
                                        <td>
                                            <span class="td-name">0.00</span>
                                        </td>
            
                                        <!-- * New Account-->
                                        <td class="td-name">1</td>
            
                                        <!-- * # NPS -->
                                        <td class="td-bal">0</td>
            
                                        <!-- * Past Due Collection -->
                                        <td class="td-due">1,200.00</td>
            
                                    </tr>
                                    
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- * Dashboard Container 3 -->
                <div class="md-con-3 tlpa">
                    <div class="card-2 tlpa">
                        <h3>Top Lapses Per Area</h3>
                        <div class="div-1">
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Area 7</p>
                                    <p>900.00</p>
                                </div>
                            </div>
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Area 8</p>
                                    <p>500.00</p>
                                </div>
                            </div>
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Area 9</p>
                                    <p>300.00</p>
                                </div>
                            </div>
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Area 2</p>
                                    <p>300.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="div-2">
                            <button class="button">View All</button>
                        </div>
                    </div>
                </div>
            </div>    
</div>
