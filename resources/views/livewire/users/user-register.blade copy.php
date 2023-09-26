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
                    <!-- * User Restrictions Table -->
                    <table>

                      <!-- * Table Header -->
                      <tr>

                        <!-- * Maintenance (Checkbox)-->
                        <th class="th-name">
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
                        </th>

                        <!-- * Collection (Checkbox)-->
                        <th class="th-name">
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
                        </th>

                        <!-- * Transactions (Checkbox)-->
                        <th class="th-name">
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
                        </th>

                        <!-- * Reports (Checkbox)-->
                        <th class="th-name">
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
                        </th>

                      </tr>

                      <!-- * Table Body -->
                      <!-- * URRes 1 -->
                      <tr>

                        <!-- * Field Officer (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              wire:model="maintenance."
                            />
                            <span>Field Officer</span>
                          </div>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              wire:model="maintenance."
                            />
                            <span>Field Officer</span>
                          </div>
                        </td>

                        <!-- * Areas (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Areas</span>
                          </div>
                        </td>

                        <!-- * Applications (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Applications</span>
                          </div>
                        </td>

                        <!-- * Outstanding Reports (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Outstanding Reports</span>
                          </div>
                        </td>
     
                      </tr>

                      <!-- * URRes 2 -->
                      <tr>

                        <!-- * Field Area (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Field Area</span>
                          </div>
                        </td>

                        <!-- * Collection (Checkbox) -->
                        <td class="empty-cell">
                        </td>

                        <!-- * Credit Investigation (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Credit Investigation</span>
                          </div>
                        </td>

                        <!-- * Custom Report 1 (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Custom Report 1</span>
                          </div>
                        </td>
     
                      </tr>

                      <!-- * URRes 3 -->
                      <tr>

                        <!-- * Loan Types (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Loan Types</span>
                          </div>
                        </td>

                        <!-- * Collection (Checkbox) -->
                        <td class="empty-cell">
                        </td>

                        <!-- * Remittance (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Remittance</span>
                          </div>
                        </td>

                        <!-- * Custom Report 2 (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Custom Report 2</span>
                          </div>
                        </td>
     
                      </tr>

                      <!-- * URRes 4 -->
                      <tr>

                        <!-- * Holidays (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Holidays</span>
                          </div>
                        </td>

                        <!-- * Collection (Checkbox) -->
                        <td class="empty-cell">
                        </td>

                        <!-- * Approval (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Approval</span>
                          </div>
                        </td>

                        <!-- * Custom Report 3 (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Custom Report 3</span>
                          </div>
                        </td>
     
                      </tr>

                      <!-- * URRes 5 -->                      
                      <tr>

                        <td class="empty-cell">
                        </td>

                        <td class="empty-cell">
                        </td>

                        <!-- * Releasing (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Releasing</span>
                          </div>
                        </td>

                        <!-- * Custom Report 4 (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Custom Report 4</span>
                          </div>
                        </td>
     
                      </tr>

                      <!-- * URRes 6 -->                     
                      <tr>

                        <td class="empty-cell">
                        </td>

                        <td class="empty-cell">
                        </td>

                        <!-- * Loan Calculator (Checkbox) -->
                        <td>
                          <div class="flex-data">
                            <input
                              type="checkbox"
                              class="checkbox"
                              id="checkboxallCheckbox"
                              onchange="checkAll(this)"
                            />
                            <span>Loan Calculator</span>
                          </div>
                        </td>

                        <td class="empty-cell">
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
