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
                                        <h3>COLLECTION REPORT</h4>                                        
                                    </th>
                                    <th colspan="5" style="text-align: right;">                                      
                                        <h4>From {{ $datestart }} To {{ $dateend }}</h4>
                                    </th>
                                </tr>
                                <tr style=" border-bottom: 1px solid #000000;">            
                                    <th>Area</th>
                                    <th>Field Officer</th>
                                    <th  style="text-align: right;">Total Collection</th>
                                    <th  style="text-align: right;">Total Savings</th>
                                    <th  style="text-align: right;">Total Lapses</th>
                                    <th  style="text-align: right;">Total Advances</th>
                                    <th  style="text-align: right;">Cash Remitted</th>
                                    <th  style="text-align: center;">Total NP</th>                                                             
                                </tr>
                            </thead>
                            <tbody>
                            @if($data)
                                @foreach($data as $d)
                                <tr>

                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ $d->Area }}</span></td>

                                    <td><span class="td-name">{{ $d->fieldOfficer->full_name }}</span></td>
                                
                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($d['totalCollection']) ? number_format($d['totalCollection'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($d['totalSavings']) ? number_format($d['totalSavings'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($d['totalLapses']) ? number_format($d['totalLapses'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($d['totalAdvance']) ? number_format($d['totalAdvance'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($d['cashRemit']) ? number_format($d['cashRemit'], 2) : '0.00' }}</span>
                                    </td>

                                    <td  style="text-align: center;">
                                        <span class="td-name">{{ !empty($d['totalNP']) ? $d['totalNP'] : 0 }}</span>
                                    </td>

                                </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    
                    </div>
</body>

</html>
