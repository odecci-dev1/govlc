<div>
<div class="m-con-1">
        @if($showDialog == 1)
            <x-dialog :message="'Are you sure you want to trash selected data? '" :xmid="$mid" :confirmaction="'archive'" :header="'Deletion'"></x-dialog>   
        @endif
        @if(session('mmessage'))
            <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
        @endif
        <h2>Loan Types</h2>
        <p class="p-2">Total of <span id="numOFLoanTypes">{{ $paginationPaging['totalRecord'] }}</span> loan types</p>

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
                    <input type="search" wire:model.live="keyword" placeholder="Search">
                    <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
                </div>

            </div>

        </div>

        <!-- * View Trash Button -->
        <div class="btn-container">
            <!-- <button>View Trash</button> -->
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
                    <th><!-- <input type="checkbox" class="checkbox" data-select-all-checkbox> --></th>

                    <!-- * Loan type name -->
                    <th><span class="th-name">Loan Type Name</span></th>

                    <!-- * Notarial fee -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">No. Of Terms</span>
                            <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                        </div>
                    </th>

                    <!-- * Terms of payment -->
                    <th>
                        <div class="th-wrapper">
                            <span class="th-name">Created At</span>
                            <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                        </div>
                    </th>

                    <!-- * Action -->
                    <th style="width: 1%; text-align: center;"><span class="th-name">Action</span></th>
                </tr>

                @if($list)
                    @foreach($list as $item)
                        <!-- * Loan Type Data -->
                        <tr class="tr-loan-type">

                            <!-- * Checkbox Opt -->
                            <td><!-- <input type="checkbox" class="checkbox" data-select-checkbox> --></td>

                            <td>{{ $item->LoanTypeName }}</td>
                            
                            <td>{{ $item->terms->count() }}</td>

                            <td class="td-bal">{{ date('m/d/Y', strtotime($item->DateCreated)) }}</td>

                            <!-- * Table View and Trash Button -->
                            <td class="td-btns">
                                <div class="td-btn-wrapper">
                                    <a href="{{ URL::to('/') }}/maintenance/loantypes/view/{{ $item->LoanTypeID }}" class="a-btn-view-2">View</a>
                                    @if($usertype != 2)
                                        <button class="a-btn-trash-2" type="button" onclick="showDialog('{{ $item->LoanTypeID }}')">Trash</button>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                @endif

             
            </table>

        </div>

        @if($paginationPaging['totalPage'] > 0)
                <div class="pagination-container" style="overflow-x: auto;">

                    <!-- * Pagination Links -->
                    <a href="#" wire:click="setPage({{ $this->paginationPaging['prevPage'] }})"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left" ></a>
                    @for($x = 1; $x <= $paginationPaging['totalPage']; $x++)
                    <a href="#" wire:click="setPage({{ $x }})" class="{{ $paginationPaging['currentPage'] == $x ? 'font-size-1_4em color-app' : '' }}">{{ $x }}</a>
                    @endfor
                    <a href="#" wire:click="setPage({{ $this->paginationPaging['nextPage'] }})"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right" ></a>

                </div>   
        @endif
        <!-- * Pagination Container -->       
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