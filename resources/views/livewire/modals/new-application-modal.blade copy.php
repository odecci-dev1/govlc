<div >
    <!-- * New Application Modal -->
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
                <div style="width: 50%;">
                        <div class="input-wrapper">

                            <div class="select-box">

                                <div class="options-container" data-type-opt-con>
                                    <select  wire:model="loantype">
                                        @if($loantypeList)
                                            @foreach($loantypeList as $loantypeList)
                                            <option value="{{ $loantypeList['loanTypeID'] }}">{{ $loantypeList['loanTypeName'] }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>                
                                    @if($loantypeList)
                                        @foreach($loantypeList as $loantypeList)
                                        <div class="option" data-type-loan-opt data-individual-loan-link>

                                            <input type="radio" wire:model="loantype" wire:change="changeLoanType('{{ $loantypeList['loanTypeID'] }}')" class="radio" value="{{ $loantypeList['loanTypeID'] }}" id="loantype{{ $loantypeList['loanTypeID'] }}" name="loantype" />
                                            <label for="loantype{{ $loantypeList['loanTypeID'] }}">
                                                <h4>{{ $loantypeList['loanTypeName'] }}</h4>
                                            </label>

                                        </div>
                                        @endforeach
                                    @endif
                                    
                                </div>
                                
                                <div class="selected" style="font-weight: bold;" data-type-loan-select>
                                    {{ $loantypename }}
                                </div>

                            </div>
                            @error('loantype') <span class="text-required fw-bold">{{ $message }}</span>@enderror
                        </div>
                </div>
                <div style="width: 50%;">
                        <div class="input-wrapper">

                            <div class="select-box">

                                <div class="options-container" data-type-opt-con2>
                                @if($termsOfPaymentList)
                                    @foreach($termsOfPaymentList as $mtermsOfPaymentList)
                                        <div class="option" data-type-loan-opt2 >                                        
                                            <input type="radio" wire:model="loanterms" class="radio" value="{{ $mtermsOfPaymentList['topId'] }}" id="loanterms{{ $mtermsOfPaymentList['topId'] }}" name="loanterms" />
                                            <label for="loanterms{{ $mtermsOfPaymentList['topId'] }}">
                                                <h4>{{ $mtermsOfPaymentList['termsofPayment'] }}</h4>
                                            </label>
                                        </div>
                                    @endforeach
                                @endif    
                                    
                                </div>
                                
                                <div class="selected" style="font-weight: bold; font-size: 1.3rem;" data-type-loan-select2>
                                    {{ isset($loanterms) ? isset($termsOfPaymentList[$loanterms]['termsofPayment']) ? $termsOfPaymentList[$loanterms]['termsofPayment'] : '' : '' }}
                                </div>

                            </div>
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
                    <input type="search" wire:model="newappmodelkeyword" placeholder="Search name or member ID">
                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                </div>

                <!-- * Create New Button -->
                <button wire:click="createIndividualLoan('', '{{ $loantype }}')" type="button" class="button">Create New</button>

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
                                    <span class="td-name">{{ $list['fullname'] }}</span>

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

                    <!-- * Pagination Links -->
                    <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left"></a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right"></a>

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