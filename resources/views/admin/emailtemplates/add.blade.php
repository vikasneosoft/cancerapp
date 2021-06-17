@extends('admin.layout')
@section('title')
	Email Template
@endsection
@section('admin-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('admin-content')

        <section class="content-header">
			<div class="container-fluid">
			  <div class="row mb-2">
				<div class="col-sm-6">

				</div>
				<div class="col-sm-6">
				  <ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> Dashboard</a></li>
					<li class="breadcrumb-item active">Add Email Template</li>
				  </ol>
				</div>
			  </div>
			</div>
		  </section>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="offset-md-3 col-md-6">
						<div class="card card-primary">
							<div class="card-header">
							  <h3 class="card-title">Email Template</h3>
							</div>
							@if(session()->has('error'))
								<div class="alert alert-danger danger-message">
									{{ session()->get('error') }}
								</div>
							@endif
							{{ Form::open(array( 'method' => 'POST', 'route' => 'admin.addEmailTemplate', 'id'=>'add-email-template-form')) }}
								@include('admin.emailtemplates.formElements',['submitButtonText' => 'Add'])
							{{ Form::close() }}
						  </div>
					</div>
				</div>
			</div>
		</section>
@endsection
@section('admin-js')
	<script src="{{ asset('public/common/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('public/common/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'content',
            {
                filebrowserUploadMethod : 'form',
                filebrowserUploadUrl : '/public/ckeditor/kcfinder/upload.php?opener=TESTckeditor&type=files',
                filebrowserImageUploadUrl : '/public/ckeditor/kcfinder/upload.php?opener=REstckeditor&type=images'
            });
    </script>
    <script>
		$(document).ready(function() {
            $('.select-box').select2();
            $(".select-box").on("select2:select", function (e) {
                var editor = CKEDITOR.instances.content;
                let tag = $(this).val();
                editor.insertHtml( tag );

            });
			$( "#add-email-template-form" ).validate({
				rules: {
                    title: {
						required: true,
					},
                    type: {
						required: true,
					},
                    subject:{
                        required: true,
                    },
                    content: {
						required: true,
					},

				},
				messages: {
                    title: {
						required: "Title is required.",
					},
                    type: {
                        required: "Type is required.",
                    },
                    subject: {
                        required: "Subject is required.",
                    },
                    content:{
                        required: "Content is required.",
                    }
				},
				errorElement:'span',
				errorClass:'error_msg errormsges',
				submitHandler: function(form) {
                    $("#loadingImage").removeClass('d-none');
                    $("#loadingImage").addClass('d-block');
				    $('#add-email-template-form').submit();
				}
			});
		});
	</script>

@endsection
