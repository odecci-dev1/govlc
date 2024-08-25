<div>
    
    <div>    
        <div class="reports-container">
            <div class="report-inner-container-2">
                <div class="header-wrapper">
                    <div class="inner-wrapper date-picker">
                        <h2>Loan Calculator</h2>                                      
                    </div>
                    <!-- * Print and Export Buttons -->

                </div>
       
                    <!-- * Loan Calculator -->
                    <div style="overflow-x: auto; margin-top: 2rem; padding: 2.4rem 2rem; border-radius: 1.5rem; box-shadow: 1px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                        <!-- * Rowspan 2: Applied Loan Amount, Terms of Payment, Purpose, and Approve for Releasing Button -->
                        <div style="display: flex; gap: 2rem;">

                            <!-- * Applied Loan Amount -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Principal Loan Amount</span>
                                <input autocomplete="off" type="text" wire:model="principalLoan" id="principalLoan" name="principalLoan" class="inpt-editable">
                                @error('principalLoan') <span class="text-required">{{ $message }}</span> @enderror
                            </div>

                            <!-- * Terms of Payment -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Type of Loan</span>
                                <select  wire:model="loantype"  class="select-option">
                                    @if($loantypeList)
                                    <option value="">- - select - -</option>     
                                        @foreach($loantypeList as $loantypeList)
                                            <option value="{{ $loantypeList['loanTypeID'] }}">{{ $loantypeList['loanTypeName'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('loantype') <span class="text-required">{{ $message }}</span> @enderror
                            </div>

                            <!-- * Purpose -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Terms of Payment</span>
                                <select  wire:model="TopId" class="select-option">                                                              
                                    <option value="">- - select - -</option>     
                                    @if(isset($termsOfPaymentList))
                                        @foreach($termsOfPaymentList as $topList)
                                            <option value="{{ $topList['Id'] }}">{{ $topList['NameOfTerms'] }}</option>
                                        @endforeach
                                    @endif                      
                                </select>    
                                @error('TopId') <span class="text-required">{{ $message }}</span> @enderror
                            </div>

                            <!-- * Approve for Releasing Button -->
                            <div class="input-wrapper" style="flex: 1; justify-content: flex-end;">
                                <span>Use Savings</span>
                                <input autocomplete="off" type="text" id="usedSavings" name="usedSavings" class="inpt-editable">
                            </div>

                        </div>

                        <!-- * Rowspan 3: Savings, Notarial Fee, Advance Payment, and Change Loan Payment Button -->
                        <div style="display: flex; gap: 2rem; margin: 2rem 0;">

                            <!-- * Savings -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Holiday Payment</span>
                                <input autocomplete="off" type="text" id="holidayPay" name="holidayPay" wire:model='holidayPay'>
                            </div>

                            <!-- * Notarial Fee -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Notarial Fee</span>
                                <input autocomplete="off" type="text" id="notarialFee" name="notarialFee" wire:model='notarialFee'>
                            </div>

                            <!-- * Advance Payment -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Loan Insurance</span>
                                <input autocomplete="off" type="text" id="loanInsurance" name="loanInsurance" wire:model='loanInsurance'>
                            </div>

                            <!-- * Change Loan Payment -->
                            <div class="input-wrapper" style="flex: 1; justify-content: flex-end;">
                                <span>Life Insurance</span>
                                <input autocomplete="off" type="text" id="lifeInsurance" name="lifeInsurance" wire:model='lifeInsurance'>
                            </div>

                        </div>
                        <div style="display: flex; gap: 2rem; margin: 2rem 0;">

                            <!-- * Savings -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Loan Amount</span>
                                <input autocomplete="off" type="text" id="loanAmount" name="loanAmount" wire:model='loanAmount'>
                            </div>

                            <!-- * Notarial Fee -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Interest Rate</span>
                                <input autocomplete="off" type="text" id="interestRate" name="interestRate" wire:model='interestRate'>
                            </div>

                            <!-- * Advance Payment -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Interest Amount</span>
                                <input autocomplete="off" type="text" id="intrestAmount" name="intrestAmount" wire:model='interestAmount'>
                            </div>

                            <!-- * Change Loan Payment -->
                            <div class="input-wrapper" style="flex: 1; justify-content: flex-end;">
                                <button type="button" class="button" style="margin-bottom: 0.6rem;" wire:click="calculateLoanDetails">Calculate</button>
                            </div>

                        </div>

                        <!-- * Rowspan 4: Interest, Releasing Amount, Daily Amount Due, and Decline Button -->
                        <div style="display: flex; gap: 2rem;">

                            <!-- * Interest -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Advnace Payment</span>
                                <input autocomplete="off" type="text" id="advancePayment" name="advancePayment" wire:model='advancePayment'>
                            </div>

                            <!-- * Releasing Amount -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Releasing Amount</span>
                                <input autocomplete="off" type="text" id="releasingAmount" name="releasingAmount" wire:model='releasingAmount'>
                            </div>

                            <!-- * Daily Amount Due -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Daily Amount Due</span>
                                <input autocomplete="off" type="text" id="dailyAmountDue" name="dailyAmountDue" wire:model='dailyAmountDue'>
                            </div>

                            <!-- * Decline Button -->
                            <div class="input-wrapper" style="flex: 1; justify-content: flex-end;">
                                <button type="button" class="declineButton" style="margin-bottom: 0.5rem; padding: 1rem 4rem; font-size: 1.1rem" wire:click='clear'>Clear All</button>
                            </div>

                        </div>
                        
                        <div style="display: flex; gap: 2rem;margin: 2rem 0;">

                            <!-- * Interest -->
                            <div class="input-wrapper" style="flex: 1">
                                <span>Outstanding Balance</span>
                                <input autocomplete="off" type="text" id="outstandingBalance" name="outstandingBalance" wire:model='outstandingBalance'>
                            </div>

                    


                        </div>


                    </div>
                    
      
           
            </div>
        </div>
    
    </div>
</div>
