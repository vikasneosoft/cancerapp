@extends('doctor.layout')
@section('title')
    Inquiry Detail
@endsection
@section('doctor-css')
@endsection
@section('doctor-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Inquiry Detail</h1>
            <p>@include('flash::message')</p>
            <ol class="breadcrumb">
                <li><a href="{{ route('doctor.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="invoice">

            <div class="row invoice-info">
                <div class="col-sm-3 invoice-col text-center">
                    <b>Address</b>
                    <address>
                        Name : {{ $inquiry['name'] }}<br>
                        Address: {{ $inquiry['address'] }}<br>
                        City: {{ $inquiry['city'] }}<br>
                        State : {{ $inquiry['state'] }}<br>
                        Zip Code: {{ $inquiry['pincode'] }} <br>
                        Phone: {{ $inquiry['contact_number'] }}<br>
                        Email: {{ $inquiry['email'] }}<br>
                    </address>
                </div>
                <div class="col-sm-3 invoice-col text-center">
                    <b>Address</b>
                    <address>
                        @foreach ($inquiry['plans'] as $key => $value)
                            <a href="{{ route('doctor.printPlan', ['id' => $value['id']]) }}">Plan -
                                {{ $key + 1 }}</a>

                        @endforeach
                    </address>
                </div>

            </div>

            <div class="row">

                <div class="offset-md-1 col-xs-6">
                    {{ Form::open(['method' => 'POST', 'id' => 'add-form']) }}
                    <input type="hidden" name="cancer_inquiry_id" value={{ $inquiry['id'] }} />
                    <input type="hidden" name="name" value={{ $inquiry['name'] }} />
                    <input type="hidden" name="email" value={{ $inquiry['email'] }} />
                    <div class="form-group">
                        {{ Form::label('content', 'Content: ', ['class' => 'control-label']) }} <span
                            class="star">*</span>
                        {{ Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control']) }}

                        <label class="help-block text-danger"></label>
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </section>

        <div class="clearfix"></div>
    </div>
@endsection
<!-- /.content-wrapper -->

@section('doctor-js')
    <script src="{{ asset('public/common/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/common/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadMethod: 'form',
            filebrowserUploadUrl: '/public/ckeditor/kcfinder/upload.php?opener=TESTckeditor&type=files',
            filebrowserImageUploadUrl: '/public/ckeditor/kcfinder/upload.php?opener=REstckeditor&type=images'
        });

    </script>
    <script>
        $(document).ready(function() {
            $("#add-form").validate({
                rules: {
                    content: {
                        required: true,
                    },
                },
                messages: {
                    content: {
                        required: "Content is required.",
                    }
                },
                errorElement: 'span',
                errorClass: 'error_msg errormsges',
                submitHandler: function(form) {
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        data: $('#add-form').serialize(),
                        url: "{{ route('doctor.addPlan') }}",
                        beforeSend: function() {
                            $("#loadingImage").css("display", "block");
                        },
                        success: function(data) {
                            $("#loadingImage").hide();
                            window.location.href =
                                "{{ route('doctor.dashboard') }}";
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $("#loadingImage").css("display", "none");
                            $.each(xhr.responseJSON.errors, function(i, obj) {
                                $('textarea[name="' + i + '"]').closest(
                                    '.form-group').addClass('has-error');
                                $('textarea[name="' + i + '"]').closest(
                                        '.form-group').find('label.help-block')
                                    .slideDown(400).html(obj);
                            });
                        }
                    });
                }
            });
        });

    </script>

@endsection
