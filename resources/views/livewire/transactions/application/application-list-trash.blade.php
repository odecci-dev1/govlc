<div class="na-form-con">
    <!-- modals -->
    @if(session('mmessage'))
        <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
    @endif
    @if($showDialog == 1)
        <x-dialog :message="'Are you sure you want to restore the selected data'" :xmid="$mid" :confirmaction="'restore'" :header="'Deletion'"></x-dialog>   
    @endif
    <livewire:modals.new-application-modal  :type="''" :mid="isset($id) ? $id : ''"/> 
    <!-- modals -->
    <!-- <x-error-dialog :message="'Operation Failed. Retry'" :xmid="''" :confirmaction="session('erroraction')" :header="'Error'"></x-error-dialog>        -->
    <!-- * Filter Modal -->   
    <div class="nal-con-1">
        <h2>Trashed Application List</h2>
        <p class="p-1">
        Total of <span id="numOfApplicants">{{ isset($list) ? count($list) : 0 }}</span> trashed applications
        </p>

        <!-- * Button Container -->
        <div class="container">

        <!-- * Button Wrapper -->
            <div class="wrapper">
            <a href="{{ URL::to('/') }}/tranactions/application/list" class="transparentButton">Main List</a>
            </div>

            <!-- * Search Wrapper -->
            <div class="wrapper">

            
                <!-- * Search Bar -->
                <div class="search-wrap">
                    <input
                        type="search"
                        wire:model="keyword"
                        placeholder="Search"
                    />
                    <img
                        src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg"
                        alt="search"
                    />
                </div>
            </div>
    </div>

    <!-- * View Trash Button -->
        <div class="btn-container">
          
        </div>
    </div>

    <!-- * Container 2: User List - Table and Pagination -->
    <div class="nal-con-2">

        <!-- * Table Container -->
        <div class="table-container">

        <!-- * User Table -->
        <table>
            <!-- * Table Header -->
            <tr >
                <!-- * Checkbox All-->
                <!-- <th>
                    <input
                    type="checkbox"
                    class="checkbox"
                    data-select-all-checkbox
                    />
                </th> -->

                <!-- * Borrower -->
                <th >
                    <div class="th-wrapper">
                        <span class="th-name" >Borrower</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Borrower Contact # -->
                <th>
                    <span class="th-name">Borrower Contact #</span>
                </th>

                <!-- * Co-Borrower -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Co-Borrower</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Co-Borrower Contact # -->
                <th>
                    <span class="th-name">Co-Borrower Contact #</span>
                </th>

                <!-- * Applied Loan Amount -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Applied Loan Amount</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Loan type -->
                <th>
                    <span class="th-name">Loan type</span>
                </th>

                <!-- * Date Created -->
                <th>
                    <div class="th-wrapper">
                        <span class="th-name">Date Created</span>
                        <!-- <img src="{{ URL::to('/') }}/assets/icons/funnel-simple.svg" alt="funnel"> -->
                    </div>
                </th>

                <!-- * Action -->
                <th style="text-align: center;"><span class="th-name">Action</span></th>
            </tr>

            <!-- * Table Data -->
        
            @if($list)              
                @foreach($list as $l)
                <tr>

                    <!-- * Checkbox Opt -->
                    <!-- <td><input type="checkbox" class="checkbox" data-select-checkbox/></td> -->
                        
                    <!-- * Borrower -->
                    <td>
                       {{ $l['borrower'] }}
                    </td>

                    <!-- * Borrower Contact Number -->
                    <td>
                        {{ $l['cno'] }}
                    </td>
                        
                    <!-- * Co-Borrower -->
                    <td>
                        {{ $l['coBorrower'] }}
                    </td>

                    <!-- * Co-Borrower Contact Number -->
                    <td>
                         {{ $l['co_Cno'] }}
                    </td>

                    <!-- * Applied Loan Amount -->
                    <td class="td-num">
                        {{ $l['loanAmount'] }}
                    </td>

                    <!-- * Loan type -->
                    <td>
                        {{ $l['loanType'] }}
                    </td>

                    <!-- * Date Created -->
                    <td>
                        {{ date('m/d/Y', strtotime($l['dateCreated'])) }}
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                        <div class="td-btn-wrapper">
                            @if($l['loanTypeID'] == 'LT-02')
                                <a href="{{ URL::to('/') }}/tranactions/group/application/view/{{ $l['groupId'] }}" class="a-btn-view-3" data-view-application>View</a>
                            @else
                                <a href="{{ URL::to('/') }}/tranactions/application/view/{{ $l['naid'] }}" class="a-btn-view-3" data-view-application>View</a>
                            @endif
                            <button  onclick="showDialog('{{ $l['naid'] }}')"  type="button" class="a-btn-trash-5">Restore</button>
                        </div>
                    </td>
                
                </tr>
                @endforeach
            @else
                    <tr>
                        <td colspan="9" class="text-required" style="text-align: center; padding: 20px;">No application found</td>
                    </tr>    
            @endif              
        </table>
        
        </div>

    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            window.showDialog = function($mid){              
                @this.call('showDialog', $mid);        
            };

            window.restore = function($mid){
                @this.call('restore', $mid);       
            };
        });
    </script>
</div>
