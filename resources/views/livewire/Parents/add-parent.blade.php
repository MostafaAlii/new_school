<div>
    <div class="col-sm-6">
        <h6 class="mb-0">
                <i class="fa fa-plus" style="color:green;" aria-hidden="true"></i> / 
            {{ trans('parents.add_parents') }} :
        </h6>
    </div>
    <br>
    <!-- Error & Success Msg -->
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif
    <!-- End Error & Success Msg -->
    <!-- Start Wizard Form -->
    <div class="stepwizard">
        <!-- Start stepwizard-row -->
        <div class="stepwizard-row setup-panel">
            <!-- Start Step 1 Father Information -->
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                <p>{{ trans('parents.Step1') }}</p>
            </div>
            <!-- End Step 1 Father Information -->
            <!-- Start Step 2 Mather Information -->
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                <p>{{ trans('parents.Step2') }}</p>
            </div>
            <!-- End Step 2 Mather Information -->
            <!-- Start Step 3 Confirm Information Information -->
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                   disabled="disabled">3</a>
                <p>{{ trans('parents.Step3') }}</p>
            </div>
            <!-- End Step 3 Confirm Information Information -->
        </div>
        <!-- End stepwizard-row -->
    </div>
    <!-- End Wizard Form -->

    @include('livewire.Parents.Father_Form')
    @include('livewire.Parents.Mother_Form')

    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        @if ($currentStep != 3)
            <div style="display: none" class="row setup-content" id="step-3">
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br><br>
                        <h5 class="text-danger" style="font-family: 'Cairo', sans-serif;">{{ trans('parents.information_confirm_msg') }}</h5><br>
                        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                                wire:click="back(2)">{{ trans('parents.Back') }}</button>
                        <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                                type="button">{{ trans('parents.Finish') }}</button>
                    </div>
                </div>
            </div>
    </div>

</div>