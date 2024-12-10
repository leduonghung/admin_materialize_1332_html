@if ($data['field']=='status')
<button data-field="status" data-message="{{ ($data['status']==0)?'Bạn muốn user : '.$data['name'].' kích hoạt ?':'Bạn muốn user : '.$data['name'].' Ẩn ?' }}" data-url="{{ route('admin.user.loadAjax') }}" onclick="changeActive(this,{{$data['id']}})" type="button" class="btn btn-sm waves-effect waves-light btn-rounded {{ $data['status'] ? 'btn-outline-info':'btn-outline-warning' }}">{!! $data['label'] !!} </button>
@endif
@if ($data['field']=='restore')
<tr id="row_user_{{ $data['user']->id }}">
    <td class="title">
        <a class="link" href="javascript:void(0)">
            <div class="checkbox checkbox-info">
                <input type="checkbox" class="checkBoxItem" id="checkBoxItem_{{$data['user']->id}}" name="checkItem" value="{{$data['user']->id}}" data-status="{{$data['user']->status}}">
                <label for="checkBoxItem_{{$data['user']->id}}" class=""> <span> </span> </label>
            </div>
        </a>
    </td>
    <td id="countSoftDelete"></td>
    <td>{{ $data['user']->name }}</td>
    <td>{{ $data['user']->email }}</td>
    <td>{{ $data['user']->image }}</td>
    <td>{{ $data['user']->phone }}</td>
    <td>
        <span id="changeActive_{{ $data['user']->id }}">
            <button data-title="Bạn muốn thay đổi trạng thái User: {{ $data['user']->name }}" data-field="publish" data-model="User" data-value="{{$data['user']->publish}}" data-message="{{ ($data['user']->publish==0)?'Bạn muốn user :\'' .$data['user']->name.'\' kích hoạt ?':'Bạn muốn user : \''.$data['user']->name.'\' Ẩn ?' }}" data-url="{{ route('admin.changeStatus') }}" onclick="changeStatus(this,{{$data['user']->id}})" type="button" class="btn btn-sm waves-effect waves-light btn-rounded {{ $data['user']->publish ? 'btn-outline-info':'btn-outline-warning' }}"> {!! $data['user']->isActive() !!} </button>
        </span>
    </td>
    {{-- <td>{{ $user->userCreated }}</td> --}}
    <td>
        @csrf
        <a href="{{ route('admin.user.edit', ['id'=>$data['user']->id]) }}"> <button type="button" class="btn btn-success btn-circle"><i class="ti-pencil"></i> </button></a>
       
        <a href="javascript:void(0)" id="deleteItem_{{ $data['user']->id }}" onclick="deleteItem({{ $data['user']->id }})" data-action="false" data-title="Bạn muốn xóa User: {{ $data['user']->name }}" data-message="Xóa User này có thể ảnh hưởng đến dữ liệu !" data-url="{{ route('admin.user.delete', $data['user']->id) }}"><button type="button" class="btn btn-danger btn-circle"><i class="ti-trash"></i> </button></a>
    </td>
</tr>
@endif