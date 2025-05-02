
@php
$row = $data['row']
@endphp
<div class="p-0 table-responsive">
    <table class="table">
    <tr>
        <td class="border-top-0" style="width:25%;"><strong>{{__('messages.common.name')}} :</strong></td>
        <td class="border-top-0">{{$row->name}}</td>
    </tr>
    <tr>
        <td><strong>{{__('messages.common.email')}} :</strong></td>
        <td><a href="mailto:{{$row->email}}">{{$row->email}}</a></td>
    </tr>
    @if(!empty($row->phone))
    <tr>
        <td><strong>{{__('messages.common.phone')}} :</strong></td>
        <td><a href="tel:+{{$row->phone}}">+{{$row->phone}}</a></td>
    </tr>
    @endif

    @if(!empty($row->job_title))
    <tr>
        <td><strong>{{__('messages.common.job_title')}} :</strong></td>
        <td>{{$row->job_title}}</td>
    </tr>
    @endif

    @if(!empty($row->company_name))
    <tr>
        <td><strong>{{__('messages.common.company_name')}} :</strong></td>
        <td>{{$row->company_name}}</td>
    </tr>
    @endif
    <tr>
        <td colspan="2">
            <strong>{{__('messages.common.message')}} :</strong>
            <br>
            <br>
            {!! nl2br($row->message) !!}
        </td>
    </tr>
    </table>
</div>

