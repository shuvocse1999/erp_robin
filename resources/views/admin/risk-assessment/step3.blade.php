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
		<div class="stepper-item mx-8 my-4 " data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
		<div class="stepper-item mx-8 my-4 current" data-kt-stepper-element="nav" data-kt-stepper-action="step">
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
	<form class="form w-lg-500px mx-auto" method="post" action="{{ url("insert3") }}" novalidate="novalidate" id="kt_stepper_example_basic_form">

		@csrf

		<div class="d-flex align-items-start">
			<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

				<button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><img src="{{ asset('public') . '/' . $category->photo }}"><br>{{ $category->danger }}</button>

				@foreach($category2 as $cat)

				<button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile{{$cat->katid}}" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><img src="{{ asset('public') . '/' . $cat->photo }}"><br>{{ $cat->danger }}</button>

				@endforeach



			</div>


			<div class="tab-content" id="v-pills-tabContent">

				<!-- First Tab (outside the loop) -->
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					@php
					$c = DB::table("kategorien_options")->where("kategorien_id", $category->katid)->first();
					@endphp

					<!-- Use array syntax for checkbox names with dynamic keys -->
					@foreach($c as $key => $value)
					<input type="checkbox" name="tabs[{{$category->katid}}][{{ $key }}]" value="on"> {{ $value }}<br><br>
					@endforeach
				</div>

				<!-- Other Tabs (in the loop) -->
				@foreach($category2 as $cat)
				<div class="tab-pane fade" id="v-pills-profile{{$cat->katid}}" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					@php
					$c = DB::table("kategorien_options")->where("kategorien_id", $cat->katid)->first();
					@endphp

					<!-- Use array syntax for checkbox names with dynamic keys -->
					@foreach($c as $key => $value)
					<input type="checkbox" name="tabs[{{$cat->katid}}][{{ $key }}]" value="on"> {{ $value }}<br><br>
					@endforeach
				</div>
				@endforeach
			</div>

		</div>




		<!--begin::Group-->
		<div class="mb-5 mt-5">
			


			<button type="submit" class="btn btn-primary">
				Continue
			</button>

		</form>



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

		{{-- <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
			Continue
		</button> --}}
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