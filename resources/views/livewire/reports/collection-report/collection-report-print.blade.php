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
                                    <th>Collection Date</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                            @if($data)
                                @foreach($data as $data)
                                <tr>

                                    <!-- * Application Reference -->
                                    <td><span class="td-name">{{ $data['areaName'] }}</span></td>

                                    <td><span class="td-name">{{ $data['fieldOfficer'] }}</span></td>
                                
                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalCollection']) ? number_format($data['totalCollection'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalSavings']) ? number_format($data['totalSavings'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalLapses']) ? number_format($data['totalLapses'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['totalAdvance']) ? number_format($data['totalAdvance'], 2) : '0.00' }}</span>
                                    </td>

                                    <td style="text-align: right;">
                                        <span class="td-name">{{ !empty($data['cashRemit']) ? number_format($data['cashRemit'], 2) : '0.00' }}</span>
                                    </td>

                                    <td  style="text-align: center;">
                                        <span class="td-name">{{ !empty($data['totalNP']) ? $data['totalNP'] : 0 }}</span>
                                    </td>

                                    <td>
                                        <span class="td-name">{{ !empty($data['dateCollected']) ? date('Y-m-d', strtotime($data['dateCollected'])) : 0 }}</span>
                                    </td>

                                </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    
                    </div>
</body>

</html>
