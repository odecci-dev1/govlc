<div >
    <!-- * New Application Modal -->
    <!-- <div wire:loading  wire:loading.delay wire:target="changeLoanType,loanterms" class="full-screen-div-loading">
        <div class="center-loading-container">
            <div>
                <div class="lds-dual-ring"></div>
            </div>
            <div class="loading-text">
                <span>Please wait . . .</span>
            </div>
        </div>        
    </div> -->
    <dialog class="na-modal" data-new-application-modal wire:ignore.self>

    <div class="modal-container">
        <!-- * Exit Button -->
        <button class="exit-button" id="data-close-new-application-modal">
            <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
        </button>

        <!-- * Choose Type of Loan -->
        <div class="rowspan">
            <div style="display: flex;">
                <div style="width: 50%;">
                    <h3 style="font-size: 1.9rem;">Choose Type of Loan</h3>
                </div>
                <div style="width: 50%;">
                    <h3 style="font-size: 1.9rem;">Choose Terms Of Payment</h3>
                </div>
            </div>
            <div style="display: flex;">
                <div style="width: 50%; padding-right: 4rem;">
                        <div class="input-wrapper">
                            <select  wire:model="loantype" wire:change="changeLoanType" class="select-option">
                                @if($loantypeList)
                                    @foreach($loantypeList as $loantypeList)
                                        <option value="{{ $loantypeList['loanTypeID'] }}">{{ $loantypeList['loanTypeName'] }}</option>
                                    @endforeach
                                @endif                                        
                            </select>          
                            @error('loantype') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                        </div>
                </div>
                <div style="width: 50%;padding-right: 4rem;">
                        <div class="input-wrapper">

                            <select  wire:model="loanterms" wire:change="changeTerms" class="select-option">
                                <option value="">-- select terms --</option>
                                @if($termsOfPaymentList)
                                    @foreach($termsOfPaymentList as $mtermsOfPaymentList)
                                        <option value="{{ $mtermsOfPaymentList['topId'] }}">{{ $mtermsOfPaymentList['termsofPayment'] }}</option>
                                    @endforeach
                                @endif                            
                            </select>                             
                            @error('loanterms') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                        </div>
                </div>
            </div>
                    
        </div>

        <!-- * Search for existing member -->
        <div class="rowspan">

            <!-- * Search for existing member -->
            <h3>Search for existing member</h3>

            <div class="wrapper">

                <!-- * Search Bar -->
                <div class="search-wrap">
                    <!-- <input type="search" wire:keydown.enter="searchExistingMembers($event.target.value)" placeholder="Search name or member ID"> -->
                    <input type="search" wire:model="newappmodelkeyword" wire:keypress="search" placeholder="Search name or member ID">
                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                </div>

                <!-- * Create New Button -->
                <div  wire:loading.remove>
                    <button wire:click="createIndividualLoan('', '{{ $loantype }}')" type="button"  class="button">Create New</button>
                </div>                
            </div>


        </div>

        <!-- * Table -->
        <div class="rowspan">

            <!-- * Container: Table and Pagination -->
            <div class="na-table-con">

                <!-- * Table Container -->
                <div class="table-container">

                    <!-- * Members Table -->
                    <table>

                        <!-- * Table Header -->
                        <tr>

                            <!-- * Checkbox ALl
                            <th><input type="checkbox" id="allCheckbox" onchange="checkAll(this)"></th> -->

                            <!-- * Header Name -->
                            <th><span class="th-name">Name</span></th>

                            <!-- * Header Member ID -->
                            <th><span class="th-name">Member ID</span></th>

                        </tr>


                        <!-- * Members Data -->
                       
                        @if($memberlist)
                            @foreach($memberlist as $list)
                            <tr onclick="createIndividualLoan('{{ $list['memId'] }}', '{{ $loantype }}')">
                            <!-- * Checkbox Opt
                            <td><input type="checkbox" id="checkbox" data-checkbox></td> -->
                                <td>

                                    <!-- * Data Name-->
                                    <span class="td-name">{{ ($list['Lname']) ? $list['Lname'].', '.$list['Fname'].' '.$list['Mname'][0].'.':'' }}</span>

                                </td>
                                <td>
                                    <!-- * Data Member ID-->
                                    <span class="td-name">{{ $list['memId'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        @endif

                    </table>

                </div>

                <!-- * Pagination Container -->
                <div class="pagination-container">

                

                </div>

            </div>

        </div>

    </div>

    </dialog>

    <script>
        document.addEventListener('livewire:load', function () {
            window.createIndividualLoan = function($cmid, $loanid){               
                @this.call('createIndividualLoan', $cmid, $loanid);
            };     
        });
    </script>
</div>
