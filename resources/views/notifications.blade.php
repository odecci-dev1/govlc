<div class="div-noti-container" id="div-noti-container">
    <table style="font-size: 1.4rem;">
        @if(!empty($noti))
            <tr>
                <th></th>
            </tr>
            @foreach($noti as $mnoti)
            <tr>
                <td>{{ $mnoti['actions'] }}</td>
            </tr>
             @endforeach
        @endif
    </table>
</div>
