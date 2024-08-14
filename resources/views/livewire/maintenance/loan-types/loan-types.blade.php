<div>
    @if($showDialog == 1)
        <x-dialog :message="'Are you sure you want to trash this data '" :xmid="$mid" :confirmaction="'archive'" :header="'Trash'"></x-dialog>   
    @endif
    @if(session('mmessage'))
        <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
    <div wire:loading  wire:loading.delay wire:target="save" class="full-screen-div-loading">
        <div class="center-loading-container">
            <div>
                <div class="lds-dual-ring"></div>
            </div>
            <div class="loading-text">
                <span>Please wait . . .</span>
            </div>
        </div>        
    </div>
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
                            @if($usertype != 2)                    
                            <!-- * Save -->
                            <button type="button" wire:click="save" class="button" data-save>{{ $LoanTypeId =='' ? 'Save' : 'Update' }}</button>
                            @if($LoanTypeId !='')
                            <button type="button" {{ $LoanTypeId == 'LT-02' ? 'disabled' : '' }} onclick="showDialog('{{ $LoanTypeId }}')" class="button" data-save>Trash</button>
                            @endif
                            @endif
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
                            <input autocomplete="off" type="text" wire:model.lazy="loantype.LoanTypeName">
                            @error('loantype.LoanTypeName') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                        </div>

                    </div>

                    <!-- * Rowspan 4: Savings / Loan Amount -->
                    <div style="display: flex;">
                        <div style="width: 25%; padding-right: 40px;">                            
                                <div style="width:  100%; padding-bottom: 5px;">
                                    <span style="font-size: 1.5rem">Savings</span>
                                </div>  
                                <div style="width:  100%; display: flex;">                           
                                    <div style="width: 100%;">
                                        <div class="input-wrapper">                                                                   
                                            <input autocomplete="off" type="number" wire:model.lazy="loantype.Savings" step="1" min="0">
                                            @error('loantype.Savings') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                            <input autocomplete="off" type="number" wire:model.lazy="loantype.LoanAmount_Min" placeholder="Min:" step="1" min="0">    
                                            @error('loantype.LoanAmount_Min') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div  style="width:  50%; padding-left: 5px;">
                                        <div class="input-wrapper">
                                            <input autocomplete="off" type="number" wire:model.lazy="loantype.LoanAmount_Max" placeholder="Max:" step="1" min="0">
                                            @error('loantype.LoanAmount_Max') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                            <div style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <input autocomplete="off" type="text" wire:model.lazy="inpterms.NameOfTerms">
                                    @error('inpterms.NameOfTerms') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                        <select wire:model="inpterms.CollectionTypeId" class="select-option">
                                            <option value="">- - select - -</option>                                              
                                            @if($collectionType)
                                                @foreach($collectionType as $id => $type)
                                                    <option value="{{ $id }}">{{ $type }}</option>
                                                @endforeach
                                            @endif                                                                                                        
                                        </select>                                             
                                    </div>
                                </div>
                            </div>                                                             
                        </div>
                        @error('inpterms.CollectionTypeId') <span class="text-required fw-normal">{{ $message }}</span>@enderror  
                    </div>     
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem">Terms</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <input autocomplete="off" type="number" wire:model.lazy="inpterms.Terms">
                                    @error('inpterms.Terms') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                    <input autocomplete="off" type="number" wire:model.lazy="inpterms.InterestRate">
                                    @error('inpterms.InterestRate') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                    <div class="select-box {{ isset($inpterms['CollectionTypeId']) ? ($inpterms['CollectionTypeId'] == 3 ? 'select-disabled' : '') : ''  }}">
                                        <select wire:model="inpterms.InterestType" {{ isset($inpterms['CollectionTypeId']) ? ($inpterms['CollectionTypeId'] == 3 ? 'disabled' : '') : ''  }} class="select-option">
                                            <option value="">- - select - -</option>     
                                            <option value="Compound">Compound</option>                                    
                                            <option value="Custom">Custom</option>                                    
                                        </select>                                          
                                    </div>
                                    @error('inpterms.InterestType') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                    <div class="select-box">
                                        <select  wire:model="inpterms.InterestApplied"  {{ isset($inpterms['InterestType']) ? ($inpterms['InterestType'] == 'Compound' ? 'disabled' : '') : ''  }} {{ isset($inpterms['CollectionTypeId']) ? ($inpterms['CollectionTypeId'] == 3 ? 'disabled' : '') : ''  }} class="select-option">
                                            <option value="">- - select - -</option>     
                                            <option value="Monthly">Monthly</option>                                    
                                            <option value="Yearly">Yearly</option>                                    
                                        </select>                                                        
                                    </div>
                                    @error('inpterms.InterestApplied') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                        <select  wire:model="inpterms.Formula" class="select-option">
                                            <option value="">- - select - -</option>                                                
                                            @if($formulaList)
                                                @foreach($formulaList as $id => $formula)
                                                    <option value="{{ $formula['APFID'] }}">{{ $formula['Formula'] }}</option> 
                                                @endforeach
                                            @endif                                   
                                        </select>    
                                    </div>
                                </div>
                            </div>                                   
                        </div>
                        @error('inpterms.Formula') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                    </div>     
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem; color: #cc0000;" class="fw-bold">Allow Advance Payment ?</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <!-- radio -->
                                    <div class="box-wrap" style="gap: 1rem;">
                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.NoAdvancePayment" autocomplete="off" type="radio" value="1" name="NoAdvancePayment" id="NoAdvancePayment1">
                                            <span>Yes</span>                                            
                                        </div>

                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.NoAdvancePayment" autocomplete="off" type="radio" value="2" name="NoAdvancePayment" id="NoAdvancePayment2">
                                            <span>No</span>                                            
                                        </div>
                                    </div>
                                    <!-- radio -->                                   
                                    @error('inpterms.NoAdvancePayment') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>   
                    <div style="width: 40%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem; color: #cc0000;" class="fw-bold">Use old client formula for advance payment ?</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <!-- radio -->
                                    <div class="box-wrap" style="gap: 1rem;">
                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.OldFormula" autocomplete="off" type="radio" value="1" name="OldFormula" id="OldFormula1">
                                            <span>Yes</span>                                            
                                        </div>

                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.OldFormula" autocomplete="off" type="radio" value="2" name="OldFormula" id="OldFormula2">
                                            <span>No</span>                                            
                                        </div>
                                    </div>
                                    <!-- radio -->                                   
                                    @error('inpterms.OldFormula') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                        <select  wire:model="inpterms.NotarialFeeOrigin" class="select-option">
                                            <option value="">- - select - -</option>     
                                            <option value="1">Loan Amount</option>                                    
                                            <option value="2">Principal Amount</option>                                    
                                        </select>      
                                        @error('inpterms.NotarialFeeOrigin') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>                                   
                        </div>
                    </div>     
                    <div style="width: 60%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px; display: flex;">
                            <div style="width: 50%; padding-top: 10px;">
                                <span style="font-size: 1.5rem; color: #cc0000;" class="fw-bold">If less than 10,000</span>
                            </div>
                            <div style="width: 50%; display: flex;">
                                <!-- dito -->
                                <div  style="width:  50%;">
                                    <div class="input-inner-select-wrapper">
                                        <div class="select-box">                                       
                                            <select  wire:model="inpterms.LessThanAmountType" style="border-top-right-radius: 0;border-bottom-right-radius: 0; font-size: 1.3rem;" class="select-option">
                                                <option value="">- - select - -</option>     
                                                <option value="1">Percent</option>                                    
                                                <option value="2">Fixed</option>                                    
                                            </select>                                   
                                        </div>
                                        @error('inpterms.LessThanAmountType') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                    </div>
                                </div>  
                                <div style="width: 50%;">
                                    <div class="input-wrapper">                                                                   
                                        <input autocomplete="off" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" type="number" wire:model.lazy="inpterms.LessThanNotarialAmount" placeholder="Amount">
                                        @error('inpterms.LessThanNotarialAmount') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                    </div>
                                </div>            
                                <!-- dito -->
                            </div>                            
                        </div>  
                        <div style="width:  100%; padding-bottom: 5px; display: flex;">
                            <div style="width: 50%; padding-top: 10px;">
                                <span style="font-size: 1.5rem; color: #cc0000;" class="fw-bold">If greater than or equal to 10,000</span>
                            </div>
                            <div style="width: 50%; display: flex;">
                                <!-- dito -->
                                <div  style="width:  50%;">
                                    <div class="input-inner-select-wrapper">
                                        <div class="select-box">
                                            <select  wire:model="inpterms.GreaterThanEqualAmountType" style="border-top-right-radius: 0;border-bottom-right-radius: 0; font-size: 1.3rem;" class="select-option">
                                                <option value="">- - select - -</option>     
                                                <option value="1">Percent</option>                                    
                                                <option value="2">Fixed</option>                                    
                                            </select>                  
                                        </div>
                                        @error('inpterms.GreaterThanEqualAmountType') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                    </div>
                                </div>  
                                <div style="width: 50%;">
                                    <div class="input-wrapper">                                                                   
                                        <input autocomplete="off" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" type="number" wire:model.lazy="inpterms.GreaterThanEqualNotarialAmount" placeholder="Amount">
                                        @error('inpterms.GreaterThanEqualNotarialAmount') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                            <select  wire:model="inpterms.LoanInsuranceAmountType" style="border-top-right-radius: 0;border-bottom-right-radius: 0; font-size: 1.3rem;" class="select-option">
                                                <option value="">- - select - -</option>     
                                                <option value="1">Percent</option>                                    
                                                <option value="2">Fixed</option>                                    
                                            </select>                                                  
                                        </div>
                                        @error('inpterms.LoanInsuranceAmountType') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                    </div>
                                </div>  
                                <div style="width: 50%;">
                                    <div class="input-wrapper">                                                                   
                                        <input autocomplete="off" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" type="number" wire:model.lazy="inpterms.LoanInsuranceAmount" placeholder="Amount">
                                        @error('inpterms.LoanInsuranceAmount') <span class="text-required fw-normal">{{ $message }}</span>@enderror
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
                                            <select  wire:model="inpterms.LifeInsuranceAmountType" style="border-top-right-radius: 0;border-bottom-right-radius: 0; font-size: 1.3rem;" class="select-option">
                                                <option value="">- - select - -</option>     
                                                <option value="1">Percent</option>                                    
                                                <option value="2">Fixed</option>                                    
                                            </select>       
                                        </div>
                                        @error('inpterms.LifeInsuranceAmountType') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                    </div>
                                </div>  
                                <div style="width: 50%;">
                                    <div class="input-wrapper">                                                                   
                                        <input autocomplete="off" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" type="number" wire:model.lazy="inpterms.LifeInsuranceAmount" placeholder="Amount">
                                        @error('inpterms.LifeInsuranceAmount') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                    </div>
                                </div>                       
                        </div>
                    </div>   
                    <div style="width: 30%; padding-right: 40px;">                            
                        <div style="width:  100%; padding-bottom: 5px;">
                            <span style="font-size: 1.5rem; color: #cc0000;" class="fw-bold">Deduct Interest ?</span>
                        </div>  
                        <div style="width:  100%; display: flex;">                           
                            <div  style="width:  100%;">
                                <div class="input-wrapper">                                                                   
                                    <!-- radio -->
                                    <div class="box-wrap" style="gap: 1rem;">
                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.DeductInterest" autocomplete="off" type="radio" value="1" name="DeductInterest" id="DeductInterest1">
                                            <span>Yes</span>                                            
                                        </div>

                                        <div class="radio-btn-wrapper" style="flex-direction: row; gap: 0;">
                                            <input  wire:model.lazy="inpterms.DeductInterest" autocomplete="off" type="radio" value="2" name="DeductInterest" id="DeductInterest2">
                                            <span>No</span>                                            
                                        </div>
                                    </div>
                                    <!-- radio -->                                   
                                    @error('inpterms.DeductInterest') <span class="text-required fw-normal">{{ $message }}</span>@enderror
                                </div>
                            </div>                                   
                        </div>
                    </div>                                                               
                </div>
                <!-- loan insurance -->

                <!-- table -->
                <!-- * Rowspan 5: Add to list Button -->
                <div class="rowspan" style="margin-bottom: 20px;">

                    <div class="btn-wrapper">
                        @if($usertype != 2)
                            <button type="button" class="button"
                                    wire:click="{{ isset($inpterms['termsKey']) ? 'updateTerms' : 'addTerms' }}"
                            >
                                {{ isset($inpterms['termsKey']) ? 'Update to list' : 'Add to list' }}
                            </button>
                        @endif
                        @if(isset($inpterms['termsKey']))
                            {{-- @if($inpterms['termsKey'] > 0) --}}
                                <button type="button" class="button" wire:click="resetterms">Cancel</button>
                            {{-- @endif --}}
                        @endif
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
                                    <th></th>

                                    <!-- * Name -->
                                    <th>
                                        <span class="th-name">Name</span>
                                    </th>

                                    <!-- * Interest Rate -->
                                    <th>
                                        <span class="th-name">Interest Rate</span>
                                    </th>

                                    <!-- * Days -->
                                    <th style="text-align: center">
                                        <span class="th-name">Terms</span>
                                    </th>

                                    <!-- * Advance payment formula -->
                                    <th style="text-align: center">
                                        <span class="th-name">Advance payment formula</span>
                                    </th>

                                    <!-- * Action -->
                                    <th style="display: flex">
                                        <span class="th-name" style="margin: 0 auto;">Action</span>
                                    </th>
                                </tr>


                                <!-- * Terms Of Payment Data -->
                            
                                @if($terms)
                                    @foreach($terms as $key => $value)
                                    <tr>
                                        <!-- * Checkbox Opt -->
                                        <td></td>

                                        <!-- * Name of terms -->
                                        <td>{{ $value['NameOfTerms'] }}</td>

                                        <!-- * Interest Rate -->
                                        <td>{{ ($value['InterestRate'] * 100) }}%</td>
                                        {{-- <td>{{ $value['InterestRate'] }}%</td> --}}

                                        <!-- * Days -->
                                        <td style="text-align: center">
                                            {{ $value['Terms'] }}
                                        </td>

                                        <!-- * Advance payment formula -->
                                        <td style="text-align: center">
                                            {{ $formulaLookup[$value['Formula']] ?? $value['Formula'] }}
                                        </td>

                                        <!-- * Action -->
                                        <td class="td-btns">
                                            <div class="td-btn-wrapper">
                                                <button type="button" wire:click="editTerms('{{ $key }}')" class="a-btn-view-2">
                                                    {{ $currentEditingKey === (string)$key ? 'Editing...' : 'Edit' }}
                                                </button>
                                                @if($usertype != 2)
                                                <button type="button" wire:click="removeTerms('{{ $key }}')" class="a-btn-trash-2">Remove</button>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                @endif
                                @error('terms') 
                                    <tr>
                                        <td colspan="6" style="text-align: center; padding: 20px;"><span class="text-required fw-normal">{{ $message }}</span></td>
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
</div>
<script>
    document.addEventListener('livewire:load', function () {
        window.showDialog = function($mid){              
            @this.call('showDialog', $mid);        
        };

        window.archive = function($mid){
            @this.call('archive', $mid);       
        };
    })
</script>
