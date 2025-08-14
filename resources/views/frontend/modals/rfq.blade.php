<div class="modal fade" id="rfq" tabindex="-1" aria-labelledby="rfqLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="rfqLabel">
                    Request for Quotation
                    <br>
                    <small>
                        Please fill in the following information.
                        Someone from our team will reach out to you shortly.
                    </small>
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body">

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}


                <form action="#" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <strong>Name</strong>
                                <input type="text" name="customer_name" class="form-control form-control-lg"
                                    placeholder="Personal or Company Name">
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <strong>Phone</strong>
                                <input type="number" name="customer_phone" class="form-control form-control-lg"
                                    placeholder="Phone number">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Email</strong>
                                <input type="email" name="customer_email" class="form-control form-control-lg"
                                    placeholder="your prefered email address">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <br>
                    </div>

                    <div class="row d-none">
                        <div class="col-md-12">
                            <h4>
                                Please select the service(s) you wish to get from us below.
                            </h4>
                        </div>
                        {{-- @foreach ($data['services'] as $service)
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox custom-control-lg">
                                    <input type="checkbox" class="custom-control-input  custom-control-lg"
                                        name="services[]" id="customCheck{{ $service->id }}"
                                        value="{{ $service->id }}">
                                    <label class="custom-control-label  custom-control-lg"
                                        for="customCheck{{ $service->id }}">
                                        {{ $service->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach --}}
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                {{-- <button type="submit" class="btn btn-primary">
                    Send message
                </button> --}}
            </div>

            </form>
        </div>
    </div>
</div>
