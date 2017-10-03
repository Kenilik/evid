@component('widgets.panel')
    @slot('panelTitle', 'Tags')
    @slot('panelBody')
        <table id="tblTags" class="table table-striped">
            <thead>
                <tr>
                    <th>Tag</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr data-key="1">
                    <td>Tag1</td>
                    <td>Tag 1 Description</td>
                </tr>
                <tr data-key="2">
                    <td>Tag2</td>
                    <td>Tag 2 Description</td>
                </tr>
            </tbody>
        </table>
    @endslot
@endcomponent
