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
                                    <th colspan="2">
                                        <h3>PAST DUE REPORT For {{ $member }}</h4>                                        
                                    </th>
                                    <th colspan="1" style="text-align: right;">                                      
                                        <h4>From {{ $datestart }} To {{ $dateend }}</h4>
                                    </th>
                                </tr>
                                <tr style=" border-bottom: 1px solid #000000;">                                                                                 
                                    <th style="text-align: left;">Loan Amount</th>      
                                    <th>Date Released</th>                                   
                                    <th>Due Date</th>                           
                                    <th  style="text-align: center;">Total NP</th>    
                                    <th  style="text-align: center;">Total Past Due Day(s)</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                            @if($data)
                                @foreach($data as $data)
                                <tr>
                                    <td style="text-align: left;">
                                        <span class="td-name">{{ !empty($data['LoanAmount']) ? number_format($data['LoanAmount'], 2) : '0.00' }}</span> 
                                    </td>
                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ !empty($data['DateReleased']) ? date('Y-m-d', strtotime($data['DateReleased'])) : '' }}</span></td>

                                    <!-- * Member Name -->
                                    <td><span class="td-name">{{ !empty($data['DueDate']) ? date('Y-m-d', strtotime($data['DueDate'])) : '' }}</span></td>
                                    <td style="text-align: center;"><span class="td-name">{{ $data['TotalNP'] }}</span></td>
                                    <td style="text-align: center;"><span class="td-name">{{ $data['TotalPastDueDay'] }}</span></td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    
                    </div>
</body>

</html>
