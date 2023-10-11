<div>
    @if(session('mmessage'))
            <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
    <!-- * New Loan Types Form -->
    <form action="" class="na-form-con" autocomplete="off">

    <!-- * Container Wrapper: New Loan Types and Terms of Payment -->
    <div class="na-container-wrapper-2">

        <!-- * Container 1: New Loan Types and Buttons -->
        <div class="nl-container-1">

            <!-- * Container Wrapper -->
            <div class="container-wrapper">

                <!-- * Big Container -->
                <div class="big-con">
                    <!-- * Form Header -->
                    <!-- * Rowspan 1: Rowspan Header: Header and Buttons -->
                    <div class="rowspan">
                        <!-- * Header Wrapper -->
                        <div class="header-wrapper">
                            <h2>New Loan Types</h2>
                        </div>
                        <!-- * Buttons -->
                        <div class="btn-wrapper">                        
                            <!-- * Save -->
                            <button type="button" wire:click="save" class="button" data-save>{{ $loantypeID =='' ? 'Save' : 'Update' }}</button>
                        </div>
                    </div>

                    <!-- * Rowspan 2: Last Update and View History -->
                    <div class="rowspan">

                        <!-- * First Name -->
                        <p>Last Updated:
                            <span>
                                <span id="nltDate">05/26/2022</span> ,
                                <span id="nltDay">Thursday</span> at
                                <span id="nltTime">9:45 am</span> by
                                <span id="nltUser">Admin</span>
                            </span>
                        </p>

                        <!-- * View History -->
                        <div class="btn-wrapper">
                            <button type="button">View History</button>
                        </div>

                    </div>

                    <!-- * Rowspan 3: Loan Type Name -->
                    <div class="rowspan">
                        <!-- * Loan Type Name -->
                        <div class="input-wrapper">
                            <span>Loan Type Name</span>
                            <input autocomplete="off" type="text" wire:model.lazy="loantype.loanTypeName">
                            @error('loantype.loanTypeName') <span class="text-required">{{ $message }}</span>@enderror
                        </div>

                    </div>

                    <!-- * Rowspan 4: Notarial Fee -->
                    <div style="display: flex;">
                        <div style="width: 25%; padding-right: 40px;">                            
                                <div style="width:  100%; padding-bottom: 5px;">
                                    <span style="font-size: 1.5rem">Savings</span>
                                </div>  
                                <div style="width:  100%; display: flex;">                           
                                    <div  style="width:  100%;">
                                        <div class="input-wrapper">                                                                   
                                            <input autocomplete="off" type="number" wire:model.lazy="loantype.savings">
                                            @error('loantype.savings') <span class="text-required">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                   
                                </div>
                        </div>
                        <div style="width: 30%; padding-right: 10px; display: inline;">
                                <div style="width:  100%; padding-bottom: 5px;">
                                    <span style="font-size: 1.5rem;">Loan Amount</span>
                                </div>  
                                <div style="width:  100%; display: flex;">                           
                                    <div  style="width:  50%; padding-right: 5px;">
                                        <div class="input-wrapper">
                                            <input autocomplete="off" type="number" wire:model.lazy="loantype.loanAmount_Min" placeholder="Min:">    
                                            @error('loantype.loanAmount_Min') <span class="text-required">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div  style="width:  50%; padding-left: 5px;">
                                        <div class="input-wrapper">
                                            <input autocomplete="off" type="number" wire:model.lazy="loantype.loanAmount_Max" placeholder="Max:">
                                            @error('loantype.loanAmount_Max') <span class="text-required">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                        </div>                      
                    </div>
            </div>

        </div> 
    </div>


    <!-- terms -->
    <div class="na-container-wrapper-2">
        <div class="nl-container-1">
            <div class="container-wrapper">
                <div class="rowspan" style="margin-bottom: 30px;">
                    <!-- * Header Wrapper -->
                    <div class="header-wrapper">
                        <h1>Terms Of Payment</h1>
                    </div>                       
                </div>
                <div style="display: flex; margin-bottom: 30px;">
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Name</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <input autocomplete="off" type="text" wire:model.lazy="inpterms.nameOfTerms">
                                    @error('inpterms.nameOfTerms') <span class="text-required">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>                                         
                </div>
                <div style="display: flex; margin-bottom: 30px;">
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Type Of Collection</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-inner-select-wrapper">
                                    <div class="select-box">
                                        <div class="options-container" data-option-con1>
                                            @if($collectionType)
                                                @foreach($collectionType as $colltypekey => $mcollType)
                                                <div class="option" data-option-item1>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.collectionTypeId" class="radio" name="collectionTypeId" id="collectionTypeId{{ $colltypekey }}" value="{{ $colltypekey }}"/>
                                                    <label for="collectionTypeId{{ $colltypekey }}">
                                                            <h4>{{ $mcollType['typeOfCollection'] }}</h4>
                                                    </label>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="selected" style="font-weight: 700; font-size: 1.3rem;" data-option-select1>
                                            {{ isset($inpterms['collectionTypeId']) ? $collectionType[$inpterms['collectionTypeId']]['typeOfCollection'] : '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>                                                             
                        </div>
                        @error('inpterms.collectionTypeId') <span class="text-required" style="font-weight: 700;">{{ $message }}</span>@enderror  
                    </div>     
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Terms</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <input autocomplete="off" type="number" wire:model.lazy="inpterms.terms">
                                    @error('inpterms.terms') <span class="text-required">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>                                              
                </div>
                <div style="display: flex; margin-bottom: 30px;">
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Interest</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <input autocomplete="off" type="number" wire:model.lazy="inpterms.interestRate">
                                    @error('inpterms.interestRate') <span class="text-required">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>         
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Interest Type</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-inner-select-wrapper">
                                    <div class="select-box {{ isset($inpterms['collectionTypeId']) ? ($inpterms['collectionTypeId'] == 3 ? 'select-disabled' : '') : ''  }}">
                                        <div class="options-container" data-option-con2>
                                            <div class="option" data-option-item2>
                                                <input type="radio" class="radio" wire:model.lazy="inpterms.interestType" class="radio" name="interestType" id="interestType1" value="Compound"/>
                                                <label for="interestType1">
                                                        <h4>Compound</h4>
                                                </label>
                                            </div>
                                            <div class="option" data-option-item2>
                                                <input type="radio" class="radio" wire:model.lazy="inpterms.interestType" class="radio" name="interestType" id="interestType2" value="Custom"/>
                                                <label for="interestType2">
                                                        <h4>Custom</h4>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="selected" style="font-weight: 700; font-size: 1.3rem;" data-option-select2>
                                            {{ isset($inpterms['interestType']) ? $inpterms['interestType'] : '' }}
                                        </div>
                                    </div>
                                    @error('inpterms.interestType') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>     
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Applied Interest</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-inner-select-wrapper">
                                    <div class="select-box {{ isset($inpterms['collectionTypeId']) ? ($inpterms['collectionTypeId'] == 3 ? 'select-disabled' : '') : ''  }}">
                                        <div class="options-container" data-option-con9>
                                            <div class="option" data-option-item9>
                                                <input type="radio" class="radio" wire:model.lazy="inpterms.interestApplied" class="radio" name="interestApplied" id="interestApplied1" value="Monthly"/>
                                                <label for="interestApplied1">
                                                        <h4>Monthly</h4>
                                                </label>
                                            </div>
                                            <div class="option" data-option-item9>
                                                <input type="radio" class="radio" wire:model.lazy="inpterms.interestApplied" class="radio" name="interestApplied" id="interestApplied2" value="Yearly"/>
                                                <label for="interestApplied2">
                                                        <h4>Yearly</h4>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="selected" style="font-weight: 700; font-size: 1.3rem;" data-option-select9>
                                            {{ isset($inpterms['interestApplied']) ? $inpterms['interestApplied'] : '' }}
                                        </div>
                                    </div>
                                    @error('inpterms.interestApplied') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>                                                                 
                </div>
                <div style="display: flex; margin-bottom: 30px;">
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Formula</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-inner-select-wrapper">
                                    <div class="select-box">
                                        <div class="options-container" data-option-con3>
                                            @if($formulaList)
                                                @foreach($formulaList as $formulaListKey => $mformulaList)
                                                <div class="option" data-option-item3>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.formula" class="radio" name="formula" id="formula{{ $formulaListKey }}" value="{{ $formulaListKey }}"/>
                                                    <label for="formula{{ $formulaListKey }}">
                                                            <h4>{{ $mformulaList['formula'] }}</h4>
                                                    </label>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="selected" style="font-weight: 700; font-size: 1.3rem;" data-option-select3>
                                            {{ isset($inpterms['formula']) ? $formulaList[$inpterms['formula']]['formula'] : '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>                                   
                        </div>
                        @error('inpterms.formula') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                    </div>     
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem; color: red;">No Advance Payment ?</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <!-- radio -->
                                    <div class="box-wrap" style="gap: 1rem;">
                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.noAdvancePayment" autocomplete="off" type="radio" value="1" name="noAdvancePayment" id="noAdvancePayment1">
                                            <span>Yes</span>                                            
                                        </div>

                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.noAdvancePayment" autocomplete="off" type="radio" value="2" name="noAdvancePayment" id="noAdvancePayment2">
                                            <span>No</span>                                            
                                        </div>
                                    </div>
                                    <!-- radio -->                                   
                                    @error('inpterms.noAdvancePayment') <span class="text-required">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>   
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem; color: red;">Use old client formula for advance payment ?</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <!-- radio -->
                                    <div class="box-wrap" style="gap: 1rem;">
                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.oldFormula" autocomplete="off" type="radio" value="1" name="oldFormula" id="oldFormula1">
                                            <span>Yes</span>                                            
                                        </div>

                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.oldFormula" autocomplete="off" type="radio" value="2" name="oldFormula" id="oldFormula2">
                                            <span>No</span>                                            
                                        </div>
                                    </div>
                                    <!-- radio -->                                   
                                    @error('inpterms.oldFormula') <span class="text-required">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>                                                               
                </div>
                <!-- deductions -->
                <div class="rowspan" style="margin-bottom: 30px;">
                    <!-- * Header Wrapper -->
                    <div class="header-wrapper">
                        <h1>Deductions</h1>
                    </div>                       
                </div>
                <div style="display: flex; margin-bottom: 30px;">
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Select Origin For Notarial Fee</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-inner-select-wrapper">
                                    <div class="select-box">
                                        <div class="options-container" data-option-con4>
                                            <div class="option" data-option-item4>
                                                <input type="radio" class="radio" wire:model.lazy="inpterms.notarialFeeOrigin" class="radio" name="notarialFeeOrigin" id="notarialFeeOrigin1" value="1"/>
                                                <label for="notarialFeeOrigin1">
                                                        <h4>Loan Amount</h4>
                                                </label>
                                            </div>
                                            <div class="option" data-option-item4>
                                                <input type="radio" class="radio" wire:model.lazy="inpterms.notarialFeeOrigin" class="radio" name="notarialFeeOrigin" id="notarialFeeOrigin2" value="2"/>
                                                <label for="notarialFeeOrigin2">
                                                        <h4>Principal Amount</h4>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="selected" style="font-weight: 700; font-size: 1.3rem;" data-option-select4>
                                            {{ isset($inpterms['notarialFeeOrigin']) ? ($inpterms['notarialFeeOrigin'] == 1 ? 'Loan Amount' : 'Principal Amount') : '' }}
                                        </div>
                                        @error('inpterms.notarialFeeOrigin') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>                                   
                        </div>
                    </div>     
                    <div style="width: 60%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px; display: flex;">
                            <div style="width: 50%; padding-top: 10px;">
                                <span style="font-size: 1.5rem; color: red;">If less than 10,000</span>
                            </div>
                            <div style="width: 50%; display: flex;">
                                <!-- dito -->
                                <div  style="width:  50%;">
                                    <div class="input-inner-select-wrapper">
                                        <div class="select-box">
                                            <div class="options-container" data-option-con5>
                                                <div class="option" data-option-item5>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.lessThanAmountTYpe" class="radio" name="lessThanAmountTYpe" id="lessThanAmountTYpe1" value="1"/>
                                                    <label for="lessThanAmountTYpe1">
                                                            <h4>Percent</h4>
                                                    </label>
                                                </div>
                                                <div class="option" data-option-item5>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.lessThanAmountTYpe" class="radio" name="lessThanAmountTYpe" id="lessThanAmountTYpe2" value="2"/>
                                                    <label for="lessThanAmountTYpe2">
                                                            <h4>Fixed</h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="selected" style="border-top-right-radius: 0;border-bottom-right-radius: 0; font-weight: 700; font-size: 1.3rem;" data-option-select5>
                                                {{ isset($inpterms['lessThanAmountTYpe']) ? ($inpterms['lessThanAmountTYpe'] == 1 ? 'Percent' : 'Fixed') : '' }}
                                            </div>
                                        </div>
                                        @error('inpterms.lessThanAmountTYpe') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                                    </div>
                                </div>  
                                <div style="width: 50%;">
                                    <div class="input-wrapper">                                                                   
                                        <input autocomplete="off" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" type="number" wire:model.lazy="inpterms.lessThanNotarialAmount" placeholder="Amount">
                                        @error('inpterms.lessThanNotarialAmount') <span class="text-required">{{ $message }}</span>@enderror
                                    </div>
                                </div>            
                                <!-- dito -->
                            </div>                            
                        </div>  
                        <div style="width:  100%; padding-bottom: 5px; display: flex;">
                            <div style="width: 50%; padding-top: 10px;">
                                <span style="font-size: 1.5rem; color: red;">If greater than or equal to 10,000</span>
                            </div>
                            <div style="width: 50%; display: flex;">
                                <!-- dito -->
                                <div  style="width:  50%;">
                                    <div class="input-inner-select-wrapper">
                                        <div class="select-box">
                                            <div class="options-container" data-option-con6>
                                                <div class="option" data-option-item6>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.greaterThanEqualAmountType" class="radio" name="greaterThanEqualAmountType" id="greaterThanEqualAmountType1" value="1"/>
                                                    <label for="greaterThanEqualAmountType1">
                                                            <h4>Percent</h4>
                                                    </label>
                                                </div>
                                                <div class="option" data-option-item6>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.greaterThanEqualAmountType" class="radio" name="greaterThanEqualAmountType" id="greaterThanEqualAmountType2" value="2"/>
                                                    <label for="greaterThanEqualAmountType2">
                                                            <h4>Fixed</h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="selected" style="border-top-right-radius: 0;border-bottom-right-radius: 0; font-weight: 700; font-size: 1.3rem;" data-option-select6>
                                                {{ isset($inpterms['greaterThanEqualAmountType']) ? ($inpterms['greaterThanEqualAmountType'] == 1 ? 'Percent' : 'Fixed') : '' }}
                                            </div>
                                        </div>
                                        @error('inpterms.greaterThanEqualAmountType') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                                    </div>
                                </div>  
                                <div style="width: 50%;">
                                    <div class="input-wrapper">                                                                   
                                        <input autocomplete="off" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" type="number" wire:model.lazy="inpterms.greaterThanEqualNotarialAmount" placeholder="Amount">
                                        @error('inpterms.greaterThanEqualNotarialAmount') <span class="text-required">{{ $message }}</span>@enderror
                                    </div>
                                </div>            
                                <!-- dito -->
                            </div>                            
                        </div>  
                    </div>   
                                                                               
                </div>
                <!-- loan Insurance -->
                <div style="display: flex; margin-bottom: 30px;">
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Loan Insurance</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                                <div  style="width:  50%;">
                                    <div class="input-inner-select-wrapper">
                                        <div class="select-box">
                                            <div class="options-container" data-option-con7>
                                                <div class="option" data-option-item7>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.loanInsuranceAmountType" class="radio" name="loanInsuranceAmountType" id="loanInsuranceAmountType1" value="1"/>
                                                    <label for="loanInsuranceAmountType1">
                                                            <h4>Percent</h4>
                                                    </label>
                                                </div>
                                                <div class="option" data-option-item7>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.loanInsuranceAmountType" class="radio" name="loanInsuranceAmountType" id="loanInsuranceAmountType2" value="2"/>
                                                    <label for="loanInsuranceAmountType2">
                                                            <h4>Fixed</h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="selected" style="border-top-right-radius: 0;border-bottom-right-radius: 0; font-weight: bold; font-size: 1.3rem;" data-option-select7>
                                                {{ isset($inpterms['loanInsuranceAmountType']) ? ($inpterms['loanInsuranceAmountType'] == 1 ? 'Percent' : 'Fixed') : '' }}
                                            </div>
                                        </div>
                                        @error('inpterms.loanInsuranceAmountType') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                                    </div>
                                </div>  
                                <div style="width: 50%;">
                                    <div class="input-wrapper">                                                                   
                                        <input autocomplete="off" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" type="number" wire:model.lazy="inpterms.loanInsuranceAmount" placeholder="Amount">
                                        @error('inpterms.loanInsuranceAmount') <span class="text-required">{{ $message }}</span>@enderror
                                    </div>
                                </div>                       
                        </div>
                    </div>     
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Life Insurance</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                                <div  style="width:  50%;">
                                    <div class="input-inner-select-wrapper">
                                        <div class="select-box">
                                            <div class="options-container" data-option-con8>
                                                <div class="option" data-option-item8>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.lifeInsuranceAmountType" class="radio" name="lifeInsuranceAmountType" id="lifeInsuranceAmountType1" value="1"/>
                                                    <label for="lifeInsuranceAmountType1">
                                                            <h4>Percent</h4>
                                                    </label>
                                                </div>
                                                <div class="option" data-option-item8>
                                                    <input type="radio" class="radio" wire:model.lazy="inpterms.lifeInsuranceAmountType" class="radio" name="lifeInsuranceAmountType" id="lifeInsuranceAmountType2" value="2"/>
                                                    <label for="lifeInsuranceAmountType2">
                                                            <h4>Fixed</h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="selected" style="border-top-right-radius: 0;border-bottom-right-radius: 0; font-weight: 700; font-size: 1.3rem;" data-option-select8>
                                                {{ isset($inpterms['lifeInsuranceAmountType']) ? ($inpterms['lifeInsuranceAmountType'] == 1 ? 'Percent' : 'Fixed') : '' }}
                                            </div>
                                        </div>
                                        @error('inpterms.lifeInsuranceAmountType') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                                    </div>
                                </div>  
                                <div style="width: 50%;">
                                    <div class="input-wrapper">                                                                   
                                        <input autocomplete="off" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" type="number" wire:model.lazy="inpterms.lifeInsuranceAmount" placeholder="Amount">
                                        @error('inpterms.lifeInsuranceAmount') <span class="text-required">{{ $message }}</span>@enderror
                                    </div>
                                </div>                       
                        </div>
                    </div>   
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem; color: red;">Deduct Interest ?</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <!-- radio -->
                                    <div class="box-wrap" style="gap: 1rem;">
                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.deductInterest" autocomplete="off" type="radio" value="1" name="deductInterest" id="deductInterest1">
                                            <span>Yes</span>                                            
                                        </div>

                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.deductInterest" autocomplete="off" type="radio" value="2" name="deductInterest" id="deductInterest2">
                                            <span>No</span>                                            
                                        </div>
                                    </div>
                                    <!-- radio -->                                   
                                    @error('inpterms.deductInterest') <span class="text-required">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>                                                               
                </div>
                <!-- loan insurance -->
                <!-- table -->
                <!-- * Rowspan 5: Add to list Button -->
                <div class="rowspan" style="margin-bottom: 20px;">

                    <div class="btn-wrapper ">
                        <button type="button" class="button" wire:click="addTerms">Add to list</button>
                    </div>

                </div>

                    <!-- * Rowspan 6: Terms Of Payment Table -->
                    <div class="rowspan">


                    <!-- * Container 2: Terms Of Payment -->
                    <div class="m-con-2" style="padding: 0;">

                        <!-- * Table Container -->
                        <div class="table-container">

                            <!-- * Terms Of Payment Table -->
                            <table id="termsOfPaymentTable">

                                <!-- * Table Header -->
                                <tr>

                                    <!-- * Checkbox ALl-->
                                    <th>
                                        <input type="checkbox" class="checkbox" data-select-all-checkbox>
                                    </th>

                                    <!-- * Name -->
                                    <th>
                                        <span class="th-name">Name</span>
                                    </th>

                                    <!-- * Interest Rate -->
                                    <th>
                                        <span class="th-name">Interest Rate</span>
                                    </th>

                                    <!-- * Days -->
                                    <th>
                                        <span class="th-name">Terms</span>
                                    </th>

                                    <!-- * Advance payment formula -->
                                    <th>
                                        <span class="th-name">Advance payment formula</span>
                                    </th>

                                    <!-- * Action -->
                                    <th>
                                        <span class="th-name">Action</span>
                                    </th>
                                </tr>


                                <!-- * Terms Of Payment Data -->
                            
                                @if($terms)
                                @foreach($terms as $key => $value)
                                <tr>

                                    <!-- * Checkbox Opt -->
                                    <td>
                                        <input type="checkbox" class="checkbox" data-select-checkbox>
                                    </td>

                                    <!-- * Name of terms -->
                                    <td>
                                        {{ $value['nameOfTerms'] }}
                                    </td>

                                    <!-- * Interest Rate -->
                                    <td>
                                        {{ $value['interestRate'] }} %
                                    </td>

                                    <!-- * Days -->
                                    <td>
                                        {{ $value['terms'] }}
                                    </td>

                                    <!-- * Advance payment formula -->
                                    <td>
                                        {{ $formulaList[$value['formula']]['formula'] }}
                                    </td>

                                    <!-- * Action -->
                                    <td class="td-btns">
                                        <div class="td-btn-wrapper">
                                            <!-- <button class="a-btn-view">View</button> -->
                                            <button class="a-btn-trash-2">Remove</button>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                                @endif
                                @error('terms') 
                                    <tr>
                                        <td colspan="6" style="text-align: center; padding: 20px;"><span class="text-required">{{ $message }}</span></td>
                                    </tr>
                                @enderror
                            

                            </table>

                        </div>

                    </div>


                    </div>
                <!-- table -->
                <!-- deductions -->
            </div>
        </div>
    </div>
    <!-- terms -->

    </form>
    <script>
            
        // ** Select Dropdown 1 (Percentage & Fixed Toggle)
        let selectedOpt1 = document.querySelector('[data-option-select1]');

        const optionsContainer1 = document.querySelector('[data-option-con1]');
        const optionsList1 = document.querySelectorAll('[data-option-item1]');


        if (selectedOpt1) {

            selectedOpt1.addEventListener("click", () => {
                optionsContainer1.classList.toggle("active");
            });

            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select1], [data-option-con1]')) {
                    optionsContainer1.classList.remove("active");
                }
            });

            optionsList1.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt1.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer1.classList.remove("active");
                });
            });

        }

                
        // ** Select Dropdown 2 (Percentage & Fixed Toggle)
        const selectedOpt2 = document.querySelector('[data-option-select2]');


        const optionsContainer2 = document.querySelector('[data-option-con2]');
        const optionsList2 = document.querySelectorAll('[data-option-item2]');

        if (selectedOpt2) {

            selectedOpt2.addEventListener("click", () => {
                optionsContainer2.classList.toggle("active");
            });

            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select2], [data-option-con2]')) {
                    optionsContainer2.classList.remove("active");
                }
            });

            optionsList2.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt2.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer2.classList.remove("active");
                });
            });

        }

        // ** Select Dropdown 3 (Percentage & Fixed Toggle)
        const selectedOpt3 = document.querySelector('[data-option-select3]');


        const optionsContainer3 = document.querySelector('[data-option-con3]');
        const optionsList3 = document.querySelectorAll('[data-option-item3]');

        if (selectedOpt3) {

            selectedOpt3.addEventListener("click", () => {
                optionsContainer3.classList.toggle("active");
            });

            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select3], [data-option-con3]')) {
                    optionsContainer3.classList.remove("active");
                }
            });

            optionsList3.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt3.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer3.classList.remove("active");
                });
            });

        }

        // ** Select Dropdown 4 (Percentage & Fixed Toggle)
        const selectedOpt4 = document.querySelector('[data-option-select4]');


        const optionsContainer4 = document.querySelector('[data-option-con4]');
        const optionsList4 = document.querySelectorAll('[data-option-item4]');

        if (selectedOpt4) {

            selectedOpt4.addEventListener("click", () => {
                optionsContainer4.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select4], [data-option-con4]')) {
                    optionsContainer4.classList.remove("active");
                }
            });

            optionsList4.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt4.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer4.classList.remove("active");
                });
            });

        }

                
        // ** Select Dropdown 5 (Percentage & Fixed Toggle)
        const selectedOpt5 = document.querySelector('[data-option-select5]');


        const optionsContainer5 = document.querySelector('[data-option-con5]');
        const optionsList5 = document.querySelectorAll('[data-option-item5]');

        if (selectedOpt5) {

            selectedOpt5.addEventListener("click", () => {
                optionsContainer5.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select5], [data-option-con5]')) {
                    optionsContainer5.classList.remove("active");
                }
            });

            optionsList5.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt5.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer5.classList.remove("active");
                });
            });

        }


        // ** Select Dropdown 6 (Percentage & Fixed Toggle)
        const selectedOpt6 = document.querySelector('[data-option-select6]');


        const optionsContainer6 = document.querySelector('[data-option-con6]');
        const optionsList6 = document.querySelectorAll('[data-option-item6]');

        if (selectedOpt6) {

            selectedOpt6.addEventListener("click", () => {
                optionsContainer6.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select6], [data-option-con6]')) {
                    optionsContainer6.classList.remove("active");
                }
            });


        }

        // ** Select Dropdown 7 (Percentage & Fixed Toggle)
        const selectedOpt7 = document.querySelector('[data-option-select7]');


        const optionsContainer7 = document.querySelector('[data-option-con7]');
        const optionsList7 = document.querySelectorAll('[data-option-item7]');

        if (selectedOpt7) {

            selectedOpt7.addEventListener("click", () => {
                optionsContainer7.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select7], [data-option-con7]')) {
                    optionsContainer7.classList.remove("active");
                }
            });


        }

        // ** Select Dropdown 8 (Percentage & Fixed Toggle)
        const selectedOpt8 = document.querySelector('[data-option-select8]');


        const optionsContainer8 = document.querySelector('[data-option-con8]');
        const optionsList8 = document.querySelectorAll('[data-option-item8]');

        if (selectedOpt8) {

            selectedOpt8.addEventListener("click", () => {
                optionsContainer8.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select8], [data-option-con8]')) {
                    optionsContainer8.classList.remove("active");
                }
            });


        }

        // ** Select Dropdown 9 (Percentage & Fixed Toggle)
        const selectedOpt9 = document.querySelector('[data-option-select9]');


        const optionsContainer9 = document.querySelector('[data-option-con9]');
        const optionsList9 = document.querySelectorAll('[data-option-item9]');

        if (selectedOpt9) {

            selectedOpt9.addEventListener("click", () => {
                optionsContainer9.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select9], [data-option-con9]')) {
                    optionsContainer9.classList.remove("active");
                }
            });


        }

    </script>
</div>
