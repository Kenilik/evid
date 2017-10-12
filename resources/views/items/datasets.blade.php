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
                                        <th></th>
                                        <th></th>
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
                                        <td>{{ $dataset['target_name'] }}</td>
                                        <td>{{ $dataset['created_at'] }}</td>
                                        <td>
                                            <a roll="button" href="{{ url('/datasets/' . $dataset['id']) }}" class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            {{ Form::open(array('url' => 'datasets/' . $dataset['id'])) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-sm')) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ Form::open(array('url' => 'datasets/create')) }}
                                {{ Form::hidden('investigation_id', $investigation->id) }}
                                {{ Form::submit('Upload New Dataset', array('class' => 'btn btn-success')) }}
                            {{ Form::close() }}
                            {{--<a roll="button" type="submit" href="{{ url('/datasets/create/' . $investigation->id) }}" class="btn btn-success">
                                Upload New Dataset
                            </a> --}}

                        @endslot
                    @endcomponent
