<div style="overflow-y: clip">    
    <script src="{{ asset('jquery-master/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('jquery-master/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery.print/jQuery.print.js') }}"></script>    
    <dialog @if ($showModal) open @endif class="na-modal" style="z-index: 11; padding: 0 auto; width: calc(100vw - 30rem)">
        <div class="modal-container" style="padding: 1.6rem 1.4rem;">
            <div style="display: flex; align-items: center;">
                <div style="display: flex; flex-direction: row; align-items: center">
                    <span style="font-size: 2rem; font-weight: 600;">Savings Running Balance</span>
                    <div style="margin: 0 1.6rem; width: 0.5rem; height: 5rem; background: #D6A330;"></div>
                    <div style="display: flex; flex-direction: column;">
                        @if (!empty($memberId))
                            <span style="font-size: 1.8rem; font-weight: 600;">{{ $memberName }}</span>
                            <span style="font-size: 1.8rem; font-weight: 300; color: rgba(0, 0, 0, 0.5)">{{ $memberId }}</span>
                        @endif
                    </div>
                </div>
                <button class="exit-button" wire:click="closeModal">
                    <img src="{{ URL::to('/') }}/assets/icons/x-circle.svg" alt="exit">
                </button>
            </div>

            <!-- * Table -->
            <div>
                <!-- * Table Container -->
                <div class="table-container" style="height: calc(100vh - 30rem)">

                    <!-- * Members Table -->
                    <table>
                        <!-- * Table Header -->
                        <tr>

                            <!-- * Header Name -->
                            <th style="padding: 1.4rem; text-align: left"><span class="th-name" style="font-size: 1.3rem">Savings</span></th>

                            <!-- * Header Name -->
                            <th><span class="th-name" style="font-size: 1.3rem">Note</span></th>

                            <!-- * Header Member ID -->
                            <th><span class="th-name" style="font-size: 1.3rem">Date</span></th>

                            <!-- * Header Member ID -->
                            <th><span class="th-name" style="font-size: 1.3rem">Updated By</span></th>

                        </tr>

                        {{-- @if (!empty($memberId) && !empty($runningSavings)) --}}
                        @if ($this->runningSavings && $this->runningSavings->count())    
                            @forelse ($runningSavings as $rs)
                                <tr>
                                    <td style="padding: 1.4rem; text-align: left">
                                        <span class="td-name" style="font-size: 1.3rem">{{ number_format($rs->Savings, 2) ?? '0.00' }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <span class="td-name" style="font-size: 1.3rem">{{ $rs->Note }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <span class="td-name" style="font-size: 1.3rem">{{ date('Y-m-d', strtotime($rs->Date))}}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <span class="td-name" style="font-size: 1.3rem">{{ $rs->user->full_name ?? 'Unknown User' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding: 1.4rem; text-align: center">
                                        <span style="font-size: 1.3rem; color: rgba(0, 0, 0, 0.5)">There are no savings running balance.</span>
                                    </td>
                                </tr>
                            @endforelse
                        @endif
                    </table>

                </div>
                <!-- * Pagination Container -->
                <div class="total-collection-footer" style="display: flex; justify-content: space-between;">
                    @if ($this->runningSavings && $this->runningSavings->count())
                        <div style="margin: 2rem 0 0 2rem;">
                            <p style="font-size: 1.4rem">
                                {{$paginationPagingModal['startItemModal']}}-{{ $paginationPagingModal['endItemModal'] }} of <span style="font-weight: 700;">{{ $paginationPagingModal['totalRecordModal'] }}</span> Results 
                            </p>
                        </div>
                        <div class="footer-wrapper">
                            @if($paginationPagingModal['totalPageModal'])
                                <div class="pagination-container" style="padding-bottom: 0;">
                                    <a href="#" wire:click.prevent="goToFirstPageModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L12.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M4.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L6.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <!-- Previous Button -->
                                    @if($paginationPagingModal['prevPageModal'])
                                        <a href="#" wire:click.prevent="setPageModal({{ $paginationPagingModal['prevPageModal'] }})">
                                            <img src="{{ URL::to('/') }}/assets/icons/caret-left.svg" alt="caret-left">
                                        </a>
                                    @endif
                            
                                    <!-- Pagination Buttons -->
                                    @php
                                        $startPageModal = max(1, $paginationPagingModal['currentPageModal'] - 2);
                                        $endPageModal = min($paginationPagingModal['totalPageModal'], $paginationPagingModal['currentPageModal'] + 2);
                            
                                        if ($endPageModal - $startPageModal < 4) {
                                            if ($startPageModal > 1) {
                                                $startPageModal = max(1, $endPageModal - 4);
                                            } else {
                                                $endPageModal = min($paginationPagingModal['totalPageModal'], $startPageModal + 4);
                                            }
                                        }
                                    @endphp
                            
                                    @for ($i = $startPageModal; $i <= $endPageModal; $i++)
                                        <a href="#" wire:click.prevent="setPageModal({{ $i }})" class="{{ $paginationPagingModal['currentPageModal'] == $i ? 'font-size-1_4em color-app' : '' }}">{{ $i }}</a>
                                    @endfor
                            
                                    <!-- Next Button -->
                                    @if($paginationPagingModal['nextPageModal'])
                                        <a href="#" wire:click.prevent="setPageModal({{ $paginationPagingModal['nextPageModal'] }})">
                                            <img src="{{ URL::to('/') }}/assets/icons/caret-right.svg" alt="caret-right">
                                        </a>
                                    @endif
            
                                    <a href="#" wire:click.prevent="goToLastPageModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M13.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M19.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                    {{-- @if ($this->runningSavings && $this->runningSavings->count())
                        <div class="pagination-links">
                            {{ $this->runningSavings->links() }}
                        </div>
                    @endif --}}
                </div>
            </div>

        </div>
    </dialog>
    <dialog @if ($showModal) open @endif style="position: absolute; inset: 0; z-index: 10; width: 100%; height: 112%; background: rgba(0, 0, 0, 0.612)"></dialog>
    <div class="reports-container">
        <div class="report-inner-container-2">
                <div class="header-wrapper">
                    <div class="inner-wrapper date-picker">
                        <h2>Savings Report</h2>                                      
                    </div>
                    <!-- * Print and Export Buttons -->
                    <div class="inner-wrapper">
                        <button class="button-2" wire:click="print" type="button"  data-print-button>Print</button>                
                        <button wire:click="exportReport" type="button" class="button-2" data-print-button>Export</button>
                    </div>
                </div>
                <div class="header-wrapper" style="padding-top: 3rem;">
                    <div class="inner-wrapper date-picker">                                 
                        <div class="input-wrapper">
                            <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date Start</span>
                            <input type="date" wire:model.lazy="datestart" class="">
                            @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
                        </div>
                        <div class="input-wrapper">
                            <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Date End</span>
                            <input type="date" wire:model.lazy="dateend" class="">
                            @error('loanDetails.loanAmount') <span class="text-required">{{ $message }}</span> @enderror              
                        </div>    
                        <div class="input-wrapper">
                            <span style="color: #d6a330; font-size: 1.4rem; font-weight: bold;">Member</span>
                            <div style="position: relative;">
                                <input style="width: 45rem; padding-left: 4rem" type="text" wire:model.live="keyword" placeholder="Search...">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="position: absolute; left: 10; top: 10; width: 20px; height: 20px;">
                                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            @error('member') <span class="text-required">{{ $message }}</span> @enderror              
                        </div>  
                        
                    </div>  
                    <div class="btn-wrapper">                                
                        <select  id="selectarea" wire:loading.attr="disabled" wire:model='selectArea' style="height: 4.4rem; background-color: #D6A330; font-size: 1.3rem; min-width: 25rem" class="select-option button">
                            <option value="All">All Areas</option> 
                            @if($area)
                                @foreach($area as $area)
                                    <option value="{{ $area['Id'] }}">{{ $area['Area'] }}</option> 
                                @endforeach
                            @endif                                   
                        </select>          
                          </div>              
                </div>
            <div class="body-wrapper" style="gap: 0; height:clamp(100% - 21rem, 40rem, 80vh); overflow-y: auto;">
                <!-- * Container: Reports Table -->
                <div class="reports-table-container">

                    <!-- * Table Container -->
                    <div class="table-container">

                        <!-- * Savings Table -->
                        <table id="savingsTable">

                            <!-- * Table Header -->
                            <tr>

                                <!-- * Checkbox ALl-->
                                <!-- <th><input type="checkbox" class="checkbox" data-select-all-checkbox></th> -->

                                <!-- * Member Name -->
                                <th><span class="th-name">Member Name</span></th>

                                <!-- * Area -->
                                <th style="text-align: left;"><span class="th-name">Area</span></th>
                                
                                <!-- * Area -->
                                <th style="text-align: center;"><span class="th-name">Status</span></th>

                                <!-- * Total Savings -->
                                <th style="text-align: right;">
                                    <span class="th-name">Total Savings</span>
                                </th>

                                <th>
                            
                            </tr>

                            @if($members)
                                @foreach($members as $member)
                                <!-- * Savings Data -->
                                <tr wire:click="toggleRunningSavings('{{ $member->MemId }}')">

                                    <!-- * Member Name -->
                                    <td>
                                        <div style="display: flex; flex-direction: column;">
                                            <span class="td-name">{{ $member->fullname }}</span>
                                            <span style="font-size: 1.3rem; color: rgba(0, 0, 0, 0.5)">{{ $member->MemId }}</span>
                                        </div>
                                    </td>

                                    <!-- * Area -->
                                    <td style="text-align: left;"><span class="td-name">{{ $member->areaName ?? 'N/A' }}</span></td>

                                    <!-- * Status -->
                                    <td style="text-align: center;"><span class="td-name">{{ $member->status->Name }}</span></td>

                                    <!-- * Total Savings -->
                                    <td style="text-align: right;">
                                        <span class="td-name">
                                        {{ 
                                             $member->MemberSavings[0]->TotalSavingsAmount ?? '0.00'
                                        }}
                                        </span>
                                    </td>

                                    <td style="text-align: right;">
                                    </td>

                                </tr>
                                @endforeach
                            @endif
  
                        </table>
                    
                    </div>

                    <!-- * Total Savings Footer -->
                    <div class="total-collection-footer" style="display: flex; justify-content: space-between;">
                        <div style="margin: auto 0 auto 4rem;">
                            <p style="font-size: 1.4rem">
                                {{$paginationPaging['startItem']}}-{{ $paginationPaging['endItem'] }} of <span style="font-weight: 700;">{{ $paginationPaging['totalRecord'] }}</span> Results 
                            </p>
                        </div>
                        <div class="footer-wrapper">
                            <p>Total Savings:</p> 
                            <span>{{ number_format($totalSavings, 2) }}</span>
                        </div>
                    </div>
                    
                </div>
                
                <div style="display: flex; flex-direction: column">
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
    </div>
</div>
<script>

        document.addEventListener('livewire:load', function () {         
            window.livewire.on('printReport', message => {                 
                    $.print(message.data, {
                        globalStyles: false,
                        mediaPrint: true,
                        stylesheet: null,
                        noPrintSelector: ".no-print",
                        iframe: true,
                        append: null,
                        prepend: null,
                        manuallyCopyFormValues: true,
                        deferred: $.Deferred(),
                        timeout: 750,
                        title: null,
                    });                             
            });            
        });           
        // *** New Application Modal *** //
        // *** New Application Modal *** //
        
        function newAppModal() {
            
            // * New Application (Individual)
            const newApplicationModal = document.querySelector('[data-new-application-modal]')
            
            if (newApplicationModal) {
                
                const openNewApplicationButton = document.querySelector('#data-open-new-application-modal')
                const closeNewApplicationButton = document.querySelector('#data-close-new-application-modal')
                
                if (openNewApplicationButton) {
                    openNewApplicationButton.addEventListener('click', (e) => {
                        newApplicationModal.showModal()
                    })
                }
            
                if (closeNewApplicationButton) {
                    closeNewApplicationButton.addEventListener('click', () => {
                        newApplicationModal.setAttribute("closing", "")
                        newApplicationModal.addEventListener("animationend", () => {
                            newApplicationModal.removeAttribute("closing")
                            newApplicationModal.close()
                        }, { once: true })
                
                    })
                }
            } 
        }

        newAppModal();

        function closeModal(){
            const closeNewApplicationButton = document.querySelector('#data-close-new-application-modal');
            closeNewApplicationButton.click();
        }
        // *** END --- New Application Modal *** //
</script>