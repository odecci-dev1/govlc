<div>
<div class="m-con-1">
        @if($showDialog == 1)
            <x-dialog :message="'Are you sure you want to trash selected data? '" :xmid="$mid" :confirmaction="'archive'" :header="'Deletion'"></x-dialog>   
        @endif
        @if(session('mmessage'))
            <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
        @endif
        <h2>Loan Types</h2>
        <p class="p-2">Total of <span id="numOFLoanTypes">5</span> loan types</p>

        <!-- * Button Container -->
        <div class="container">

            <!-- * Button Wrapper -->
            <div class="wrapper">
                @if($usertype != 2)
                <!-- * Add New Button -->
                <a href="{{ URL::to('/') }}/maintenance/loantypes/create"><button><span>Add New</span></button></a>
                @endif
            </div>

            <!-- * Search Wrapper -->
            <div class="wrapper">
                <!-- * Search Bar -->
                <div class="search-wrap">
                    <input type="search"wire:model="keyword" placeholder="Search">
                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                </div>

            </div>

        </div>

        <!-- * View Trash Button -->
        <div class="btn-container">
            <button>View Trash</button>
        </div>
        </div>

        <!-- * Container 2: Loan Type - Table and Pagination -->
        <div class="m-con-2">

        <!-- * Table Container -->
        <div class="table-container">

            <!-- * Loan Type Table -->
            <table>

                <!-- * Table Header -->
                <tr class="tr-loan-type">

                    <!-- * Checkbox ALl-->
                    <th>
                        <!-- <input type="checkbox" class="checkbox" data-select-all-checkbox> -->
                    </th>

                    <!-- * Loan type name -->
                    <th>
                        <span class="th-name">Loan type name</span>
                    </th>

                    <!-- * Notarial fee -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">No. Of Terms</span>
                            <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                        </div>
                    </th>

                    <!-- * Interest rate -->
                    <!-- <th>
                        <div class="th-wrapper">
                            <span class="th-name">Interest rate</span>
                            <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                        </div>
                    </th> -->

                    <!-- * Terms of payment -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">Created At</span>
                            <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel">
                        </div>
                    </th>

                    <!-- * Action -->
                    <th><span class="th-name">Action</span></th>
                </tr>

                @if($list)
                    @foreach($list as $list)
                        <!-- * Loan Type Data -->
                        <tr class="tr-loan-type">

                            <!-- * Checkbox Opt -->
                            <td>
                                <!-- <input type="checkbox" class="checkbox" data-select-checkbox> -->
                            </td>

                            <!-- * Loan type name Data-->
                            <td>
                                {{ $list['loanTypeName'] }}
                            </td>

                            <!-- * Notarial fee Data-->
                            <td>
                               {{ count($list['termsofPayment']) }}
                            </td>

                            <!-- * Interest rate Data-->
                            <!-- <td class="td-curLoan">
                               
                            </td> -->

                            <!-- * Terms of payment Data-->
                            <td class="td-bal">
                                {{ date('m/d/Y', strtotime($list['dateCreated'])) }}
                            </td>

                            <!-- * Table View and Trash Button -->
                            <td class="td-btns">
                                <div class="td-btn-wrapper">
                                    <a href="{{ URL::to('/') }}/maintenance/loantypes/view/{{ $list['loanTypeID'] }}" class="a-btn-view-2">View</a>
                                    @if($usertype != 2)
                                    <button class="a-btn-trash-2" type="button" onclick="showDialog('{{ $list['loanTypeID'] }}')">Trash</button>
                                    @endif
                                </div>
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