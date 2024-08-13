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
                                        <h3>PAST DUE REPORT</h4>                                        
                                    </th>
                                    <th colspan="6" style="text-align: right;">                                      
                                        <h4>From {{ $datestart == NUll ? '____' : $datestart }} To {{ $dateend }}</h4>
                                    </th>
                                </tr>
                                <tr style=" border-bottom: 1px solid #000000;">                                                                                 
                                    <th style="text-align: left;">Member Name</th>      
                                    <th style="text-align: left;">Loan Amount</th>      
                                    <th>Date Released</th>                                   
                                    <th>Due Date</th>                           
                                    <th  style="text-align: center;">Total NP</th>    
                                    <th  style="text-align: center;">Total Past Due Day(s)</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                            @if($data)
                                @foreach($data as $d)
                                <tr>
                                    <td><span class="td-name">{{ $d->member->full_name }}</span></td>
                                    <td style="text-align: left;">
                                        <span class="td-name">{{ !empty($d->LoanAmount) ? number_format($d->LoanAmount, 2) : '0.00' }}</span>
                                    </td>
                                    <td style="text-align: left;"><span class="td-name">{{ !empty($d->DateReleased) ? date('Y-m-d', strtotime($d->DateReleased)) : '' }}</span></td>
                                    <td style="text-align: left;"><span class="td-name">{{ !empty($d->DueDate) ? date('Y-m-d', strtotime($d->DueDate)) : '' }}</span></td>
                                    <td style="text-align: center;">
                                        <span class="td-name">
                                            {{ optional($d->collectionareamember)->CollectedAmount == 0.00 
                                                ? '0.00' 
                                                : optional($d->collectionareamember)->CollectedAmount }}
                                        </span>
                                    </td>
                                    
                                    <td style="text-align: center;">
                                        <span class="td-name">{{ $d->pastDueDays() }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    
                    </div>
</body>

</html>
