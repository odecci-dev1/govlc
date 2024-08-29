<div class="div-noti-container" id="div-noti-container">
    <table style="font-size: 1.4rem;">
        @if(!empty($noti))
            <tr>
                <th></th>
            </tr>
            @foreach($noti as $notification)
            <tr x-data="{ notiid: {{ $notification->id }} }">
                <td>
                    <a href="{{ route('viewNotification', [$notification->Reference, $notification->Id]) }}">
                        {{ $notification->Actions }}
                    </a>
                </td>
                {{-- <td onclick="markNotification({{ $notification->Id }})"> --}}
                <td>
                    <a style="" href="{{ route('markNotification', $notification->Id) }}">
                        Mark as Read
                    </a>
                </td>
            </tr>
             @endforeach
        @endif
    </table>
</div>