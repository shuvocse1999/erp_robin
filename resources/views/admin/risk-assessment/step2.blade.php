@extends('layouts.master')
@section('content')
<!--begin::Stepper-->
<div class="stepper stepper-pills" id="kt_stepper_example_clickable">
	<!--begin::Nav-->
	<div class="stepper-nav flex-center flex-wrap mb-10">
		<!--begin::Step 1-->
		<div class="stepper-item mx-8 my-4 " data-kt-stepper-element="nav" data-kt-stepper-action="step">
			<!--begin::Wrapper-->
			<div class="stepper-wrapper d-flex align-items-center">
				<!--begin::Icon-->
				<div class="stepper-icon w-40px h-40px">
					<i class="stepper-check fas fa-check"></i>
					<span class="stepper-number">1</span>
				</div>
				<!--end::Icon-->

				<!--begin::Label-->
				<div class="stepper-label">
					<h3 class="stepper-title">
						Step 1
					</h3>
				</div>
				<!--end::Label-->
			</div>
			<!--end::Wrapper-->

			<!--begin::Line-->
			<div class="stepper-line h-40px"></div>
			<!--end::Line-->
		</div>
		<!--end::Step 1-->

		<!--begin::Step 2-->
		<div class="stepper-item mx-8 my-4 current" data-kt-stepper-element="nav" data-kt-stepper-action="step">
			<!--begin::Wrapper-->
			<div class="stepper-wrapper d-flex align-items-center">
				<!--begin::Icon-->
				<div class="stepper-icon w-40px h-40px">
					<i class="stepper-check fas fa-check"></i>
					<span class="stepper-number">2</span>
				</div>
				<!--begin::Icon-->

				<!--begin::Label-->
				<div class="stepper-label">
					<h3 class="stepper-title">
						Step 2
					</h3>
				</div>
				<!--end::Label-->
			</div>
			<div class="stepper-line h-40px"></div>
		</div>
		<!--end::Step 2-->
		<!--begin::Step 3-->
		<div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
			<!--begin::Wrapper-->
			<div class="stepper-wrapper d-flex align-items-center">
				<!--begin::Icon-->
				<div class="stepper-icon w-40px h-40px">
					<i class="stepper-check fas fa-check"></i>
					<span class="stepper-number">3</span>
				</div>
				<!--begin::Icon-->

				<!--begin::Label-->
				<div class="stepper-label">
					<h3 class="stepper-title">
						Step 3
					</h3>
				</div>
				<!--end::Label-->
			</div>
			<!--end::Wrapper-->

			<!--begin::Line-->
			<div class="stepper-line h-40px"></div>
			<!--end::Line-->
		</div>
		<!--end::Step 3-->

		<!--begin::Step 4-->
		<div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
			<!--begin::Wrapper-->
			<div class="stepper-wrapper d-flex align-items-center">
				<!--begin::Icon-->
				<div class="stepper-icon w-40px h-40px">
					<i class="stepper-check fas fa-check"></i>
					<span class="stepper-number">4</span>
				</div>
				<!--begin::Icon-->

				<!--begin::Label-->
				<div class="stepper-label">
					<h3 class="stepper-title">
						Step 4
					</h3>
				</div>
				<!--end::Label-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Step 4-->
	</div>
	<!--end::Nav-->

	<!--begin::Form-->
	<form class="form w-lg-500px mx-auto" method="post" action="{{ url("current_category") }}" novalidate="novalidate" id="kt_stepper_example_basic_form">

		@csrf

		<!--begin::Group-->
		<div class="mb-5">
			<div class="flex-column current" data-kt-stepper-element="content">
				<div class="fv-row mb-10 row p-0">
					@foreach($category as $cat)
					<div class="col-4">
						<label class="form-check-image step-2-label">
							<div class="form-check-wrapper">
								<img src="{{ asset('public') . '/' . $cat->photo }}">
							</div>

							<div class="form-check form-check-custom form-check-solid">
								<input class="form-check-input step-2" type="checkbox" value="{{$cat->id}}"
								name="category[]"/>
								<div class="form-check-label">
									{{ $cat->danger }}
								</div>
							</div>
						</label>
					</div>
					@endforeach

				</div>
			</div>


			<button type="submit" class="btn btn-primary">
				Continue
			</button>

		</form>


		<!--begin::Step 1-->
		<div class="flex-column" data-kt-stepper-element="content">
			<!--begin::Input group-->
			<div class="fv-row mb-10">
				<!--begin::Label-->
				<label class="form-label d-flex align-items-center">
					<span class="required">Input 1</span>
					<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
					title="Example tooltip"></i>
				</label>
				<!--end::Label-->
				<!--begin::Input-->
				<input type="text" class="form-control form-control-solid" name="input1" placeholder=""
				value=""/>
				<!--end::Input-->
			</div>
			<!--end::Input group-->
			<!--begin::Input group-->
			<div class="fv-row mb-10">
				<!--begin::Label-->
				<label class="form-label">
					Input 2
				</label>
				<!--end::Label-->

				<!--begin::Input-->
				<input type="text" class="form-control form-control-solid" name="input2" placeholder=""
				value=""/>
				<!--end::Input-->
			</div>
			<!--end::Input group-->

			<!--begin::Input group-->
			<div class="fv-row mb-10">
				<!--begin::Label-->
				<label class="form-label">
					Input 3
				</label>
				<!--end::Label-->

				<!--begin::Input-->
				<input type="text" class="form-control form-control-solid" name="input3" placeholder=""
				value=""/>
				<!--end::Input-->
			</div>
			<!--end::Input group-->
		</div>
		<!--begin::Step 1-->
	</div>
	<!--end::Group-->

	<!--begin::Actions-->
	<div class="d-flex flex-stack">
		<!--begin::Wrapper-->
		<div class="me-2">
			<button type="button" class="btn btn-light btn-active-light-primary"
			data-kt-stepper-action="previous">
			Back
		</button>
	</div>
	<!--end::Wrapper-->

	<!--begin::Wrapper-->
	<div>
		<button type="button" class="btn btn-primary" data-kt-stepper-action="submit">
			<span class="indicator-label">
				Submit
			</span>
			<span class="indicator-progress">
				Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
			</span>
		</button>

		<button type="button" class="btn btn-primary" data-kt-stepper-action="next">
			Continue
		</button>
	</div>
	<!--end::Wrapper-->
