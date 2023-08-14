<div>
    
    <!-- * New Loan Types Form -->
    <form action="" class="na-form-con" autocomplete="off">

    <!-- * Container Wrapper: New Loan Types and Terms of Payment -->
    <div class="na-container-wrapper-2">

        <!-- * Container 1: New Loan Types and Buttons -->
        <div class="nl-container-1">

            <!-- * Container Wrapper -->
            <div class="container-wrapper">

                <!-- * Big Container -->
                <div class="big-con">

                    <!-- * Form Header -->

                    <!-- * Rowspan 1: Rowspan Header: Header and Buttons -->
                    <div class="rowspan">

                        <!-- * Header Wrapper -->
                        <div class="header-wrapper">
                            <h2>New Loan Types</h2>
                        </div>

                        <!-- * Buttons -->
                        <div class="btn-wrapper">

                            <!-- * Save -->
                            <button type="button" wire:click="store" class="button" data-save>Save</button>

                        </div>

                    </div>

                    <!-- * Rowspan 2: Last Update and View History -->
                    <div class="rowspan">

                        <!-- * First Name -->
                        <p>Last Updated:
                            <span>
                                <span id="nltDate">05/26/2022</span> ,
                            <span id="nltDay">Thursday</span> at
                            <span id="nltTime">9:45 am</span> by
                            <span id="nltUser">Admin</span>
                            </span>
                        </p>

                        <!-- * View History -->
                        <div class="btn-wrapper">
                            <button type="button">View History</button>
                        </div>

                    </div>

                    <!-- * Rowspan 3: Loan Type Name -->
                    <div class="rowspan">

                        <!-- * Loan Type Name -->
                        <div class="input-wrapper">
                            <span>Loan Type Name</span>
                            <input autocomplete="off" type="text" wire:model.lazy="loanTypeName">
                        </div>

                    </div>

                    <!-- * Rowspan 4: Notarial Fee -->
                    <div class="rowspan">

                        <!-- * Notarial Fee  -->
                        <div class="input-wrapper">
                            <div class="input-inner-wrapper">
                                <span>Notarial Fee</span>
                                <div class="wrapper">
                                    <span>Loan Amount + Interest</span>
                                    <span>&lt;</span>
                                    <input autocomplete="off" type="number" wire:model.lazy="loan_amount_Lessthan_Val" placeholder="Value">
                                    <div class="input-inner-select-wrapper">
                                        <div class="select-box">

                                            <div class="options-container" data-option-con1>

                                                <div class="option" data-option-item1>
                                                    <input type="radio"  wire:model.lazy="loan_amount_Lessthan_Per" class="radio" id="loan_amount_Lessthan_Per1" name="loan_amount_Lessthan_Per" value="1"/>
                                                    <label for="loan_amount_Lessthan_Per1">
                                                        <h4>Percent</h4>
                                                    </label>
                                                </div>

                                                <div class="option" data-option-item1>

                                                    <input type="radio" wire:model.lazy="loan_amount_Lessthan_Per" class="radio" name="loan_amount_Lessthan_Per" id="loan_amount_Lessthan_Per2" value="2"/>
                                                    <label for="loan_amount_Lessthan_Per2">
                                                        <h4>Fixed</h4>
                                                    </label>

                                                </div>

                                            </div>

                                            <div class="selected" data-option-select1>
                                                {{ isset($loan_amount_Lessthan_Per) ? ($loan_amount_Lessthan_Per == 1 ? 'Percent' : 'Fixed') : '' }}
                                            </div>

                                        </div>
                                        <input autocomplete="off" wire:model.lazy="loan_amount_Lessthan_Val" type="number" id="conNum" name="conNum" placeholder="Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="input-inner-wrapper">
                                <div class="wrapper">
                                    <span>Loan Amount + Interest</span>
                                    <span>&gt;=</span>
                                    <input autocomplete="off" type="number" id="conNum" name="conNum" placeholder="Value">
                                    <div class="input-inner-select-wrapper">
                                        <div class="select-box">

                                            <div class="options-container" data-option-con2>

                                                <div class="option" data-option-item2>

                                                    <input type="radio" class="radio" name="category" value="Percent"/>
                                                    <label for="Percent">
                                                        <h4>Percent</h4>
                                                    </label>

                                                </div>

                                                <div class="option" data-option-item2>

                                                    <input type="radio" class="radio" name="category" value="Fixed"/>
                                                    <label for="Fixed">
                                                        <h4>Fixed</h4>
                                                    </label>

                                                </div>

                                            </div>

                                            <div class="selected" data-option-select2>
                                                <!-- Select Formula -->
                                            </div>

                                        </div>
                                        <input autocomplete="off" type="number" id="conNum" name="conNum" placeholder="Amount">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- * Rowspan 5: Savings, Loan Insurance, and Life Insurance -->
                    <div class="rowspan">

                        <!-- * Savings -->
                        <div class="input-wrapper">
                            <span>Savings</span>
                            <input autocomplete="off" type="text" id="nltSavings" name="nltSavings">
                        </div>

                        <!-- * Loan Insurance -->
                        <div class="input-wrapper">
                            <div class="input-inner-wrapper">
                                <span>Loan Insurance</span>
                                <div class="input-inner-select-wrapper">
                                    <div class="select-box">

                                        <div class="options-container" data-option-con3>

                                            <div class="option" data-option-item3>

                                                <input type="radio" class="radio" name="category" value="Percent"/>
                                                <label for="Percent">
                                                        <h4>Percent</h4>
                                                </label>

                                            </div>

                                            <div class="option" data-option-item3>

                                                    <input type="radio" class="radio" name="category" value="Fixed"/>
                                                    <label for="Fixed">
                                                        <h4>Fixed</h4>
                                                    </label>

                                            </div>

                                        </div>

                                        <div class="selected" data-option-select3>
                                                <!-- Select Formula -->
                                        </div>

                                    </div>
                                    <input autocomplete="off" type="number" id="conNum" name="conNum" placeholder="Amount">
                                </div>
                            </div>
                        </div>

                        <!-- * Life Insurance -->
                        <div class="input-wrapper">
                            <div class="input-inner-wrapper">
                                <span>Life Insurance</span>
                                <div class="input-inner-select-wrapper">
                                    <div class="select-box">

                                        <div class="options-container" data-option-con4>

                                            <div class="option" data-option-item4>

                                                <input type="radio" class="radio" name="category" value="Percent"/>
                                                <label for="Percent">
                                                        <h4>Percent</h4>
                                                </label>

                                            </div>

                                            <div class="option" data-option-item4>

                                                    <input type="radio" class="radio" name="category" value="Fixed"/>
                                                    <label for="Fixed">
                                                        <h4>Fixed</h4>
                                                    </label>

                                            </div>

                                        </div>

                                        <div class="selected" data-option-select4>
                                                <!-- Select Formula -->
                                        </div>

                                    </div>
                                    <input autocomplete="off" type="number" id="conNum" name="conNum" placeholder="Amount">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- * Rowspan 6: Loan Amount -->
                    <div class="rowspan">

                        <!-- * Loan Amount -->
                        <div class="input-wrapper">
                            <span>Loan Amount</span>
                            <div class="input-inner-wrapper-2">
                                <input autocomplete="off" type="number" id="loanAmntMin" name="loanAmntMin" placeholder="Min:">
                                <input autocomplete="off" type="number" id="loanAmntMax" name="loanAmntMax" placeholder="Max:">
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- * Container 2: Terms of Payment and Buttons -->
        <div class="top-container-2">

            <!-- * Container Wrapper -->
            <div class="container-wrapper">

                <!-- * Big Container -->
                <div class="big-con">

                    <!-- * Form Header -->

                    <!-- * Rowspan 1: Rowspan Header - Header -->
                    <div class="rowspan">

                        <!-- * Header Wrapper -->
                        <div class="header-wrapper">
                            <h2>Terms of Payment</h2>
                        </div>

                    </div>

                    <!-- * Rowspan 2: Last Update and View History -->
                    <div class="rowspan">

                        <!-- * First Name -->
                        <p>Last Updated:
                            <span>
                                <span id="topDate">05/26/2022</span> ,
                            <span id="topDay">Thursday</span> at
                            <span id="topTime">9:45 am</span> by
                            <span id="topUser">Admin</span>
                            </span>
                        </p>

                        <!-- * View History -->
                        <div class="btn-wrapper">
                            <button type="button">View History</button>
                        </div>

                    </div>

                    <!-- * Rowspan 3: Name of terms and Days -->
                    <div class="rowspan">

                        <!-- * Name of terms -->
                        <div class="input-wrapper">
                            <span>Name of terms</span>
                            <input autocomplete="off" type="text" id="topNot" name="topNot">
                        </div>

                        <!-- * Days -->
                        <div class="input-wrapper">
                            <span>Days</span>
                            <input autocomplete="off" type="number" id="topDays" name="topDays">
                        </div>

                    </div>

                    <!-- * Rowspan 4: Interest Rate and Advance Payment Formula -->
                    <div class="rowspan">

                        <!-- * Advance Payment Formula -->
                        <div class="input-wrapper">
                            <div class="input-inner-wrapper">
                                <span>Loan Insurance</span>
                                <div class="input-inner-select-wrapper">
                                    <div class="select-box">

                                        <div class="options-container" data-option-con5>

                                            <div class="option" data-option-item5>

                                                <input type="radio" class="radio" name="category" value="Percent"/>
                                                <label for="Percent">
                                                        <h4>Percent</h4>
                                                </label>

                                            </div>

                                            <div class="option" data-option-item5>

                                                    <input type="radio" class="radio" name="category" value="Fixed"/>
                                                    <label for="Fixed">
                                                        <h4>Fixed</h4>
                                                    </label>

                                            </div>

                                        </div>

                                        <div class="selected" data-option-select5>
                                                <!-- Select Formula -->
                                        </div>

                                    </div>
                                    <input autocomplete="off" type="number" id="conNum" name="conNum" placeholder="Amount">
                                </div>
                            </div>
                        </div>

                        <!-- * Advance Payment Formula -->
                        <div class="input-wrapper">
                            <span>Advance Payment Formula</span>
                            <div class="select-box">

                                <div class="options-container" data-option-con6>

                                    <div class="option" data-option-item6>

                                        <input type="radio" class="radio" name="category" value="(Loan Amount + Interest) / Days"/>
                                        <label for="(Loan Amount + Interest) / Days">
                                            <h4>(Loan Amount + Interest) / Days</h4>
                                        </label>

                                    </div>

                                    <div class="option" data-option-item6>

                                        <input type="radio" class="radio" name="category" value="((Loan Amount + Interest) / Days) x 2"/>
                                        <label for="((Loan Amount + Interest) / Days) x 2">
                                            <h4>((Loan Amount + Interest) / Days) x 2</h4>
                                        </label>

                                    </div>

                                </div>

                                <div class="selected" data-option-select6>
                                    Select Formula
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- * Rowspan 5: Add to list Button -->
                    <div class="rowspan">

                        <div class="btn-wrapper">
                            <button type="button" class="button">Add to list</button>
                        </div>

                    </div>

                    <!-- * Rowspan 6: Terms Of Payment Table -->
                    <div class="rowspan">


                        <!-- * Container 2: Terms Of Payment -->
                        <div class="m-con-2">

                            <!-- * Table Container -->
                            <div class="table-container">

                                <!-- * Terms Of Payment Table -->
                                <table id="termsOfPaymentTable">

                                    <!-- * Table Header -->
                                    <tr>

                                        <!-- * Checkbox ALl-->
                                        <th>
                                            <input type="checkbox" class="checkbox" data-select-all-checkbox>
                                        </th>

                                        <!-- * Name -->
                                        <th>
                                            <span class="th-name">Name</span>
                                        </th>

                                        <!-- * Interest Rate -->
                                        <th>
                                            <span class="th-name">Interest Rate</span>
                                        </th>

                                        <!-- * Days -->
                                        <th>
                                            <span class="th-name">Days</span>
                                        </th>

                                        <!-- * Advance payment formula -->
                                        <th>
                                            <span class="th-name">Advance payment formula</span>
                                        </th>

                                        <!-- * Action -->
                                        <th>
                                            <span class="th-name">Action</span>
                                        </th>
                                    </tr>


                                    <!-- * Terms Of Payment Data -->
                                    <tr>

                                        <!-- * Checkbox Opt -->
                                        <td>
                                            <input type="checkbox" class="checkbox" data-select-checkbox>
                                        </td>

                                        <!-- * Name of terms -->
                                        <td>
                                            60 Days
                                        </td>

                                        <!-- * Interest Rate -->
                                        <td>
                                            18%
                                        </td>

                                        <!-- * Days -->
                                        <td>
                                            60
                                        </td>

                                        <!-- * Advance payment formula -->
                                        <td>
                                            (Loan Amount + Interest) / Days
                                        </td>

                                        <!-- * Action -->
                                        <td class="td-btns">
                                            <div class="td-btn-wrapper">
                                                <!-- <button class="a-btn-view">View</button> -->
                                                <button class="a-btn-trash-2">Trash</button>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>

                                        <!-- * Checkbox Opt -->
                                        <td>
                                            <input type="checkbox" class="checkbox" data-select-checkbox>
                                        </td>

                                        <!-- * Name of terms -->
                                        <td>
                                            90 Days
                                        </td>

                                        <!-- * Interest Rate -->
                                        <td>
                                            18%
                                        </td>

                                        <!-- * Days -->
                                        <td>
                                            90
                                        </td>

                                        <!-- * Advance payment formula -->
                                        <td>
                                            (Loan Amount + Interest) / Days
                                        </td>

                                        <!-- * Action -->
                                        <td class="td-btns">
                                            <div class="td-btn-wrapper">
                                                <!-- <button class="a-btn-view">View</button> -->
                                                <button class="a-btn-trash-2">Trash</button>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>

                                        <!-- * Checkbox Opt -->
                                        <td>
                                            <input type="checkbox" class="checkbox" data-select-checkbox>
                                        </td>

                                        <!-- * Name of terms -->
                                        <td>
                                            60 Days
                                        </td>

                                        <!-- * Interest Rate -->
                                        <td>
                                            18%
                                        </td>

                                        <!-- * Days -->
                                        <td>
                                            60
                                        </td>

                                        <!-- * Advance payment formula -->
                                        <td>
                                            (Loan Amount + Interest) / Days
                                        </td>

                                        <!-- * Action -->
                                        <td class="td-btns">
                                            <div class="td-btn-wrapper">
                                                <!-- <button class="a-btn-view">View</button> -->
                                                <button class="a-btn-trash-2">Trash</button>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>

                                        <!-- * Checkbox Opt -->
                                        <td>
                                            <input type="checkbox" class="checkbox" data-select-checkbox>
                                        </td>

                                        <!-- * Name of terms -->
                                        <td>
                                            90 Days
                                        </td>

                                        <!-- * Interest Rate -->
                                        <td>
                                            18%
                                        </td>

                                        <!-- * Days -->
                                        <td>
                                            90
                                        </td>

                                        <!-- * Advance payment formula -->
                                        <td>
                                            (Loan Amount + Interest) / Days
                                        </td>

                                        <!-- * Action -->
                                        <td class="td-btns">
                                            <div class="td-btn-wrapper">
                                                <!-- <button class="a-btn-view">View</button> -->
                                                <button class="a-btn-trash-2">Trash</button>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>

                                        <!-- * Checkbox Opt -->
                                        <td>
                                            <input type="checkbox" class="checkbox" data-select-checkbox>
                                        </td>

                                        <!-- * Name of terms -->
                                        <td>
                                            60 Days
                                        </td>

                                        <!-- * Interest Rate -->
                                        <td>
                                            18%
                                        </td>

                                        <!-- * Days -->
                                        <td>
                                            60
                                        </td>

                                        <!-- * Advance payment formula -->
                                        <td>
                                            (Loan Amount + Interest) / Days
                                        </td>

                                        <!-- * Action -->
                                        <td class="td-btns">
                                            <div class="td-btn-wrapper">
                                                <!-- <button class="a-btn-view">View</button> -->
                                                <button class="a-btn-trash-2">Trash</button>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>

                                        <!-- * Checkbox Opt -->
                                        <td>
                                            <input type="checkbox" class="checkbox" data-select-checkbox>
                                        </td>

                                        <!-- * Name of terms -->
                                        <td>
                                            90 Days
                                        </td>

                                        <!-- * Interest Rate -->
                                        <td>
                                            18%
                                        </td>

                                        <!-- * Days -->
                                        <td>
                                            90
                                        </td>

                                        <!-- * Advance payment formula -->
                                        <td>
                                            (Loan Amount + Interest) / Days
                                        </td>

                                        <!-- * Action -->
                                        <td class="td-btns">
                                            <div class="td-btn-wrapper">
                                                <!-- <button class="a-btn-view">View</button> -->
                                                <button class="a-btn-trash-2">Trash</button>
                                            </div>
                                        </td>

                                    </tr>

                                </table>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

    </form>
    <script>
            
        // ** Select Dropdown 1 (Percentage & Fixed Toggle)
        let selectedOpt1 = document.querySelector('[data-option-select1]');

        const optionsContainer1 = document.querySelector('[data-option-con1]');
        const optionsList1 = document.querySelectorAll('[data-option-item1]');


        if (selectedOpt1) {

            selectedOpt1.addEventListener("click", () => {
                optionsContainer1.classList.toggle("active");
            });

            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select1], [data-option-con1]')) {
                    optionsContainer1.classList.remove("active");
                }
            });

            optionsList1.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt1.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer1.classList.remove("active");
                });
            });

        }

                
        // ** Select Dropdown 2 (Percentage & Fixed Toggle)
        const selectedOpt2 = document.querySelector('[data-option-select2]');


        const optionsContainer2 = document.querySelector('[data-option-con2]');
        const optionsList2 = document.querySelectorAll('[data-option-item2]');

        if (selectedOpt2) {

            selectedOpt2.addEventListener("click", () => {
                optionsContainer2.classList.toggle("active");
            });

            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select2], [data-option-con2]')) {
                    optionsContainer2.classList.remove("active");
                }
            });

            optionsList2.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt2.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer2.classList.remove("active");
                });
            });

        }

        // ** Select Dropdown 3 (Percentage & Fixed Toggle)
        const selectedOpt3 = document.querySelector('[data-option-select3]');


        const optionsContainer3 = document.querySelector('[data-option-con3]');
        const optionsList3 = document.querySelectorAll('[data-option-item3]');

        if (selectedOpt3) {

            selectedOpt3.addEventListener("click", () => {
                optionsContainer3.classList.toggle("active");
            });

            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select3], [data-option-con3]')) {
                    optionsContainer3.classList.remove("active");
                }
            });

            optionsList3.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt3.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer3.classList.remove("active");
                });
            });

        }

        // ** Select Dropdown 4 (Percentage & Fixed Toggle)
        const selectedOpt4 = document.querySelector('[data-option-select4]');


        const optionsContainer4 = document.querySelector('[data-option-con4]');
        const optionsList4 = document.querySelectorAll('[data-option-item4]');

        if (selectedOpt4) {

            selectedOpt4.addEventListener("click", () => {
                optionsContainer4.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select4], [data-option-con4]')) {
                    optionsContainer4.classList.remove("active");
                }
            });

            optionsList4.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt4.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer4.classList.remove("active");
                });
            });

        }

                
        // ** Select Dropdown 5 (Percentage & Fixed Toggle)
        const selectedOpt5 = document.querySelector('[data-option-select5]');


        const optionsContainer5 = document.querySelector('[data-option-con5]');
        const optionsList5 = document.querySelectorAll('[data-option-item5]');

        if (selectedOpt5) {

            selectedOpt5.addEventListener("click", () => {
                optionsContainer5.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select5], [data-option-con5]')) {
                    optionsContainer5.classList.remove("active");
                }
            });

            optionsList5.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt5.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer5.classList.remove("active");
                });
            });

        }


        // ** Select Dropdown 6 (Percentage & Fixed Toggle)
        const selectedOpt6 = document.querySelector('[data-option-select6]');


        const optionsContainer6 = document.querySelector('[data-option-con6]');
        const optionsList6 = document.querySelectorAll('[data-option-item6]');

        if (selectedOpt6) {

            selectedOpt6.addEventListener("click", () => {
                optionsContainer6.classList.toggle("active");
            });
            
            // Close dropdowns when clicking outside of them
            document.addEventListener('click', (e) => {
                if (!e.target.matches('[data-option-select6], [data-option-con6]')) {
                    optionsContainer6.classList.remove("active");
                }
            });

            optionsList6.forEach(option => {
                option.addEventListener("click", () => {
                    selectedOpt6.innerHTML = option.querySelector("label").innerHTML;
                    optionsContainer6.classList.remove("active");
                });
            });

        }

    </script>
</div>
