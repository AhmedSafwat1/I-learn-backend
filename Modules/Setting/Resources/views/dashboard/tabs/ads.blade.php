<div class="tab-pane fade" id="ads">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.ads') }}</h3>
    <div class="col-md-10">
       

     

      
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.match_price') }}
            </label>
            <div class="col-md-7">
                <input class="form-control" min="0" type="number" name="other[match_price]" value="{{setting('other','match_price') ?? 0 }}" />
            </div>
            <label class="col-md-2" style="color: red">
                {{ __('setting::dashboard.settings.form.note_price') }}
            </label>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.equipment_price') }}
            </label>
            <div class="col-md-7">
                <input class="form-control" min="0" type="number" name="other[equipment_price]" value="{{setting('other','equipment_price') ?? 0 }}" />
            </div>
            <label class="col-md-2" style="color: red">
                {{ __('setting::dashboard.settings.form.note_price') }}
            </label>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.match_review') }}
            </label>
            <div class="col-md-9">
                <div class="mt-radio-inline">
                    <label class="mt-radio mt-radio-outline"> Yes
                        <input type="radio" name="other[match_review]" value="1"
                        @if (setting('other','match_review') == 1)
                          checked
                        @endif>
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">
                        No
                        <input type="radio" name="other[match_review]" value="0"
                        @if (setting('other','match_review') == 0)
                          checked
                        @endif>
                        <span></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.equipment_review') }}
            </label>
            <div class="col-md-9">
                <div class="mt-radio-inline">
                    <label class="mt-radio mt-radio-outline"> Yes
                        <input type="radio" name="other[equipment_review]" value="1"
                        @if (setting('other','equipment_review') == 1)
                          checked
                        @endif>
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">
                        No
                        <input type="radio" name="other[equipment_review]" value="0"
                        @if (setting('other','equipment_review') == 0)
                          checked
                        @endif>
                        <span></span>
                    </label>
                </div>
            </div>
        </div>


      
    </div>
</div>
