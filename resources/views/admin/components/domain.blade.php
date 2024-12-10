<div class="modal fade" id="domainModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center" style="width: 80%;">Thêm mới Domain</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form  id="form_domain" class="needs-validation" method="POST" action="{{ route('admin.domain.store') }}">
            @csrf
        <div class="modal-body">
          
          <div class="row g-4">
                <div class="form-floating form-floating-outline col-12 mb-6">
                    <input name="name" type="text" id="domain-name" class="form-control" placeholder="" data-url="{{ route('admin.request.domain') }}" data-id=""/>
                    <label for="domain-name">{{ ucfirst($data['fields']['name']) }}</label>
                </div>
				<!-- Icons -->
				<div class="form-floating form-floating-outline col-md-6 mb-6">
					<select name="language_id" id="select2Icons-language_id" class="select2-icons form-select" data-allow-clear="true">
					<option></option>
					@foreach ($data['languages'] as $lang)
					<option value="{{ $lang->id }}" data-icon="flag-icon-{{ strtolower($lang->code) }}">{{ $lang->name }}</option>
					@endforeach
					</select>
					<label for="select2Icons-language_id">{{ ucfirst($data['fields']['language_id']) }}</label>
				</div>
				<!-- Colors -->


				<div class="form-floating form-floating-outline col-md-6 mb-6">
					<select name="domain_extension_id" id="domain_extension_id" class="select2 form-select" data-allow-clear="true">
						<option></option>
						@if (count($data['domainExtensions']) > 0)
							@foreach ($data['domainExtensions'] as $dot)
								<option value="{{ $dot->id }}">{{ $dot->name }}</option>
							@endforeach
						@endif
					</select>
					<label for="domain_extension_id">{{ ucfirst($data['fields']['domain_extension_id']) }}</label>
				</div>

				<div class="form-floating form-floating-outline col-md-6 col-12 mb-6">
					<input name="registration_date" type="text" id="bs-datepicker-autoclose" placeholder="YYYY/DD/MM" class="form-control" />
					<label for="bs-datepicker-autoclose">{{ ucfirst($data['fields']['registration_date']) }}</label>
				  </div>


				{{-- <div class="form-floating form-floating-outline col-md-6 col-12 mb-6">
					<div class="input-group input-daterange" id="bs-datepicker-daterange">
						<input name="registration_date" type="text" id="dateRangePicker" placeholder="{{ ucfirst($data['fields']['registration_date']) }}" class="form-control" />
						<label for="dateRangePicker">{{ ucfirst($data['fields']['place_registration']) }} </label>
						<span class="input-group-text">to</span>
						<input name="expiration_date" type="text" placeholder="{{ ucfirst($data['fields']['expiration_date']) }}" class="form-control" />
					</div>
					<label for="bs-datepicker-daterange" class="form-label">{{ ucfirst($data['fields']['registration_date'])  .' to '. $data['fields']['expiration_date'])  }}</label>
				</div> --}}
				<div class="form-floating form-floating-outline col-md-6 mb-6">
					<input name="year_of_extended" type="text" id="multicol-year_of_extended" class="form-control year_of_extended-mask" placeholder="" aria-label="" />
					<label for="multicol-year_of_extended">{{ ucfirst($data['fields']['year_of_extended']) }} </label>
				</div>
				<div class="form-floating form-floating-outline col-md-6 mb-6">
					<input name="place_registration" type="text" id="multicol-place_registration" class="form-control place_registration-mask" placeholder="" aria-label="" />
					<label for="multicol-place_registration">{{ ucfirst($data['fields']['place_registration']) }} </label>
				</div>
				
				<div class="form-floating form-floating-outline col-md-6 mb-6">
					<input name="order" class="form-control" placeholder="Enter your order..." type="number" value="" tabindex="0" id="domain_order" />
					<label for="domain_order">{{ ucfirst($data['fields']['order']) }}</label>
				</div>
				<div class="form-floating form-floating-outline col-md-12 mb-6">
					<textarea name="content" class="form-control" aria-label="With textarea" style="height: 100px" id="multicol-content"></textarea>
					<label for="multicol-content">{{ ucfirst($data['fields']['content']) }} </label>
				</div>

				<div class="col-sm-12 mb-6">
					<div class="text-light small fw-medium mb-4">{{ ucfirst($data['fields']['publish']) }} </div>
					<div class="switches-stacked row">
						@foreach ($data['publish'] as $p => $valp)
							<label class="switch col-sm-3">
								<input type="radio" class="switch-input" id="switch-publish-{{ $p }}" name="publish" @if ($p === 1) checked @endif value="{{ $p }}" />
								<span class="switch-toggle-slider">
									<span class="switch-on"></span>
									<span class="switch-off"></span>
								</span>
								<span class="switch-label">{{ $valp  }}</span>
							</label>
						@endforeach
					</div>
				</div>
				<div class="col-sm-12 mb-6">
					<div class="text-light small fw-medium mb-4">{{ ucfirst($data['fields']['status']) }} </div>
					<div class="switches-stacked row">
						@foreach ($data['status'] as $key => $val)
							<label class="switch col-sm-3">
								<input type="radio" class="switch-input" id="switch-status-{{ $key }}" name="status" @if ($key === 0) checked @endif value="{{ $key }}" />
								<span class="switch-toggle-slider">
									<span class="switch-on"></span>
									<span class="switch-off"></span>
								</span>
								<span class="switch-label">{{ $val }}</span>
							</label>
						@endforeach
					</div>
				</div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Thêm mới</button>
        </div>
        
        </form>
      </div>
    </div>
  </div>