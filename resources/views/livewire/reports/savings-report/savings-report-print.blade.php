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
                                        <h3>SAVINGS REPORT For {{ $member }}</h4>                                        
                                    </th>
                                    <th colspan="1" style="text-align: right;">                                      
                                        <h4>From {{ $datestart }} To {{ $dateend }}</h4>
                                    </th>
                                </tr>
                                <tr style=" border-bottom: 1px solid #000000;">                                              
                                    <th>Member Name</th>                                   
                                    <th>Area</th>
                                    <th style="text-align: right;">Total Savings</th>                                 
                                </tr>
                            </thead>
                            <tbody>
                            @if($data)
                                @foreach($data as $data)
                                <tr>

                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ $data['borrower'] }}</span></td>

                                    <!-- * Member Name -->
                                    <td><span class="td-name">{{ $data['areaName'] }}</span></td>
                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalSavings']) ? number_format($data['totalSavings'], 2) : '0.00' }}</span> 
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    
                    </div>
</body>

</html>
