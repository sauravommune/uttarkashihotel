@php
    $tableClass = [
        'important' => 'bg-light-danger',
        'remark'    => 'bg-light-info',
        'payment'   => 'bg-light-success',
        'default'   => 'bg-light'
    ]
@endphp
<table class="table table-bordered mb-0">
    <thead class="table table-bordered mb-0 {{$tableClass[$remarks[0]->remark_type??'default']}}">
        <tr>
            <th>Description</th>
            <th>Created By</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($remarks as $remark)
        <tr>
            <td>
                <b>{{ $remark->description }}</b> <br/>
                @if( $remark->changes )
                    @foreach( $remark->changes as $key => $change )
                        <small>
                            {{ str_replace('_', ' ', $key) }} : {{ $change->old }} => {{ $change->new }}
                        </small> <br/>
                    @endforeach
                @endif
            </td>
            <td class="text-nowrap">
                <b>{{ $remark?->addedBy?->name }}</b> <br/>
                <small>{{ $remark->created_at->format('d M Y, h:i A') }}</small>
            </td>
        </tr>
        @empty
            <tr>
                <td class="text-danger text-center" colspan="2">Remarks not found!</td>
            </tr>
        @endforelse
    </tbody>
</table>
