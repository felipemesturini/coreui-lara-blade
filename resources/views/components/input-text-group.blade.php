<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <svg class="c-icon">
              <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
            </svg>
        </span>
    </div>
    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : ''}}"
           type="text" placeholder="{{ __('Name') }}"
           name="name" value="{{ old('name') }}"
           required autofocus>
</div>
