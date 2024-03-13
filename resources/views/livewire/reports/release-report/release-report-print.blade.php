<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gold One Victory Lending App</title>
    <style>
        body{
            font-size: 11px;     
            font-family: "Inter", sans-serif;    
        }
        table{
            border-collapse: collapse; 
            width: 100%;               
        }
        table tbody tr{
            border-bottom: 1px dotted #737373;
        }
        table th{
            text-align: left;
            vertical-align: bottom;
        }
        @page { size: letter landscape }
    </style>
</head>

<body>
                    <div class="table-container">
                      
                        <!-- * Collection Table -->
                        <table class="table">

                            <!-- * Table Header -->
                            <thead>
                                <tr>
                                    <th colspan="5">
                                        <h3>RELEASING REPORT</h4>                                        
                                    </th>
                                    <th colspan="5" style="text-align: right;">                                      
                                        <h4>From {{ $datestart }} To {{ $dateend }}</h4>
                                    </th>
                                </tr>
                                <tr style=" border-bottom: 1px solid #000000;">            
                                    <th>Application Reference</th>
                                    <th>Member Name</th>
                                    <th>Co Borrower</th>
                                    <th>Area</th>
                                    <th>Loan Type</th>
                                    <th>Loan Amount</th>
                                    <th>Advance Payment</th>
                                    <th>Terms</th>
                                    <th>Due Date</th>
                                    <th>Date Released</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($data)
                                @foreach($data as $data)
                                <tr>

                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ $data['naid'] }}</span></td>

                                    <!-- * Member Name -->
                                    <td><span class="td-name">{{ $data['borrower'] }}</span></td>

                                    <!-- * Co Borrower -->
                                    <td>
                                        <span class="td-name">{{ $data['co_Borrower'] }}</th>    </td>

                                    <!-- * Area -->
                                    <td>
                                        <span class="td-name">{{ $data['area'] }}</th>    </td>

                                    <!-- * Loan Type -->
                                    <td>
                                        <span class="td-name">{{ $data['loanType'] }}</span> 
                                    </td>

                                    <!-- * Loan Amount -->
                                    <td>
                                        <span class="td-name">{{ number_format($data['loanAmount'], 2) }}</span> 
                                    </td>

                                    <!-- * Advance Payment -->
                                    <td>
                                        <span class="td-name">{{ !empty($data['advancePayment']) ? number_format($data['advancePayment'], 2) : 0.00 }}</span> 
                                    </td>

                                    <!-- * Terms -->
                                    <td>
                                        <span class="td-name">{{ !empty($data['termofPayment']) ? $data['termofPayment'] : 'No terms' }}</span> 
                                    </td>

                                    <!-- * Due Date -->
                                    <td>
                                        <span class="td-name">{{ !empty($data['dueDate']) ? date('Y-m-d', strtotime($data['dueDate'])) : 'Empty date' }}</span> 
                                    </td>

                                    <!-- * Date Released -->
                                    <td>
                                        <span class="td-name">{{ $data['releasingDate'] }}</span> 
                                    </td>

                                </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    
                    </div>
</body>

</html>
