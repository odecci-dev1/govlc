<div>
    <dialog class="am-filter-modal" data-filter-member-modal>

    <div class="modal-container">

        <!-- * Modal Header and Exit Button -->
        <div class="modal-header">
            <h4>Filter</h4>
            <button class="exit-button" data-close-filter-member-modal>
                <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
            </button>
        </div>

        <!-- * Current Loan -->
        <div class="rowspan">

            <div class="input-wrapper-modal">
                <span>Current Loan</span>
                <input autocomplete="off" type="number" id="filterCurrentLoanFrom" name="filterCurrentLoanFrom" placeholder="From">
            </div>

            <div class="input-wrapper-modal">
                <input autocomplete="off" type="number" id="filterCurrentLoanTo" name="filterCurrentLoanTo" placeholder="To">
            </div>

        </div>

        <!-- * Outstanding Balance -->
        <div class="rowspan">

            <div class="input-wrapper-modal">
                <span>Outstanding Balance</span>
                <input autocomplete="off" type="number" id="filterOutstandingBal" name="filterOutstandingBal">
            </div>

        </div>

        <!-- * Save Button -->
        <div class="rowspan">
            <button class="button" data-save-filter-member-modal>Save</button>
        </div>

    </div>

    </dialog>
    <div class="reports-container">
    <div class="report-inner-container-1">
        <div class="header-wrapper">
            <button class="button filter-button" style="font-size: 1.5rem" data-open-filter-member-modal>
                <span>Select area to show</span>
            </button>
            <button class="button">Generate Report</button>
        </div>
        <div class="body-wrapper">
            <div class="area-report-container" id="">
                <div class="area-report-wrapper" data-expand-wrapper-button>
                    <div class="area-header">
                        <h4 class="font-size-large">Area 1</h4>
                        <p class="font-size">202305AR1</p>
                    </div>
                    <div class="area-body">
                        <div class="wrapper">
                            <!-- * Overall Standing -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-x-medium">OVER ALL OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">96</p>
                                </div>
                                <div class="row">
                                    <div class="row-wrapper">
                                        <p class="font-size">Penalty</p>
                                        <p class="textBold font-size-medium">1913.76</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Savings</p>
                                        <p class="textBold font-size-medium">11,020.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Balance</p>
                                        <p class="textBold font-size-medium">497,990.67</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Collection</p>
                                        <p class="textBold font-size-medium">234,307.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Release</p>
                                        <p class="textBold font-size-medium">201,500.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Interest</p>
                                        <p class="textBold font-size-medium">36,270.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Advance Payment</p>
                                        <p class="textBold font-size-medium">4,356.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Insurance</p>
                                        <p class="textBold font-size-medium">2,015.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Amount Payable</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Other Deduction</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Outstanding</p>
                                        <p class="textBold font-size-medium">499,011.43</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper wrapper-expandable" data-expandable-wrapper>
                            <!-- * Active Oustanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textGreen textBold font-size-medium">ACTIVE OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">57</p>
                                </div>
                                <div class="row">
                                    <div class="row-wrapper">
                                        <p class="font-size">Penalty</p>
                                        <p class="textBold font-size-medium">1913.76</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Savings</p>
                                        <p class="textBold font-size-medium">11,020.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Balance</p>
                                        <p class="textBold font-size-medium">497,990.67</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Collection</p>
                                        <p class="textBold font-size-medium">234,307.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Release</p>
                                        <p class="textBold font-size-medium">201,500.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Interest</p>
                                        <p class="textBold font-size-medium">36,270.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Advance Payment</p>
                                        <p class="textBold font-size-medium">4,356.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Insurance</p>
                                        <p class="textBold font-size-medium">2,015.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Amount Payable</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Other Deduction</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Outstanding</p>
                                        <p class="textBold font-size-medium">499,011.43</p>
                                    </div>
                                </div>
                            </div>
                            <!-- * New PD Outstanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-medium">NEW PD OUSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">6</p>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="row-wrapper">
                                            <p class="font-size">Penalty</p>
                                            <p class="textBold font-size-medium">1913.76</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Balance</p>
                                            <p class="textBold font-size-medium">497,990.67</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Collection</p>
                                            <p class="textBold font-size-medium">234,307.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Other Deduction</p>
                                            <p class="textBold font-size-medium">2,475.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Release</p>
                                            <p class="textBold font-size-medium">201,500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- * Old PD Outstanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-medium">OLD PD OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">34</p>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="row-wrapper">
                                            <p class="font-size">Penalty</p>
                                            <p class="textBold font-size-medium">1913.76</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Balance</p>
                                            <p class="textBold font-size-medium">497,990.67</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Collection</p>
                                            <p class="textBold font-size-medium">234,307.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Other Deduction</p>
                                            <p class="textBold font-size-medium">2,475.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Release</p>
                                            <p class="textBold font-size-medium">201,500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{ URL::to('/') }}/assets/icons/arrow-down-right.svg" alt="arrow-down-right">
                </div>
            </div>
            <div class="area-report-container" id="">
                <div class="area-report-wrapper" data-expand-wrapper-button>
                    <div class="area-header">
                        <h4 class="font-size-large">Area 2</h4>
                        <p class="font-size">202305AR1</p>
                    </div>
                    <div class="area-body" data-expandable-wrapper>
                        <div class="wrapper">
                            <!-- * Overall Standing -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-medium">OVER ALL OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">96</p>
                                </div>
                                <div class="row">
                                    <div class="row-wrapper">
                                        <p class="font-size">Penalty</p>
                                        <p class="textBold font-size-medium">1913.76</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Savings</p>
                                        <p class="textBold font-size-medium">11,020.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Balance</p>
                                        <p class="textBold font-size-medium">497,990.67</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Collection</p>
                                        <p class="textBold font-size-medium">234,307.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Release</p>
                                        <p class="textBold font-size-medium">201,500.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Interest</p>
                                        <p class="textBold font-size-medium">36,270.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Advance Payment</p>
                                        <p class="textBold font-size-medium">4,356.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Insurance</p>
                                        <p class="textBold font-size-medium">2,015.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Amount Payable</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Other Deduction</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Outstanding</p>
                                        <p class="textBold font-size-medium">499,011.43</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper wrapper-expandable">
                            <!-- * Active Oustanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textGreen textBold font-size-medium">ACTIVE OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">57</p>
                                </div>
                                <div class="row">
                                    <div class="row-wrapper">
                                        <p class="font-size">Penalty</p>
                                        <p class="textBold font-size-medium">1913.76</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Savings</p>
                                        <p class="textBold font-size-medium">11,020.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Balance</p>
                                        <p class="textBold font-size-medium">497,990.67</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Collection</p>
                                        <p class="textBold font-size-medium">234,307.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Release</p>
                                        <p class="textBold font-size-medium">201,500.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Interest</p>
                                        <p class="textBold font-size-medium">36,270.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Advance Payment</p>
                                        <p class="textBold font-size-medium">4,356.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Insurance</p>
                                        <p class="textBold font-size-medium">2,015.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Amount Payable</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Other Deduction</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Outstanding</p>
                                        <p class="textBold font-size-medium">499,011.43</p>
                                    </div>
                                </div>
                            </div>
                            <!-- * New PD Outstanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-medium">NEW PD OUSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">6</p>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="row-wrapper">
                                            <p class="font-size">Penalty</p>
                                            <p class="textBold font-size-medium">1913.76</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Balance</p>
                                            <p class="textBold font-size-medium">497,990.67</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Collection</p>
                                            <p class="textBold font-size-medium">234,307.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Other Deduction</p>
                                            <p class="textBold font-size-medium">2,475.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Release</p>
                                            <p class="textBold font-size-medium">201,500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- * Old PD Outstanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-medium">OLD PD OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">34</p>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="row-wrapper">
                                            <p class="font-size">Penalty</p>
                                            <p class="textBold font-size-medium">1913.76</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Balance</p>
                                            <p class="textBold font-size-medium">497,990.67</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Collection</p>
                                            <p class="textBold font-size-medium">234,307.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Other Deduction</p>
                                            <p class="textBold font-size-medium">2,475.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Release</p>
                                            <p class="textBold font-size-medium">201,500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{ URL::to('/') }}/assets/icons/arrow-down-right.svg" alt="arrow-down-right">
                </div>
            </div>
            <div class="area-report-container" id="">
                <div class="area-report-wrapper" data-expand-wrapper-button>
                    <div class="area-header">
                        <h4 class="font-size-large">Area 3</h4>
                        <p class="font-size">202305AR1</p>
                    </div>
                    <div class="area-body">
                        <div class="wrapper">
                            <!-- * Overall Standing -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-medium">OVER ALL OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">96</p>
                                </div>
                                <div class="row">
                                    <div class="row-wrapper">
                                        <p class="font-size">Penalty</p>
                                        <p class="textBold font-size-medium">1913.76</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Savings</p>
                                        <p class="textBold font-size-medium">11,020.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Balance</p>
                                        <p class="textBold font-size-medium">497,990.67</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Collection</p>
                                        <p class="textBold font-size-medium">234,307.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Release</p>
                                        <p class="textBold font-size-medium">201,500.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Interest</p>
                                        <p class="textBold font-size-medium">36,270.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Advance Payment</p>
                                        <p class="textBold font-size-medium">4,356.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Insurance</p>
                                        <p class="textBold font-size-medium">2,015.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Amount Payable</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Other Deduction</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Outstanding</p>
                                        <p class="textBold font-size-medium">499,011.43</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper wrapper-expandable" data-expandable-wrapper>
                            <!-- * Active Oustanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textGreen textBold font-size-medium">ACTIVE OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">57</p>
                                </div>
                                <div class="row">
                                    <div class="row-wrapper">
                                        <p class="font-size">Penalty</p>
                                        <p class="textBold font-size-medium">1913.76</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Savings</p>
                                        <p class="textBold font-size-medium">11,020.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Balance</p>
                                        <p class="textBold font-size-medium">497,990.67</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Collection</p>
                                        <p class="textBold font-size-medium">234,307.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Release</p>
                                        <p class="textBold font-size-medium">201,500.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Interest</p>
                                        <p class="textBold font-size-medium">36,270.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Advance Payment</p>
                                        <p class="textBold font-size-medium">4,356.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Insurance</p>
                                        <p class="textBold font-size-medium">2,015.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Amount Payable</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Other Deduction</p>
                                        <p class="textBold font-size-medium">2,475.00</p>
                                    </div>
                                    <div class="row-wrapper">
                                        <p class="font-size">Loan Outstanding</p>
                                        <p class="textBold font-size-medium">499,011.43</p>
                                    </div>
                                </div>
                            </div>
                            <!-- * New PD Outstanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-medium">NEW PD OUSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">6</p>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="row-wrapper">
                                            <p class="font-size">Penalty</p>
                                            <p class="textBold font-size-medium">1913.76</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Balance</p>
                                            <p class="textBold font-size-medium">497,990.67</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Collection</p>
                                            <p class="textBold font-size-medium">234,307.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Other Deduction</p>
                                            <p class="textBold font-size-medium">2,475.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Release</p>
                                            <p class="textBold font-size-medium">201,500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- * Old PD Outstanding -->
                            <div class="inner-wrapper">
                                <div class="row">
                                    <p class="textPrimary textBold font-size-medium">OLD PD OUTSTANDING</p>
                                    <p class="textGreen font-size">Active Members</p>
                                    <p class="textBold font-size-medium">34</p>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="row-wrapper">
                                            <p class="font-size">Penalty</p>
                                            <p class="textBold font-size-medium">1913.76</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Balance</p>
                                            <p class="textBold font-size-medium">497,990.67</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Collection</p>
                                            <p class="textBold font-size-medium">234,307.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Other Deduction</p>
                                            <p class="textBold font-size-medium">2,475.00</p>
                                        </div>
                                        <div class="row-wrapper">
                                            <p class="font-size">Loan Release</p>
                                            <p class="textBold font-size-medium">201,500.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{ URL::to('/') }}/assets/icons/arrow-down-right.svg" alt="arrow-down-right">
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
<script>
    const reportAreaExpandButton = document.querySelectorAll('[data-expand-wrapper-button]')

    reportAreaExpandButton.forEach(button => {
        const wrapperExpandable = button.children[1].children[1]

        button.addEventListener('click', (e) => {
            // * Check if the click target is either the parent div or its children
            if (e.target === button || button.contains(e.target)) {
                wrapperExpandable.classList.toggle('show')
            }
        })

    })

    const filterMemberModal = document.querySelector('[data-filter-member-modal]')

    if (filterMemberModal) {
        
        const openFilterMemberModal = document.querySelector('[data-open-filter-member-modal]')
        const closeFilterMemberModal = document.querySelector('[data-close-filter-member-modal]')
        const saveFilterMemberModal = document.querySelector('[data-save-filter-member-modal]')
        
        openFilterMemberModal.addEventListener('click', () => {
            filterMemberModal.showModal()
        })
        
        closeFilterMemberModal.addEventListener('click', () => {
            filterMemberModal.setAttribute("closing", "");
            filterMemberModal.addEventListener("animationend", () => {
                filterMemberModal.removeAttribute("closing");
                filterMemberModal.close();
            }, { once: true });
        
        })
        
        saveFilterMemberModal.addEventListener('click', () => {
            filterMemberModal.setAttribute("closing", "");
            filterMemberModal.addEventListener("animationend", () => {
                filterMemberModal.removeAttribute("closing");
                filterMemberModal.close();
            }, { once: true });
        
        })


        // If the dropdown filter is in the DOM
        const selected = document.querySelector('[data-filter-type-loan-select]');

        if (selected) {
            
            const optionsContainer = document.querySelector('[data-filter-type-opt-con');
            const optionsList = document.querySelectorAll('[data-filter-type-loan-opt]');
        
            selected.addEventListener("click", () => {
                optionsContainer.classList.toggle("active");
            });
        
            optionsList.forEach(option => {
                option.addEventListener("click", () => {
                    selected.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer.classList.remove("active");
                });
            });

        }


    }
</script>