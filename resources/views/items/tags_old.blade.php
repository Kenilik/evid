@component('widgets.panel')
    @slot('panelTitle', 'Tags')
    @slot('panelBody')
        <table id="tblTags" class="table table-striped">
            <thead>
                <tr>
                    <th>Tag</th>
                </tr>
            </thead>
            <tbody>
                @forelse($taglist as $tag)
                <tr data-key="{{ $tag->id }}">
                    <td>{{ $tag->name }}</td>
                </tr>
                @empty
                    <p>There are no tags to display. Click here to create some.</p>
                @endforelse
            </tbody>
        </table>
    @endslot
@endcomponent