<div class="div-noti-container" id="div-noti-container">
    <table style="font-size: 1.4rem;">
        @if(!empty($noti))
            <tr>
                <th></th>
            </tr>
            @foreach($noti as $mnoti)
            <tr>
                <td><a href="{{ route('viewNotification', ['reference' => $mnoti['reference'], 'id' => $mnoti['id'] ]) }}">{{ $mnoti['actions'] }}</a></td>
                <td onclick="markNoti('{{ $mnoti['id'] }}')">mark as read</td>
            </tr>
             @endforeach
        @endif
    </table>
</div>
