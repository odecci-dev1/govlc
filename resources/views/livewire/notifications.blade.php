<div class="div-noti-container" id="div-noti-container">
    <table style="font-size: 1.4rem;">
        @if(!empty($notifications))
            <tr>
                <th></th>
            </tr>
            @foreach($notifications as $notification)
            <tr>
                <td>
                    <span wire:click.prevent="viewNotification({{ $notification->Id }})">
                        {{ $notification->Actions }}
                    </span>
                </td>
                {{-- <td onclick="markNotification({{ $notification->Id }})"> --}}
                <td wire:click="markAsRead({{ $notification->Id }})">
                    Mark as Read
                </td>
            </tr>
             @endforeach
        @endif
    </table>
</div>