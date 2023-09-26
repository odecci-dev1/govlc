<div>
<div class="main-dashboard">
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
                          <input
                            type="image"
                            src="{{ URL::to('/') }}/assets/icons/upload-image.svg"
                            alt="upload-image"
                          />
                        </div>

                        <!-- * Button Wrapper -->
                        <div class="btn-wrapper">
                          <!-- * Upload Button -->
                          <button type="button" class="button" submit="">Upload Image</button>

                          <!-- * Update Button -->
                          <button type="button" class="button" wire:click="register">Update</button>

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
                  <div class="table-container">
                    <table>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>
                                <div class="flex-data">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="maintenanace"  
                                    value="1"                         
                                    onchange="checkAll(this)"
                                  />
                                  <span>Maintenance</span>
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
                          <table>
                            <tr>
                              <td>
                                <div class="flex-data">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="collection"  
                                    value="1"                         
                                    onchange="checkAll(this)"
                                  />
                                  <span>Collection</span>
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
                          <table>
                            <tr>
                              <td>
                                <div class="flex-data">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="transactions"  
                                    value="1"                         
                                    onchange="checkAll(this)"
                                  />
                                  <span>Transactions</span>
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
                          <table>
                            <tr>
                              <td>
                                <div class="flex-data">
                                    <input
                                    type="checkbox"
                                    class="checkbox"
                                    wire:model="reports"  
                                    value="1"                         
                                    onchange="checkAll(this)"
                                  />
                                  <span>Reports</span>
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
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
</div>
