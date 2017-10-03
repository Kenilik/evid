@component('widgets.panel')
    @slot('panelTitle', 'Conversation Timeline')
    @slot('panelBody')
    <div style="text-align:center;">
        {{ $items->links() }}
        <input id="sItems" name="sItems" type="hidden">
    </div>
        <ul class="timeline">
            @forelse($items as $item)
                @if ($item->is_init_by_target == 0)
                    <li>
                @else
                    <li class="timeline-inverted">
                @endif
                    @if ($item->item_type_id == 1)
                        <div class="timeline-badge info"><i class="fa fa-comments-o"></i></div>
                    @elseif ($item->item_type_id == 2)
                        <div class="timeline-badge warning"><i class="fa fa-phone"></i></div>
                    @endif
                    <div class="timeline-panel" data-key="{{ $item->id }}">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">From: {{ $item->from_contact['name'] }} To: {{ $item->to_contact['name'] }}</h4>
                            <table style="width:100%">
                                <tr>
                                    <td align="left">
                                        <small class="text-muted">From: {{ $item->from_contact['phone_num'] }} To: {{ $item->to_contact['phone_num'] }}</small>
                                    </td>
                                    <td align="right">
                                        <small class="text-muted">
                                            <i class="fa fa-clock-o"></i> {{ $item->date_time }}
                                        </small>                                        
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="timeline-body">
                            @if ($item->item_type_id == 1)
                                <msgtext>{{ $item->text_content }}</msgtext>
                            @elseif ($item->item_type_id == 2)
                                Call Duration: {{ gmdate("H:i:s", $item->call_duration) }} ({{ $item->call_duration }} seconds)
                            @endif
                            <div class="textarea itemtags" contenteditable="true"></div>
                        </div>
                    </div>
                </li>
            @empty
                <p>There are no items to display. You need to import your data first.</p>
            @endforelse
        </ul>
    @endslot
@endcomponent
<div style="text-align:center;">
    {{ $items->links() }}
</div>