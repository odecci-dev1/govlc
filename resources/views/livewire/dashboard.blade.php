<div>
            <script src="{{ asset('jquery-master/jquery-3.3.1.min.js') }}"></script>
            <script src="{{ asset('jquery-master/jquery-ui.js') }}"></script>
            <script src="{{ asset('chartjs/chart.js') }}"></script>
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
                    <p>Loan Collection</p>
                    <p>{{ number_format(isset($data['totalLoanCollection']) ? $data['totalLoanCollection'] : 0, 2) }}</p>
                </div>
                <div class="wrapper">
                    <p>Advance Payment</p>
                    <p>{{ number_format(isset($data['totalAdvancePayment']) ? $data['totalAdvancePayment'] : 0, 2) }}</p>
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
                                <p>{{ isset($data['totalSavingsOutstanding']) ? number_format($data['totalSavingsOutstanding'], 2) : 0.00 }}</p>
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
                                <p>{{ isset($data['totalApplicationforApproval']) ? $data['totalApplicationforApproval'] : 0.00 }}</p>
                            </div>
                            <div class="tag-wrap">
                                <a href="{{ URL::to('/') }}/collection/list" class="transparentButton">View All</a>
                            </div>
                        </div>
                    </div>
                    <!-- * Big Card -->
                    <div class="big-card">
                        <div class="div-1">
                            <h2 style="font-size: 2.5rem;">Active Members</h2>
                            <div class="btn-wrapper">                                
                                <select  id="selectarea" wire:loading.attr="disabled" onchange="updateSalesChartData()" style="height: 4.4rem; background-color: #D6A330; font-size: 1.3rem; min-width: 25rem" class="select-option button">
                                    <option value="">All Areas</option> 
                                    @if($area)
                                        @foreach($area as $area)
                                            <option value="{{ $area['Id'] }}">{{ $area['Area'] }}</option> 
                                        @endforeach
                                    @endif                                   
                                </select>          
                                <select  id="selectdays" wire:loading.attr="disabled" onchange="updateSalesChartData()" style="height: 4.4rem; background-color: #D6A330; font-size: 1.3rem; min-width: 20rem" class="select-option button">
                                    <option value="7">7 days</option>
                                    <option value="15">15 days</option>                                    
                                    <option value="30">30 days</option>
                                    <option value="1">1 year</option>
                                </select>    
                            </div>
                        </div>
                        <!-- * Line Chart -->
                        <div class="div-2" wire:ignore>
                            <div class="graph">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- * Dashboard Container 3 -->
                <div class="md-con-3">
                    <div class="card-2">
                        <div class="div-1">
                            <h3>Total Income</h3>
                            <p>{{ !empty($data['totalIncome']) ? number_format($data['totalIncome'], 2) : 0.00 }}</p>
                            <p>{{ !empty($data['totalDaysLeft']) ? $data['totalDaysLeft'] : 0 }} days left to achieve the target.</p>
                        </div>
                        <div class="divider"></div>
                        <div class="div-2">
                            <div class="circle-div" id="circle-div">
                                <div class="progress-value" id="progress-value">
                                    <p>{{ !empty($data['totalPercentOfLastEntry']) ? number_format($data['totalPercentOfLastEntry'], 2) : 0 }}%</p>
                                    <p>{{ !empty($data['totalIncomePercentage']) ? number_format($data['totalIncomePercentage'], 2) : '0.00' }}</p>
                                    <p>As of last entry</p>
                                </div>
                            </div>
                            <p>Last month target 
                                <span>
                                    @if (!empty($data['targetStatus']) && $data['targetStatus'])
                                        <span style="padding: 0.4rem 1.2rem; border-radius: 25px; background: rgb(2, 59, 19); color: rgb(91, 236, 115)">Achieved</span>
                                    @else
                                        <span style="padding: 0.4rem 1.2rem; border-radius: 25px; background: rgb(59, 2, 2); color: rgb(236, 91, 91)">Not Achieved</span>
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="card-2 " style="display: inline;">
                        <h3>Top Collectibles Per Area</h3>
                        <div class="div-1" style="height: 21rem; overflow-y: auto;">
                            @forelse ($topcollectibles as $top)
                                <div class="p-wrap">
                                    <div class="wrap">
                                        <p>{{  $top['areaName'] }}</p>
                                        <p style="padding-right: 5px;">{{  !empty($top['amount']) ? number_format($top['amount'], 2) : '0.00' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div style="height: 100%; display: flex; flex-direction: column; justify-content: center;  align-items: center">
                                    <span style="text-align: center; font-weight: 600; font-size: 1.6rem;">No Data Available</span>
                                    <span style="text-align: center; font-size: 1.2rem;  color: rgba(0, 0, 0, 0.5)">No current data available</span>
                                </div>
                            @endforelse                      
                        </div>
                        <div class="div-2">
                            <a href="{{ URL::to('/') }}/collection/list" class="button">View All</a>
                        </div>
                    </div>
                </div>

            </div>


            <div class="con-wrapper tlpa">
                <div class="md-con-2 tlpa">
                    <!-- * Big Card -->
                    <div class="big-card">
                       
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
            
                                        <!-- * Active Collection -->
                                        <th><span class="th-name">Active Collection</span></th>
            
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
                                    <!-- dito -->
                                    @php
                                        //$activecollections = !empty($data['areaActiveCollection']) ? $data['areaActiveCollection'] : [];
                                    @endphp   
                                    <!-- * Data Table -->
                                    @if($activecollections)
                                        @foreach($activecollections as $activecoll)
                                        <tr>            
                                            <!-- * Td Num-->
                                            <td>
                                                <span class="td-num"></span>
                                            </td>
                
                                            <!-- * Area -->
                                            <td>
                                                <span class="td-name">{{ $activecoll['area'] }}</span>
                                            </td>
                
                                            <!-- * Acrive Collection -->
                                            <td>
                                                <span class="td-name">{{ !empty($activecoll['activeCollection']) ? number_format($activecoll['activeCollection'], 2) : '0.00' }}</span>
                                            </td>
                
                                            <!-- * New Account-->
                                            <td class="td-name">{{ $activecoll['newAccount'] }}</td>
                
                                            <!-- * # NPS -->
                                            <td class="td-bal">{{ $activecoll['noPayment'] }}</td>
                
                                            <!-- * Past Due Collection -->
                                            <td class="td-due">{{ !empty($activecoll['pastDueCollection']) ? number_format($activecoll['pastDueCollection'], 2) : '0.00' }}</td>
                
                                        </tr>
                                        @endforeach                                        
                                    @endif                                                                        
                                </table>                                
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- * Dashboard Container 3 -->
                <div class="md-con-3 tlpa">
                    <div class="card-2 tlpa">
                        <h3>Top Lapses Per Area</h3>
                        <div class="div-1" style="height: 180rem; overflow-y: auto;">
                            @forelse ($toplapses as $lapses)
                                <div class="p-wrap">
                                    <div class="wrap">
                                        <p>{{ $lapses['areaName'] }}</p>
                                        <p  style="padding-right: 5px;">{{ !empty($lapses['amount']) ? number_format($lapses['amount'], 2) : '0.00' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div style="height: 100%; display: flex; flex-direction: column; justify-content: center;  align-items: center">
                                    <span style="text-align: center; font-weight: 600; font-size: 1.6rem;">No Data Available</span>
                                    <span style="text-align: center; font-size: 1.2rem;  color: rgba(0, 0, 0, 0.5)">No current data available</span>
                                </div>
                            @endforelse                    
                        </div>
                        <div class="div-2">
                            <a href="{{ URL::to('/') }}/collection/list" class="button">View All</a>
                        </div>
                    </div>
                </div>
            </div>    
</div>

<style>
    .main-dashboard .con-wrapper .md-con-3 .card-2:first-of-type .div-2 .circle-div::before {
        content: "";
        position: absolute;
        z-index: 1;
        aspect-ratio: 1/1;
        height: 100%;
        width: 100%;
        border-radius: 50%;
        background: conic-gradient(#D6A330 {{ !empty($data['totalPercentOfLastEntry']) ? $data['totalPercentOfLastEntry'] : 0 }}%, #FFFF4E 0%);
    }
</style>
<script>
     document.addEventListener('livewire:load', function () {   
        var ctx = document.getElementById("myChart").getContext("2d");
        const chartData = { 
            labels: [], // conditions to made //labels horizontal
            datasets: [
                    {
                        label: "Members",
                        data: [], // create an aync ajax function //data vertical
                        backgroundColor: "white",
                        borderColor: "green",
                        borderWidth: 3,
                    },
            ],
        };

        var chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                        },                   
                    },
                ],
            },       
        };

        // Create the chart instance
        var myChart = new Chart(ctx, {
            type: "line",
            data: chartData,
            options: chartOptions,
        });

        // updateSalesChartData = function () {         
        //     const mlabels = [];
        //     const mdata = [];
        //     var cdata = <?php echo json_encode($activemembers); ?>;               
           
        //     for (let j = 0; j < cdata.length; j++) {                  
        //         mlabels.push(cdata[j]['date']); 
        //         mdata.push(cdata[j]['count']);   
        //     } 
                       
        //     chartData.datasets[0].data = mdata;
        //     chartData.labels = mlabels;
        //     myChart.update();                 
        // };          

        updateSalesChartData = function () {  
            var area = document.getElementById('selectarea');
            var days = document.getElementById('selectdays');        
            $.ajax({
                method: 'get',
                url: '/get/active/members',    
                data: { area: area.value, days: days.value},   
                success: function (data) {   
                    data.reverse();
                    const mlabels = [];
                    const mdata = [];                    
                   
                    for (let j = 0; j < data.length; j++) {                               
                        mlabels.push(data[j]['date']); 
                        mdata.push(data[j]['count']);   
                    }  
                    
                    chartData.datasets[0].data = mdata;
                    chartData.labels = mlabels;
                    myChart.update();          
                },
                error:function (data){
                      
                    alert("Error");   
                },
                dataType: 'json'
            });          
        };

      
        updateSalesChartData();
        // Update the chart data
        // setInterval(updateSalesChartData(), 1000);     
    });           
    
</script>
