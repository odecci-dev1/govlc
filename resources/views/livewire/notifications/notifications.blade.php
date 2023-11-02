<div>
    <div style="padding: 3rem;">
        <div class="self-notification">
            <h1>SYSTEM NOTICE</h1>
            <div style="max-height: 80rem; overflow-y: auto;">
                <table style="font-size: 1.4rem;">
                    @if($notice)
                        <tr style="visibility: hidden;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($notice as $mnotice)
                            <tr>
                                <td>{{ $mnotice['actions'] }}</td>
                                <td>{{ date('m-d-Y h:m A', strtotime($mnotice['dateCreated'])) }}</td>
                                <td>{{ $mnotice['name'] }}</td>
                                <td style="text-align: right; padding: 0.4rem 0.4rem;">
                                    <button type="button" class="button" style="padding: 0.5rem 1.5rem;">view</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
