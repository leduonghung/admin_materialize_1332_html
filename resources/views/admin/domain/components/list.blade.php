<div class="card-datatable text-nowrap">
    <table class="datatables-ajax table table-bordered" data-url="{{ route('admin.domain.resource') }}"
        data-page-length="25">
        <thead>
            <tr>
                <th></th>
                <th class="d-none"></th>
                <th class="text-center">{{ ucfirst($data['fields']['name']) }}</th>
                <th class="text-center">{{ ucfirst($data['fields']['language_id']) }}</th>
                <th class="text-center">{{ ucfirst($data['fields']['expiration_date']) }}</th>
                <th class="text-center">{{ ucfirst($data['fields']['place_registration']) }}</th>
                <th class="text-center">{{ ucfirst($data['fields']['status']) }}</th>
                <th class="text-center">{{ ucfirst($data['fields']['publish']) }}</th>
                <th class="text-center">{{ ucfirst(__('messages.created_at')) }}</th>
                <th class="text-center"> Sửa / Xóa </th>
            </tr>
        </thead>
        <tbody id="domain_items_list">
            @if ($domains && count($domains))
                @foreach ($domains as $key => $domain)
                    {{-- @dd($domain->isCheck()) --}}
                    <tr id="domain_item_{{ $domain->id }}">
                        <td></td>
                        <td class="d-none">{{ $domain->id }} </td>
                        <td @if ($domain->publish === 0) class="text-danger" @endif>
                            {{ $domain->name }}
                            <a href="javascript:void(0)" rel="noopener noreferrer"><i class="ri-information-2-line"
                                    data-bs-toggle="popover" data-bs-placement="bottom"
                                    data-bs-custom-class="popover-info" data-bs-content="{{ $domain->content }}"
                                    title="{{ $domain->name }}"></i></a>
                        </td>
                        <td>{{ $domain->language_name }}</td>
                        <td>{{ $domain->expiration_date }}</td>
                        <td>{{ $domain->place_registration }}</td>
                        <td>{!! $domain->isCheck() !!}</td>
                        <td>{!! $domain->isPublish() !!}</td>
                        <td>{{ $domain->created_at }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" data-form="#form_domain" data-modal="#domainModal" data-action="{{ route('admin.domain.update', $domain->id) }}" data-url="{{ route('admin.domain.edit', $domain->id) }}" onclick="editItem(this,{{ $domain->id }})" class="btn btn-xs btn-outline-primary btn-primary waves-effect waves-light"> <span class="tf-icons ri-edit-2-fill ri-14px"></span>&nbsp; Sửa </a> &nbsp;
                            <a href="javascript:void(0)" data-url="{{ route('admin.domain.delete', $domain->id) }}" onclick="deleteItem(this,{{ $domain->id }})" class="btn btn-xs btn-outline-danger btn-danger waves-effect waves-light"> <span class="tf-icons ri-delete-bin-6-line ri-14px"></span>&nbsp; Xóa </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>
</div>