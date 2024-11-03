<div class="main-dashboard">
<div class="ul-con-1">
          @if($showDialog == 1)
            <x-dialog :message="'Are you sure you want to Permanently delete the selected data? '" :xmid="$mid" :confirmaction="'archive'" :header="'Deletion'"></x-dialog>   
          @endif
          @if(session('mmessage'))
              <x-alert :message="session('mmessage')" :words="session('mword')" :header="'Success'"></x-alert>   
          @endif
          <h2>User List</h2>
          <p class="p-1">
            Total of <strong>{{ count($list) }}</strong> active users
          </p>

          <!-- * Button Container -->
          <div class="container">
            <!-- * Button Wrapper -->
            <div class="wrapper">
              <!-- * Add New Button -->
                <a href="{{ URL::to('/') }}/register" class="button" data-user-to-add-new-user>
                  <span>Add New</span>
                </a>
            </div>

            <!-- * Search Wrapper -->
            <div class="wrapper">
              <!-- * Filter Button -->           
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
                    <button class="transparentButton">View Trash</button>
                </div>
        </div>

        <!-- * Container 2: User List - Table and Pagination -->
        <div class="ul-con-2">

          <!-- * Table Container -->
          <div class="table-container">

            <!-- * User Table -->
            <table>
              <!-- * Table Header -->
              <tr>
                <!-- * Checkbox ALl-->
                <!-- <th>
                  <input
                    type="checkbox"
                    class="checkbox"
                    data-select-all-checkbox
                  />
                </th> -->

                <!-- * User -->
                <th>
                  <span class="th-name">Name</span>
                </th>

                <!-- * Contact Number -->
                <th>
                  <span class="th-name">Contact Number</span>
                </th>

                <!-- * Address -->
                <th>
                  <span class="th-name">Address</span>
                </th>

                <!-- * Date Registered -->
                <th>
                  <span class="th-name">Date Registered</span>
                </th>

                <!-- * Action -->
                <th style="width: 1%; text-align:center; padding: 1rem 0;"><span class="th-name">Action</span></th>
              </tr>

              <!-- * User List Data -->
              @if($list)              
                @foreach($list as $l)
                <tr>
                    <!-- * Checkbox Opt -->
                    <!-- <td><input type="checkbox" class="checkbox" data-select-checkbox/></td> -->

                    <td>
                    <!-- * User -->
                    <div class="td-wrapper">
                          @if(file_exists(public_path('storage/users_profile/'.(isset($l['profilePath']) ? ($l['profilePath'] != '' ? $l['profilePath'] : 'xxxxxx') : 'xxxx'))))                                  
                              <img src="{{ asset('storage/users_profile/'.$l['profilePath']) }}" alt="upload-image" style="height: 4rem; width: 4rem;" />                                                                                                                 
                          @else
                              <img src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" style="height: 4rem; width: 4rem;" />                                               
                          @endif    
                      
                        <span class="td-name">{{ $l->fullname }}</span>
                    </div>
                    </td>

                    <!-- * Contact Number -->
                    <td>
                        {{ $l->Cno }}
                    </td>

                    <!-- * Address -->
                    <td>
                        {{ $l->Address }}
                    </td>

                    <!-- * Date Registered -->
                    <td>
                        {{ $l->DateCreated }}
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                    <div class="td-btn-wrapper">
                        <a href="{{ URL::to('/') }}/user/view/{{ $l['UserId'] }}" class="a-btn-view-2" data-user-view>View</a>
                        <button onclick="showDialog('{{ $l['Id'] }}')" type="button" class="a-btn-trash-2">Trash</button>
                    </div>
                    </td>
                </tr>               
                @endforeach
              @endif                
            </table>
            
          </div>
          
          <div style="padding-bottom: 2rem;  display: flex; flex-direction: column">
              @if($paginationPaging['totalPage'])
                  <div class="pagination-container">

                      <a href="#" wire:click.prevent="goToFirstPage">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                              <path fill-rule="evenodd" d="M10.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L12.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                              <path fill-rule="evenodd" d="M4.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L6.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                          </svg>
                      </a>
                      <!-- Previous Button -->
                      @if($paginationPaging['prevPage'])
                          <a href="#" wire:click.prevent="setPage({{ $paginationPaging['prevPage'] }})">
                              <img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left">
                          </a>
                      @endif
              
                      <!-- Pagination Buttons -->
                      @php
                          $startPage = max(1, $paginationPaging['currentPage'] - 2);
                          $endPage = min($paginationPaging['totalPage'], $paginationPaging['currentPage'] + 2);
              
                          if ($endPage - $startPage < 4) {
                              if ($startPage > 1) {
                                  $startPage = max(1, $endPage - 4);
                              } else {
                                  $endPage = min($paginationPaging['totalPage'], $startPage + 4);
                              }
                          }
                      @endphp
              
                      @for ($i = $startPage; $i <= $endPage; $i++)
                          <a href="#" wire:click.prevent="setPage({{ $i }})" class="{{ $paginationPaging['currentPage'] == $i ? 'font-size-1_4em color-app' : '' }}">{{ $i }}</a>
                      @endfor
              
                      <!-- Next Button -->
                      @if($paginationPaging['nextPage'])
                          <a href="#" wire:click.prevent="setPage({{ $paginationPaging['nextPage'] }})">
                              <img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right">
                          </a>
                      @endif

                      <a href="#" wire:click.prevent="goToLastPage">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                              <path fill-rule="evenodd" d="M13.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                              <path fill-rule="evenodd" d="M19.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                          </svg>
                      </a>
                  </div>
              @endif
              <p style="text-align: center; font-size: 1.2rem; opacity: 0.7;">
                  Page <span style="font-weight: 700;">{{$paginationPaging['currentPage']}}</span> of {{$paginationPaging['totalPage']}}
              </p>
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
