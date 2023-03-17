@props([
'tableId' => '',
'tableClass' => '',
'columns' => []
])

<div class="table-responsive">
    <table id="{{ $tableId }}"
           class="table table-striped table-hover dt-responsive table-bordered display dataTable {{ $tableClass }}"
           style="width: 100%;"
    >
        <thead>
        <tr>
            @isset($columns)
                @foreach($columns as $column)
                    @isset($column['class'])
                        <th class="{{ $column['class'] }}">
                            {{ $column["label"] }}
                        </th>
                    @else
                        <th>{{ $column["label"] }}</th>
                    @endisset
                @endforeach
            @endisset
        </tr>
        </thead>
        <tbody>
        @isset($tableRows)
            {{ $tableRows }}
        @endisset
        </tbody>
    </table>
</div>
