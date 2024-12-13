<!-- Form with Image Modal -->
<div class="modal-onboarding modal fade animate__animated" id="onboardImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
              <h4 class="modal-title">{{ __('messages.domain_extension.create') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form  id="form_domain_extension" class="browser-default-validation" method="POST" action="{{ route('admin.domain.extension.store') }}">
                <div class="modal-body p-0">
                    @csrf
                    <div class="onboarding-content mb-0 ">
                        <div class="mb-6">
                            <label for="domain_extension_name" class="form-label">{{ __('messages.domain_extension.fields.name') }}</label>
                            <input type="text" name="domain_extension_name" class="form-control form-control-lg" id="domain_extension_name" placeholder="Enter {{ __('messages.domain_extension.fields.name') }}" data-url="{{ route('admin.request.dotDomain') }}"/>
                          </div>

                            <div class="mb-6">
                                <label for="domain_extension_description">{{ __('messages.domain_extension.fields.description') }}</label>
                                <textarea name="description" id="domain_extension_description" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="mb-6">
                                <label for="domain_extension_order">{{ __('messages.domain_extension.fields.order') }}</label>
                                <input name="order" class="form-control" placeholder="Enter your full order..." type="number" value="" tabindex="0" id="domain_extension_order" />
                            </div>
                              <label class="switch switch-primary">
                                  <input name="publish" type="checkbox" class="switch-input" checked
                                      id="domain_extension_publish" />
                                  <span class="switch-toggle-slider">
                                      <span class="switch-on">
                                          <i class="ri-check-line"></i>
                                      </span>
                                      <span class="switch-off">
                                          <i class="ri-close-line"></i>
                                      </span>
                                  </span>
                                  <span class="switch-label domain_extension_publish">Kích hoạt</span>
                              </label>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Close </button>
                    <button type="submit" class="btn btn-primary" id="btn_form_domain_extension" data-dismiss="modal">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/ Form with Image Modal -->
