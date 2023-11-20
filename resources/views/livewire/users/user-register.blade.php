<div>
<div class="main-dashboard">
        @if(session('sessmessage'))
            <x-alert :message="session('sessmessage')" :words="session('sessmword') ? session('sessmword') : ''" :header="'Success'"></x-alert>   
        @endif
        @if($showDialog == 1)
            <x-dialog :message="'Are you sure you want to trash this data '" :xmid="$mid" :confirmaction="'archive'" :header="'Trash'"></x-dialog>   
        @endif
        <div wire:loading  wire:loading.delay wire:target="register,imgprofile" class="full-screen-div-loading">
          <div class="center-loading-container">
              <div>
                  <div class="lds-dual-ring"></div>
              </div>
              <div class="loading-text">
                  <span>Please wait . . .</span>
              </div>
          </div>        
      </div>
        <!-- * Add New User Container -->
        <form action="" class="na-form-con" autocomplete="off">
          <!-- * Wrapper -->
          <div class="na-container-wrapper-2">
            <!-- * Container 1: User Registration Form Fields and Buttons -->
            <div class="nu-con-1">
              <!-- * Container Wrapper -->
              <div class="container-wrapper">
                <!-- * Big Container -->
                <div class="big-con">
                  <!-- * Form Header -->

                  <!-- * Rowspan 1: Rowspan Header - User Information -->
                  <div class="rowspan">
                    <h2>User Registration</h2>
                  </div>

                  <!-- * Rowspan 2: First Name -->

                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper">
                      <span>Username</span>
                      <input
                        autocomplete="off"
                        type="text"
                       wire:model.defer="username"
                      />
                    </div>
                    @error('username') <span class="text-required">{{ $message }}</span>@enderror
                  </div>
                  @if($mid == '')
                  <!-- field officer -->
                  <div class="rowspan">
                        <div class="btn-wrapper" style="margin-bottom: 2rem;">                        
                          <button type="button" wire:click="openSearchOfficer" class="button">Search Field Officer</button>
                        </div>

                        <div class="input-wrapper" style="width: 15rem; position: relative">
                          <span>FO ID</span>
                          @if($foid != '')
                          <span wire:click="removeFO" style="position: absolute; background-color: red; margin-left: 13.5rem; padding: 0.1rem 0.4rem; border-radius: 50%; color: #ffffff; cursor: pointer;">x</span>
                          @endif
                          <input
                            autocomplete="off"
                            type="text"
                            wire:model.lazy="foid"
                            disabled
                          />
                         
                        </div>
                  </div>
                  @endif
                  <!-- field officer -->

                  @if($updatePassword == 1)
                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper">
                      <span>Password</span>
                      <input
                        autocomplete="off"
                        type="password"
                        wire:model.defer="password"
                      />
                    </div>
                    @error('password') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper">
                      <span>Password Confirmation</span>
                      <input
                        autocomplete="off"
                        type="password"
                        wire:model.defer="password_confirmation"
                      />
                    </div>
                    @error('password_confirmation') <span class="text-required">{{ $message }}</span>@enderror
                  </div>
                  @if($mid != '')
                  <div class="rowspan">
                        <div class="btn-wrapper">
                          <!-- * Upload Button -->
                          <button type="button" wire:click="closeUpdatePassword" class="button">Cancel</button>
                          <button type="button" wire:click="updatePassword" class="button">Update password</button>
                        </div>
                  </div>
                  @endif
                  @else
                  <div class="rowspan">
                        <div class="btn-wrapper">
                          <!-- * Upload Button -->
                          <button type="button" wire:click="changeUpdatePassword" class="button">Change password</button>
                        </div>
                  </div>
                  @endif


                  <div class="rowspan">
                    <!-- * First Name -->
                    <div class="input-wrapper">
                      <span>First Name</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.defer="fname"
                      />
                    </div>
                    @error('fname') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <!-- * Rowspan 3: Middle Name -->
                  <div class="rowspan">
                    <!-- * Middle Name -->
                    <div class="input-wrapper">
                      <span>Middle Name</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.defer="mname"
                      />
                    </div>
                    @error('mname') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <!-- * Rowspan 4: Last Name -->
                  <div class="rowspan">
                    <!-- * Last Name -->
                    <div class="input-wrapper">
                      <span>Last Name</span>
                      <input
                        autocomplete="off"
                        type="text"
                        wire:model.defer="lname"
                      />
                    </div>
                    @error('lname') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <!-- * Rowspan 5: Contact Number -->
                  <div class="rowspan">
                    <!-- * Contact Number -->
                    <div class="input-wrapper">
                      <div class="input-wrapper">
                        <span>Contact Number</span>
                        <input
                          autocomplete="off"
                          type="number"
                          wire:model.defer="cno"
                        />
                      </div>
                    </div>
                    @error('cno') <span class="text-required">{{ $message }}</span>@enderror
                  </div>

                  <!-- * Rowspan 6: Address -->
                  <div class="rowspan">
                    <!-- * Address -->
                    <div class="input-wrapper">
                      <div class="input-wrapper">
                        <span>Address</span>
                        <input
                          autocomplete="off"
                          type="text"
                          wire:model.defer="address"
                        />
                      </div>
                    </div>
                    @error('address') <span class="text-required">{{ $message }}</span>@enderror
                  </div>
                </div>

                <!-- * Container 2: Upload Images, Files and Monthly Bills Input Fields -->
                <div class="small-con">
                  <!-- * Box -->
                  <div class="box">
                    <div class="box-wrap">
                      <!-- * Colspan 1: Upload Image and Update Buttons  -->
                      <div class="colspan">
                        <!-- * Upload Image -->
                        <div class="input-wrapper">
                          <!-- <input type="image"  style="width: 219px; height: 215px;" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" /> -->
                            @if($imgprofile)
                                <img type="image" class="profile" style="width: 70%;" src="{{ $imgprofile->temporaryUrl() }}" alt="upload-image" data-field-officer-image-container>
                            @else
                                @if(file_exists(public_path('storage/users_profile/'.(isset($profilePath) ? $profilePath : 'xxxx'))))                                                                   
                                    <img type="image" class="profile" style="width: 70%;" src="{{ asset('storage/users_profile/'.$profilePath) }}" alt="upload-image" />                                                                     
                                @else
                                    <img type="image" class="profile" style="width: 70%;" src="{{ URL::to('/') }}/assets/icons/upload-image.svg" alt="upload-image" />                                               
                                @endif 
                            @endif     
                        </div>

                        <!-- * Button Wrapper -->
                        <div class="btn-wrapper">
                          <!-- * Upload Button -->
                          <input type="file" wire:model="imgprofile" class="input-image upload-profile-image-btn" accept=".jpg, .jpeg, .png, .gif, .svg" data-upload-field-officer-image-btn></input>
                          <!-- * Update Button -->
                          <button type="button" class="button" wire:click="register">Update</button>
                          @if($mid != '')
                          <button type="button" type="button" onclick="showDialog('{{ $userid }}')" class="button">Trash</button>
                          @endif

                          <!-- * Cancel Button -->
                          <a href="{{ URL::to('/') }}/users" type="button" class="transparentButtonUnderline" data-back-to-user-list>Cancel</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- * Container 2: User Restrictions Radio Buttons -->
            <div class="nu-con-2">
              <!-- * Container Wrapper -->
              <div class="container-wrapper">
                <div class="header-con">
                  <h2>Restrictions</h2>

                  <!-- * All (Checkbox) -->
                  <div class="input-wrapper-checkbox">
                    <input
                      type="radio"
                      class="checkbox"
                      wire:model="usertype"
                      value="1"
                      data-checkbox
                      name="userlevel"
                      id="userlevel1"
                    />
                    <span>All</span>
                  </div>

                  <!-- * Overview (Checkbox) -->
                  <div class="input-wrapper-checkbox">
                    <input
                      type="radio"
                      class="checkbox"
                      wire:model="usertype"
                      value="2"
                      data-checkbox
                      name="userlevel"
                    />
                    <span>Overview</span>
                  </div>

                  <!-- * Members (Checkbox) -->
                  <div class="input-wrapper-checkbox">
                    <input
                      type="radio"
                      class="checkbox"
                      wire:model="usertype"
                      value="3"
                      data-checkbox
                      name="userlevel"
                    />
                    <span>Members</span>
                  </div>
                  @error('usertype') <span class="text-required">{{ $message }}</span>@enderror
                </div>

                <!-- * Container 2: User Restrictions Table List -->
                <div class="ur-con-1">
                  <!-- * Table Container -->
                  <div class="table-container" style="visibility: {{ $usertype == 3 ? 'visible' : 'hidden' }};">
                    <table style="font-size: 1.3rem !important;" class="cust-table">
                      <tr>
                        <td>
                          <table class="cust-table-inside">
                            <tr>
                              <td>
                                <div class="flex-data" style="padding: 1rem 0rem;">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="maintenance"                                                      
                                    wire:change="checkAll('maintenance','1')"
                                  />
                                  <b>Maintenance</b>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @php
                                  $maintenancemdl = $modulelist->where('module_category', '1')->sortBy('module_name');;
                                @endphp
                                @if( $maintenancemdl )
                                  @foreach($maintenancemdl as $maintenancemdl)
                                  <div class="flex-data" style="margin-top: 20px;">
                                    <input type="checkbox" wire:model="modules" class="checkbox" value="{{ $maintenancemdl['module_code'] }}" id="chkmdl{{ $maintenancemdl['module_code'] }}"/>
                                    <label for="chkmdl{{ $maintenancemdl['module_code'] }}">{{ $maintenancemdl['module_name'] }}</label>
                                  </div>
                                  @endforeach
                                @endif
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td>
                          <!-- table -->
                          <table class="cust-table-inside">
                            <tr>
                              <td >
                                <div class="flex-data" style="padding: 1rem 0rem;">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="collection"                                                      
                                    wire:change="checkAll('collection','2')"
                                  />
                                  <b>Collection</b>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @php
                                  $maintenancemdl = $modulelist->where('module_category', '2')->sortBy('module_name');;
                                @endphp
                                @if( $maintenancemdl )
                                  @foreach($maintenancemdl as $maintenancemdl)
                                  <div class="flex-data" style="margin-top: 20px;">
                                    <input type="checkbox" wire:model="modules" class="checkbox" value="{{ $maintenancemdl['module_code'] }}" id="chkmdl{{ $maintenancemdl['module_code'] }}"/>
                                    <label for="chkmdl{{ $maintenancemdl['module_code'] }}">{{ $maintenancemdl['module_name'] }}</label>
                                  </div>
                                  @endforeach
                                @endif
                              </td>
                            </tr>
                          </table>
                          <!-- table -->
                        </td>
                        <td>
                          <!-- table -->
                          <table class="cust-table-inside">
                            <tr>
                              <td>
                                <div class="flex-data" style="padding: 1rem 0rem;">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="transactions"                                                                                
                                    wire:change="checkAll('transactions','3')"
                                  />
                                  <b>Transactions</b>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @php
                                  $maintenancemdl = $modulelist->where('module_category', '3')->sortBy('module_name');;
                                @endphp
                                @if( $maintenancemdl )
                                  @foreach($maintenancemdl as $maintenancemdl)
                                  <div class="flex-data" style="margin-top: 20px;">
                                    <input type="checkbox" wire:model="modules" class="checkbox" value="{{ $maintenancemdl['module_code'] }}" id="chkmdl{{ $maintenancemdl['module_code'] }}"/>
                                    <label for="chkmdl{{ $maintenancemdl['module_code'] }}">{{ $maintenancemdl['module_name'] }}</label>
                                  </div>
                                  @endforeach
                                @endif
                              </td>
                            </tr>
                          </table>
                          <!-- table -->
                        </td>
                        <td>
                          <!-- table -->
                          <table class="cust-table-inside">
                            <tr>
                              <td>
                                <div class="flex-data" style="padding: 1rem 0rem;">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="reports"                                                                                
                                    wire:change="checkAll('reports','4')"
                                  />
                                  <b>Reports</b>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @php
                                  $maintenancemdl = $modulelist->where('module_category', '4')->sortBy('module_name');;
                                @endphp
                                @if( $maintenancemdl )
                                  @foreach($maintenancemdl as $maintenancemdl)
                                  <div class="flex-data" style="margin-top: 20px;">
                                    <input type="checkbox" wire:model="modules" class="checkbox" value="{{ $maintenancemdl['module_code'] }}" id="chkmdl{{ $maintenancemdl['module_code'] }}"/>
                                    <label for="chkmdl{{ $maintenancemdl['module_code'] }}">{{ $maintenancemdl['module_name'] }}</label>
                                  </div>
                                  @endforeach
                                @endif
                              </td>
                            </tr>
                          </table>
                          <!-- table -->
                        </td>      
                        <td>
                          <!-- table -->
                          <table class="cust-table-inside">
                            <tr>
                              <td>
                                <div class="flex-data" style="padding: 1rem 0rem;">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="others"                                                                                
                                    wire:change="checkAll('others','5')"
                                  />
                                  <b>Others</b>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @php
                                  $maintenancemdl = $modulelist->where('module_category', '5')->sortBy('module_name');;
                                @endphp
                                @if( $maintenancemdl )
                                  @foreach($maintenancemdl as $maintenancemdl)
                                  <div class="flex-data" style="margin-top: 20px;">
                                    <input type="checkbox" wire:model="modules" class="checkbox" value="{{ $maintenancemdl['module_code'] }}" id="chkmdl{{ $maintenancemdl['module_code'] }}"/>
                                    <label for="chkmdl{{ $maintenancemdl['module_code'] }}">{{ $maintenancemdl['module_name'] }}</label>
                                  </div>
                                  @endforeach
                                @endif
                              </td>
                            </tr>
                          </table>
                          <!-- table -->
                        </td>                      
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <!-- field officer search -->
      <dialog class="ng-modal" data-new-group-modal wire:ignore.self>
        <div class="modal-container">

            <!-- * Exit Button -->
            <button class="exit-button" id="data-close-new-group-modal">
                <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
            </button>

            <!-- * Search for existing member -->
            <div class="rowspan">

                <!-- * Search for existing member -->
                <h3>Search for field officer</h3>

                <div class="wrapper">

                    <!-- * Search Bar -->
                    <div class="search-wrap">
                        <input type="search" wire:model="searchfokeyword" wire:keyup="searchFO" placeholder="Search field officer">
                        <img src="{{ URL::to('/') }}/assets/icons/magnifyingglass.svg" alt="search">
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
                        <th><input type="checkbox" class="checkbox" id="allCheckbox" onchange="checkAll(this)"></th> -->

                                <!-- * Header Name -->
                                <th><span class="th-name">Name</span></th>

                                <!-- * Header Action-->
                                <th><span class="th-name">Action</span></th>

                            </tr>

                            @if(isset($folist) > 0)
                                @foreach($folist as $fol)
                                <tr>
                                    <!-- * Officer Name -->
                                    <td>

                                        <!-- * Officers' Name-->
                                        <div class="td-wrapper">
                                            <!-- <img src="{{ URL::to('/') }}/assets/icons/sample-dp/Borrower-1.svg" alt="Dela Cruz, Juana"> <span class="td-num">1</span> -->
                                            <span class="td-name">{{ $fol['lname'] . ', ' . $fol['fname'] . ' ' . mb_substr($fol['mname'], 0, 1) . '.' }}</span>
                                        </div>

                                    </td>

                                    <!-- * Action -->
                                    <td class="td-btns">
                                        <div class="td-btn-wrapper">                                           
                                            <button type="button" onclick="selectFO('{{ $fol['foid'] }}', '{{ $fol['fname'] }}', '{{ $fol['mname'] }}', '{{ $fol['lname'] }}')" class="a-btn-trash-2">Select</button>
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
                        <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-left.svg"
                                alt="caret-left"></a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><img src="{{ URL::to('/') }}/assets/icons/caret-right.svg"
                                alt="caret-right"></a>

                    </div>

                </div>

            </div>

        </div>
    </dialog>
      <!-- field officer search -->
</div>
<script>
        document.addEventListener('livewire:load', function () {
                window.showDialog = function($mid){              
                    @this.call('showDialog', $mid);        
                };

                window.archive = function($mid){
                    @this.call('archive', $mid);       
                };

                const dataNewGroupModal = document.querySelector('[data-new-group-modal]')
                const openNewGroupModal = document.querySelector('#data-open-new-group-modal')
                const closeNewGroupModal = document.querySelector('#data-close-new-group-modal')
                const addNewGroupModal = document.querySelector('[data-add-new-group-modal]')

                closeNewGroupModal.addEventListener('click', () => {
                    dataNewGroupModal.setAttribute("closing", "");
                    dataNewGroupModal.addEventListener("animationend", () => {
                        dataNewGroupModal.removeAttribute("closing");
                        dataNewGroupModal.close();
                    }, {
                        once: true
                    });
                })

                window.livewire.on('openSearchOfficerModal', message => {
                    dataNewGroupModal.showModal()
                });

                window.selectFO = function($foid, $fname, $mname, $lname){
                    @this.call('selectFO', $foid, $fname, $mname, $lname);       
                };

                window.livewire.on('closeSearchFOModal', message => {
                    dataNewGroupModal.close();
                });
        })
      
</script>