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
                    <input type="search" wire:model.live.debounce.400ms="newappmodelkeyword" placeholder="Search name or member ID">
                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                </div>

                <!-- * Create New Button -->
                <div wire:loading.remove>
                    @if ($selectedMember)
                        <button wire:click="deselectMember" type="button"  class="button">Deselect</button>
                    @endif
                    <button wire:click="createIndividualLoan({{$selectedMemberId}}, '{{ $loantype }}')" type="button"  class="button" style="margin-left: 1rem">Create New</button>
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
                        @forelse ($memberlist as $list)
                            {{-- <tr onclick="createIndividualLoan('{{ $list['MemId'] }}', '{{ $loantype }}', '{{ $loanterms }}')"> --}}
                            {{-- <tr onclick="selectMember('{{ $list['MemId'] }}', '{{ $loantype }}', '{{ $loanterms }}')"> --}}
                            @if ($selectedMember && $selectedMemberId)
                                <tr 
                                    wire:click="deselectMember()" 
                                >
                                    <td>
                                        <!-- * Data Name-->
                                        <span class="td-name">{{ (($selectedMember['Lname']) ? $selectedMember['Lname'].', '.$selectedMember['Fname'].' '.(($selectedMember['Mname'] == '') ? $selectedMember['Mname'].'.':''):'') }}</span>
                                    </td>
                                    <td>
                                        <!-- * Data Member ID-->
                                        <span class="td-name">{{ $selectedMember['MemId'] }}</span>
                                    </td>
                                    <td>
                                        <!-- * Data Member ID-->
                                        <span class="td-name">
                                            <span style="padding: 0.4rem 1.2rem; border-radius: 25px; font-size: 1rem; background: #D6A330; color: white">Selected ✓</span>
                                        </span>
                                    </td>
                                </tr>
                            {{-- @elseif (empty($loanterms))
                                <tr>
                                    <td colspan="2">
                                        <span >Select a term first.</span>
                                    </td>
                                </tr> --}}
                            @else
                                <tr 
                                    wire:click="selectMember('{{ $list['MemId'] }}', '{{ $loantype }}', '{{ $loanterms }}')"
                                >
                                    <td>
                                        <!-- * Data Name-->
                                        <span class="td-name">{{ (($list['Lname']) ? $list['Lname'].', '.$list['Fname'].' '.(($list['Mname'] == '') ? $list['Mname'].'.':''):'') }}</span>
                                    </td>
                                    <td>
                                        <!-- * Data Member ID-->
                                        <span class="td-name">{{ $list['MemId'] }}</span>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="2">
                                    <span >There are no existing members.</span>
                                </td>
                            </tr>
                        @endforelse
                        
                       
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
