<div class="contact-info row">
    <div class="col-sm-3 pull-left hidden-sm-down">
        <div class="card-body">
            <h3 class="card-title">Thông tin liên hệ</h3>
            <p class="card-text">- Nhập thông tin liên hệ của người sử dụng</p>
        </div>
    </div>
    
    <div class="col-sm-9 card pull-right">
        <div class="card-body row">
            
            <div class="form-group col-sm-6">
                <h5>{{ $data['fields']['province_id'] }} {{-- <span class="text-danger">(*)</span> --}}</h5>
                <div class="controls">
                    <select name="province_id" id="province_id" class="select2 selectpicker location" style="width: 100%; height:36px;" data-target="district">
                        <option></option>
                        @if (isset($data['provinces']))
                            @foreach ($data['provinces'] as $province)
                            <option {{ old('province_id', isset($data['user']->province_id) && $data['user']->province_id == $province['code'] ) ? 'selected':'' }} value="{{ $province['code'] }}">{{ $province['full_name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <h5>{{ $data['fields']['district_id'] }} {{-- <span class="text-danger">(*)</span> --}}</h5>
                <div class="controls">
                    <select name="district_id" id="district_id" class="select2 selectpicker location" style="width: 100%; height:36px;"  @if ($create && !old('district_id')) disabled @endif  data-target="ward" @if (old('district_id',!isset($data['user']->district_id)) ) disabled @endif>
                        <option></option>
                        @if (isset($data['districts']['districts']))
                            @foreach ($data['districts']['districts'] as $district)
                            <option {{ old('district_id', !$create && $data['user']->district_id == $district['code'] ) ? 'selected':'' }} value="{{ $district['code'] }}">{{ $district['full_name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <h5>{{ $data['fields']['ward_id'] }} {{-- <span class="text-danger">(*)</span> --}}</h5>
                <div class="controls">
                    <select name="ward_id" id="ward_id" class="select2 selectpicker" style="width: 100%; height:36px;" @if ( $create || !isset($data['user']->ward_id)) disabled @endif>
                        <option></option>
                        @if (isset($data['wards']['wards']))
                            @foreach ($data['wards']['wards'] as $ward)
                            <option {{ old('province_id', !$create && $data['user']->ward_id == $ward['code'] ) ? 'selected':'' }} value="{{ $ward['code'] }}">{{ $ward['full_name'] }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <h5>{{ $data['fields']['address'] }} <span class="text-danger">(*)</span></h5>
                <div class="controls">
                    <input type="text" name="address" value="{{ old('address',$data['user']->address ?? null) }}" class="form-control">
                </div>
            </div>
            <div class="form-group col-sm-6">
                <h5>{{__('messages.content') }} </h5>
                <textarea name="description" class="form-control" id="editor" rows="3" placeholder="Message">{{ old('description',$data['user']->description ?? null) }}</textarea>
            </div>

            <div class="form-group col-sm-6">
                <h5>{{ $data['fields']['phone'] }} <span class="text-danger">(*)</span></h5>
                <div class="controls">
                    <input type="text" name="phone" value="{{ old('phone',$data['user']->phone ?? null) }}" class="form-control" >
                </div>
            </div>
            
            <div class="form-group col-sm-12 row">
                <div class="form-group col-sm-6">
                    <h5>{{ $data['fields']['status'] }}</h5>
                    <div class="controls switchery-demo m-b-30">
                        <input name="status" checked type="checkbox" class="js-switch" data-color="#26c6da" data-secondary-color="#f62d51" />
                    </div>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="submit" class="btn btn-info"> @if ($segment==='create') Thêm mới @else Chỉnh sửa @endif</button>
                    <button type="reset" class="btn btn-inverse">Reset</button>
                </div>
            </div>
            
        </div>
    </div>
</div>