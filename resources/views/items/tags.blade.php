@component('widgets.panel')
    @slot('panelTitle', 'Tags')
    @slot('panelBody')
        <ul class="taglist ui-sortable">
            @forelse($taglist as $tag)
                <li data-key="{{ $tag->id }}">
                    {{ $tag->name }}
                </li>
            @empty
                <p>There are no tags to display. Click here to create some.</p>
            @endforelse
        </ul>
    @endslot
@endcomponent