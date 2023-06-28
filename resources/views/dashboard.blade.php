@extends('layouts.app') 
@section('content')
    <!-- * Dashboard Container 1 -->
            <div class="md-con-1">
                <div class="wrapper">
                    <p>Active Member</p>
                    <p>300</p>
                </div>
                <div class="wrapper">
                    <p>Total Loan Released</p>
                    <p>500,000</p>
                </div>
                <div class="wrapper">
                    <p>Total Penalties</p>
                    <p>100,000</p>
                </div>
                <div class="wrapper">
                    <p>Total Savings</p>
                    <p>125,000</p>
                </div>
                <div class="wrapper">
                    <p>Total Interest</p>
                    <p>75,000</p>
                </div>
                <div class="wrapper">
                    <p>Total Loan Outstanding</p>
                    <p>75,000</p>
                </div>
                <div class="wrapper">
                    <p>Total Interest</p>
                    <p>180,000</p>
                </div>
            </div>

            <!-- * Wrapper for Container 1 & 2-->

            <div class="con-wrapper">

                <!-- * Dashboard Container 2 -->
                <div class="md-con-2">
                    <div class="card-wrapper">
                        <div class="card">
                            <div class="p-wrap">
                                <p>Daily Target Collection</p>
                                <p>15,232</p>
                            </div>
                            <div class="tag-wrap">
                                <p>
                                    Covered the
                                    <!-- * Special Span -->
                                    <span>10%</span> of the monthly target
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="p-wrap">
                                <p>Penalties to be collected today</p>
                                <p>8,000</p>
                            </div>
                            <div class="tag-wrap">
                                <p>
                                    Most penalties are from
                                    <!-- * Special Span -->
                                    <span>Area 2</span>
                                </p>

                                <p></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="p-wrap">
                                <p>Application for Approval</p>
                                <p>50</p>
                            </div>
                            <div class="tag-wrap">
                                <button>View All</button>
                            </div>
                        </div>
                    </div>
                    <!-- * Big Card -->
                    <div class="big-card">
                        <div class="div-1">
                            <h2>Active Members</h2>
                            <div class="btn-wrapper">
                                <button>Select Area</button>
                                <button>
                                    <span>Last 7 Days</span>
                                    <img
                                        src="../res/assets/icons/white-carret-down.svg"
                                        alt="carret-down"
                                    />
                                </button>
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
                            <h3>Monthly Target Collection</h3>
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
                    <div class="card-2">
                        <h3>Top Members with Penalty</h3>
                        <div class="div-1">
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Juana Dela Cruz</p>
                                    <p>900.00</p>
                                </div>
                                <p>Area 3</p>
                            </div>
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Julius Perez</p>
                                    <p>500.00</p>
                                </div>
                                <p>Area 1</p>
                            </div>
                            <div class="p-wrap">
                                <div class="wrap">
                                    <p>Macario Reyes</p>
                                    <p>300.00</p>
                                </div>
                                <p>Area 2</p>
                            </div>
                        </div>
                        <div class="div-2">
                            <button>View All</button>
                        </div>
                    </div>
                </div>
@endsection