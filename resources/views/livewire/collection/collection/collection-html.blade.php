<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gold One Victory Lending App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <style>
        
    </style>
    @livewireStyles
</head>

<body>
    <livewire:collection.collection.collection-print :areaID="request()->route('areaID')" :areaRefNo="request()->route('areaRefNo')"/>
    @livewireScripts  
</body>

</html>
