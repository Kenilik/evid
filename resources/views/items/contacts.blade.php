@component('widgets.panel')
    @slot('panelTitle', 'Contacts')
    @slot('panelBody')
        <input id="sContacts" name="sContacts" type="hidden" value="{{ implode(',', $aCriteria['sContacts']) }}">
        <table id="tblContacts" class="table table-striped">
            <thead>
                <tr>
                    <th>Phone Num</th>
                    <th>Name</th>
                    <th>Msg Sent</th>
                    <th>Msg Rec</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr data-key="{{ $contact->id }}" 
                            @if (in_array($contact->id, $aCriteria['sContacts']) == true)
                                class="selected"
                            @endif
                    >
                        <td>{{ $contact->phone_num }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->from_items_count }}</td>
                        <td>{{ $contact->to_items_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endslot
@endcomponent
