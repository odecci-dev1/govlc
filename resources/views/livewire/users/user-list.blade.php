<div>
<div class="ul-con-1">
          <h2>User List</h2>
          <p class="p-1">
            Total of <span id="numActiveUsers">10</span> active users
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
                <th>
                  <input
                    type="checkbox"
                    class="checkbox"
                    data-select-all-checkbox
                  />
                </th>

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
                <th><span class="th-name">Action</span></th>
              </tr>

              <!-- * User List Data -->
              @if($list)              
                @foreach($list as $l)
                <tr>
                    <!-- * Checkbox Opt -->
                    <td><input type="checkbox" class="checkbox" data-select-checkbox/></td>

                    <td>
                    <!-- * User -->
                    <div class="td-wrapper">
                        <img
                        src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg"
                        alt="Dela Cruz, Juana"
                        />
                        <span class="td-num">1</span>
                        <span class="td-name">{{ $l['fullname'] }}</span>
                    </div>
                    </td>

                    <!-- * Contact Number -->
                    <td>
                        {{ $l['cno'] }}
                    </td>

                    <!-- * Address -->
                    <td>
                        {{ $l['address'] }}
                    </td>

                    <!-- * Date Registered -->
                    <td>
                        {{ $l['dateCreated'] }}
                    </td>

                    <!-- * Table View and Trash Button -->
                    <td class="td-btns">
                    <div class="td-btn-wrapper">
                        <a href="{{ URL::to('/') }}/user/view/{{ $l['userId'] }}" class="a-btn-view-2" data-user-view>View</a>
                        <button class="a-btn-trash-2">Trash</button>
                    </div>
                    </td>
                </tr>               
                @endforeach
              @endif                
            </table>
            
          </div>

        </div>
</div>
