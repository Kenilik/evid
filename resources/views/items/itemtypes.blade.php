@component('widgets.panel')
    @slot('panelTitle', 'Item Types')
    @slot('panelBody')
        <div class="input-group">
            <label class="checkbox-inline">
                <input type="checkbox" name="sMsg" {{ $aCriteria['sMsg'] }} >Text Messages
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="sCall" {{ $aCriteria['sCall'] }} >Phone Calls
            </label>
        </div>
    @endslot
@endcomponent