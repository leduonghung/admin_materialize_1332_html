<div class="general-info row">
    <div class="col-sm-3 pull-left hidden-sm-down">
        <div class="card-body">
            <h3 class="card-title">Thông tin chung</h3>
            <p class="card-text">- Nhập thông tin chung của người sử dụng</p>
            <p class="card-text">- Lưu ý : Những trường đánh dấu <span class="text-danger">(*)</span> bắt buộc phải nhập</p>
            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
    </div>
    
    <div class="col-sm-9 card pull-right">
        <div class="card-body row">
            <div class="form-group col-sm-6">
                <h5>{{ $data['fields']['email'] }} <span class="text-danger">(*)</span></h5>
                <div class="controls">
                    <input type="email" value="{{ old('email',$data['user']->email ?? null) }}" name="email" class="form-control @error('email') form-control-danger @enderror" required data-validation-required-message="This field is required">
                </div>
            </div>

            <div class="form-group col-sm-6">
                <h5>{{ $data['fields']['name'] }} <span class="text-danger">(*)</span></h5>
                <div class="controls">
                    <input type="text" name="name" value="{{ old('name',$data['user']->name ?? null) }}" class="form-control" required data-validation-required-message="This field is required"> 
                    {{-- <x-elements.input name="name" value="{{ old('name') }}" required="true" ></x-elements.input> --}}
                </div>
            </div>
            @if ($create)
            <div class="form-group col-sm-6">
                <h5>{{ $data['fields']['password'] }} <span class="text-danger">(*)</span></h5>
                <div class="controls">
                    <input type="password" name="password" class="form-control @error('password') form-control-danger @enderror" required data-validation-required-message="This field is required">
                </div>
            </div>

            <div class="form-group col-sm-6 @error('re_password') has-danger @enderror">
                <h5>{{ $data['fields']['re_password'] }} <span class="text-danger">(*)</span></h5>
                <div class="controls">
                    <input type="password" name="re_password" class="form-control @error('re_password') form-control-danger @enderror" required data-validation-required-message="This field is required">
                </div>
                @error('re_password') 
                <small class="form-control-feedback">{{ $message }}</small>
                @enderror
                
            </div>
            @endif
            <div class="row col-sm-12">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h5>{{ $data['fields']['birthday'] }} </h5>
                        <div class="controls">
                            <input type="date" name="birthday" value="{{ old('birthday', $data['user']->birthday ?? null) }}" class="form-control" >
                        </div>
                    </div>
                    {{-- {{ dd($data['roleOfUser']) }} --}}
                    <div class="form-group">
                        <h5>{{__('messages.user.role') }}<span class="text-danger">(*)</span></h5>
                        <div class="controls">
                            <select name="role_id[]" id="role_id" class="select2 selectpicker" style="width: 100%; height:36px;" multiple="true" data-placeholder="Chọn vai trò user">
                                <option></option>
                                @if (isset($data['roles']))
                                    @foreach ($data['roles'] as $key => $role)
                                    <option {{ (old('role_id', optional($data['roleOfUser'])->contains('id',$key)) == $key) ? 'selected': null }} value="{{ $key }}">{{ $role }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <h5>{{__('messages.image') }}</h5>
                    <div class="controls text-center">
                        <span class="img img-cover img-target"><img src="{{ old('image',isset($data['user']->image) ? asset($data['user']->image): asset('backend/images/not-found.jpg')) }} " alt="image sa" style="max-height: 200px;"></span>
                        <input type="hidden" value="{{ old('image',$data['user']->image ?? null) }}" name="image" class="form-control upload-image upload-image-avartar @error('canonical') form-control-danger @enderror">
                        
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</div>