</div>
<!--end::Actions-->
</form>
<!--end::Form-->
</div>
<script>
	$(document).ready(function () {
		$('.step-1').on('change', function () {
			$('.step-1').not(this).prop('checked', false);
			$('.step-1-label').removeClass('active');
			if ($(this).is(':checked')) {
				$(this).closest('.step-1-label').addClass('active');
			}
		});
	});
</script>
<script>
	$(document).ready(function () {
		$('.step-2').on('change', function () {
			if ($(this).is(':checked')) {
				$(this).closest('.step-2-label').addClass('active');
			} else {
				$(this).closest('.step-2-label').removeClass('active');
			}
		});
	});
</script>

<script>
	$(document).ready(function () {
		function updateStep3Values() {
			var selectedElements = [];
			var selectedValues = [];
			$('.step-2:checked').each(function () {
				selectedElements.push($(this).closest('.step-2-label')[0].outerHTML);
				selectedValues.push($(this).closest('.step-2-label').find('.step-2').val());
			});
			$('.step-3').empty();
			$.each(selectedElements, function (index, element) {
				$('.step-3').append('<li class="nav-item w-100 me-0 mb-md-2"> <a class="nav-link w-100 btn btn-flex btn-active-light-success" data-bs-toggle="tab" href="#kt_vtab_pane_' + selectedValues[index] + '"><span class="d-flex flex-column align-items-start">' + element + '</span> </a></li>');
			});
		}
		$('.step-2').on('change', function () {
			updateStep3Values();
		});
		updateStep3Values();
	});
</script>
@endsection