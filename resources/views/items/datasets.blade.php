                    @component('widgets.panel')
                        @slot('panelTitle', 'Datasets')
                        @slot('panelBody')
                            <input id="sDataset" name="sDataset" type="hidden" value="{{ $aCriteria['sDataset'] }}">
                            <table id="tblDatasets" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Target Number</th>
                                        <th>Target Name</th>
                                        <th>Imported</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datasets as $dataset)
                                    <tr data-key="{{ $dataset['id'] }}" 
                                        @if ($aCriteria['sDataset'] == $dataset['id'])
                                            class="selected"
                                        @endif
                                    >
                                        <td>{{ $dataset['id'] }}</td>
                                        <td>{{ $dataset['description'] }}</td>
                                        <td>{{ $dataset['target_num'] }}</td>
                                        <td>{{ $dataset['target->name'] }}</td>
                                        <td>{{ $dataset['created_at'] }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endslot
                    @endcomponent
