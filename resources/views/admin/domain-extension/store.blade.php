@inject( 'response', 'Illuminate\Http\Response' )
@if ($response->status() === 201){{ $data->name }}@endif
@if ($response->status() === 200)
<tr id="domain_extension_item_{{ $data->id }}">
    <td class="dtr-control dt-checkboxes-cell" tabindex="0"><input name="domains[]" type="checkbox" class="form-check-input" value="{{ $data->id }}"></td>
    <td class="d-none">{{ $data->id }} </td>
    <td @if ($data->publish === 0) class="text-danger" @endif>
        {{ $data->name }}
       {{--  <a href="javascript:void(0)" rel="noopener noreferrer"><i class="ri-information-2-line"
                data-bs-toggle="popover" data-bs-placement="bottom"
                data-bs-custom-class="popover-info" data-bs-content="{{ $data->description }}"
                title="{{ $data->name }}"></i></a> --}}
    </td>
    <td>{!! $data->isPublish() !!}</td>
    <td>{{ $data->created_at }}</td>
    <td class="text-center">
        <a href="javascript:void(0)" data-form="#form_domain_extension" data-modal="#onboardImageModal" data-action="{{ route('admin.domain.extension.update', $data->id) }}" data-url="{{ route('admin.domain.extension.edit', $data->id) }}" onclick="editItem(this,{{ $data->id }})" class="btn btn-xs btn-outline-primary btn-primary waves-effect waves-light"> <span class="tf-icons ri-edit-2-fill ri-14px"></span>&nbsp; Sửa </a> &nbsp;
        <a href="javascript:void(0)" data-url="{{ route('admin.domain.extension.delete', $data->id) }}" onclick="deleteItem(this,{{ $data->id }})" class="btn btn-xs btn-outline-danger btn-danger waves-effect waves-light"> <span class="tf-icons ri-delete-bin-6-line ri-14px"></span>&nbsp; Xóa </a>
    </td>
</tr>`{dotname}`{{ $data->name }}
@endif