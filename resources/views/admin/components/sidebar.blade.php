@php
    // $request = request()->get();
    // if(request()->has('language_id')) dd(request()->get('language_id'));
@endphp
{{-- {{dd(request()->route()->parameters)}} --}}
<div class="col app-email-sidebar border-end flex-grow-0" id="app-email-sidebar">
    {{-- <div class="btn-compost-wrapper d-grid">
        <button class="btn btn-primary btn-compose" data-bs-toggle="modal"
            data-bs-target="#emailComposeSidebar">
            Compose
        </button>
    </div> --}}
    <!-- Email Filters -->
    <form action="{{ route('admin.domain') }}" method="GET" id="filter-domain-component">
    <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
        <div class="p-5 my-sm-0 mb-4 border-bottom">
            <button type="submit" class="btn btn-primary btn-outline-primary btn-toggle-sidebar w-100" >
                <i class="ri-search-2-line ri-16px me-1_5"></i>
                <span class="align-middle">Tìm kiếm</span>
            </button>
        </div>
        <div class="px-4 pt-4">
            <!-- inline calendar (flatpicker) -->
            <div class="inline-calendar"></div>
            @php $colors = ['secondary','danger','warning','success','info',''] @endphp
            <!-- Filter -->
            <div class="mb-4 ms-1">
                <h5>{{ ucfirst($data['fields']['status']) }}</h5>
            </div>
{{-- 
            <div class="form-check form-check-secondary mb-5 ms-3">
                <input class="form-check-input select-status-all" type="checkbox" id="selectStatusAll" data-value="all" checked />
                <label class="form-check-label" for="selectStatusAll">View All</label>
            </div> --}}

            <div class="app-calendar-events-filter text-heading">
                @foreach ($data['status'] as $key => $val)
                <div class="form-check form-check-{{$colors[array_rand($colors)]}} mb-5 ms-3">
                    <input name="status[]" value="{{ $key }}" class="form-check-input input-filter input-filter-status" type="checkbox" id="select-status-{{ $key }}"
                        data-value="{{ $key }}" @checked($data['conditions'] && array_key_exists("status",$data['conditions']) && in_array($key , $data['conditions']['status']))/>
                        
                    <label class="form-check-label" for="select-status-{{ $key }}">{{ $val }}</label>
                </div>
                @endforeach
                
            </div>
        </div>
        <hr class="mb-5 mx-n4 mt-3" />
        <div class="px-4">
            <!-- inline calendar (flatpicker) -->
            <div class="inline-calendar"></div>
            <!-- Filter -->
            <div class="mb-4 ms-1">
                <h5>{{ ucfirst($data['fields']['publish']) }}</h5>
            </div>

            <div class="app-calendar-events-filter text-heading">

                @foreach ($data['publish'] as $p => $vp)
                <div class="form-check form-check-{{$colors[array_rand($colors)]}} mb-5 ms-3">
                    <input name="publish[]" value="{{ $p }}" class="form-check-input input-filter" type="checkbox" id="select-publish-{{ $p }}"
                        data-value="{{ $p }}" @checked($data['conditions'] && array_key_exists("publish",$data['conditions']) && in_array($p , $data['conditions']['publish']))/>
                    <label class="form-check-label" for="select-publish-{{ $p }}">{{ $vp }}</label>
                </div>
                @endforeach
                
            </div>
        </div>
        <hr class="mb-5 mx-n4 mt-3" />
        <div class="px-4">
            <!-- inline calendar (flatpicker) -->
            <div class="inline-calendar"></div>
            <!-- Filter -->
            <div class="mb-4 ms-1">
                <h5>{{ ucfirst($data['fields']['language_id']) }}</h5>
            </div>

            <div class="app-calendar-events-filter text-heading">
                <div class="form-floating form-floating-outline">
                    <select name="language_id[]" id="filter-language_id" class="select2-icons form-select" data-allow-clear="true" multiple="multiple">
                        <option></option>
                        @foreach ($data['languages'] as $lang)
					<option value="{{ $lang->id }}" data-icon="flag-icon-{{ strtolower($lang->code) }}" @selected($data['conditions'] && array_key_exists("language_id",$data['conditions']) && in_array($lang->id , $data['conditions']['language_id']))>{{ $lang->name }}</option>
					@endforeach
					</select>
					<label for="filter-language_id">{{ ucfirst($data['fields']['language_id']) }}</label>
				</div>
                
            </div>
        </div>

        <hr class="mb-5 mx-n4 mt-3" />
        <div class="px-4">
            <!-- inline calendar (flatpicker) -->
            <div class="inline-calendar"></div>
            <!-- Filter -->
            <div class="mb-4 ms-1">
                <h5>{{ ucfirst($data['fields']['domain_extension_id']) }}</h5>
            </div>

            <div class="app-calendar-events-filter text-heading">
                @if (count($data['domainExtensions']) > 0)
                @foreach ($data['domainExtensions'] as $dot)
                <div class="form-check form-check-{{$colors[array_rand($colors)]}} mb-5 ms-3">
                    <input name="domain_extension_id[]" value="{{ $dot->id }}" class="form-check-input input-filter" type="checkbox" id="select-domain_extension_id-{{ $dot->id }}"
                        data-value="{{ $dot->id }}" @checked($data['conditions'] && array_key_exists("domain_extension_id",$data['conditions']) && in_array($dot->id , $data['conditions']['domain_extension_id']))/>
                    <label class="form-check-label" for="select-domain_extension_id-{{ $dot->id }}">{{ $dot->name }}</label>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</form>
</div>
