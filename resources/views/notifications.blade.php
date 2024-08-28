<div class="div-noti-container" id="div-noti-container">
    <table style="font-size: 1.4rem;">
        @if(!empty($noti))
            <tr>
                <th></th>
            </tr>
            @foreach($noti as $notification)
            <tr>
                <td>
                    <a href="{{ route('viewNotification', $notification->Reference) }}">
                        {{ $notification->Actions }}
                    </a>
                </td>
                <td onclick="markNotification({{ $notification->Id }})">
                    mark as read
                </td>
            </tr>
             @endforeach
        @endif
    </table>
</div>
