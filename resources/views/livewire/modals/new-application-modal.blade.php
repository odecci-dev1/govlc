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
                    <h3>Choose Type of Loan</h3>

                    <!-- * Type Of Loan Dropdown Menu -->
                    <div class="loan-type-dropdown">

                        <!-- * Type Of Loan -->
                        <div class="input-wrapper">

                            <div class="select-box">

                                <div class="options-container" data-type-opt-con>

                                    <div class="option" data-type-loan-opt data-individual-loan-link>

                                        <input type="radio" wire:model.lazy="loantype" class="radio" value="Individual Loan" id="loantype1" name="loantype" />
                                        <label for="loantype1">
                                            <h4>Individual Loan</h4>
                                        </label>

                                    </div>

                                    <div class="option" data-type-loan-opt data-group-loan-link>

                                        <input type="radio" wire:model.lazy="loantype"  wire:click="redirectToGroupLoan" value="Group Loan" class="radio" id="loantype2" name="loantype" />
                                        <label for="loantype2">
                                            <h4>Group Loan</h4>
                                        </label>

                                    </div>

                                    <div class="option" data-type-loan-opt>

                                        <input type="radio" wire:model.lazy="loantype"  class="radio" id="loantype3" value="Sample Loan" name="loantype" />
                                        <label for="loantype3">
                                            <h4>Sample Loan</h4>
                                        </label>

                                    </div>

                                </div>
                                
                                <div class="selected" style="font-weight: bold;" data-type-loan-select>
                                    {{ $loantype != '' ? $loantype : '' }}
                                </div>

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
                <a href="{{ URL::to('/') }}/tranactions/application/create" class="button">Create New</a>

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
                            <tr onclick="createIndividualLoan('{{ $list['memId'] }}')">
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
            window.createIndividualLoan = function($cmid){               
                @this.call('createIndividualLoan', $cmid);
            };     
        });
    </script>
</div>
