@extends('front.layouts.app')
@section('content')

	<section class="section-11 dark-bg-back"></section>
	<section class="section-12 py-xl-5 py-3">
		<div class="container py-xl-4 py-3">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
					<div class="tab-part">
						<ul class="nav nav-tabs flex-column">
						  	<li class="nav-item">
						    	<a class="nav-link active" data-bs-toggle="tab" href="#manage-profile" title="Manage profile" data-page="profile">
									<span class="icon-account-circle-user-profile pe-2"></span>Manage profile
								</a>
						  	</li>
						  	<li class="nav-item">
						    	<a class="nav-link" data-bs-toggle="tab" href="#my-bookings" title="My Bookings" data-page="my-bookings">
									<span class="icon-my-booking-profile pe-2"></span>My Bookings
								</a>
						  	</li>
						  	{{-- <li class="nav-item">
						    	<a class="nav-link" data-bs-toggle="tab" href="#saved-hotels" title="Saved Hotels" data-page="saved-hotels">
									<span class="icon-heart pe-2"></span>Saved Hotels
								</a>
						  	</li> --}}
						  	{{-- <li class="nav-item">
						    	<a class="nav-link" data-bs-toggle="tab" href="#co-Travelers" title="Master List" data-page="co-travelers">
									<span class="icon-master-list-profile pe-2"></span>Co-Travelers
								</a>
						  	</li> --}}
						  	{{-- <li class="nav-item">
						    	<a class="nav-link" data-bs-toggle="tab" href="#payment-details" title="Payment Details" data-page="payment-details">
									<span class="icon-payment-details-profile pe-2"></span>Payment Details
								</a>
						  	</li> --}}
						  	<li class="nav-item">
						    	<a class="nav-link" data-bs-toggle="tab" href="#help" title="24x7 Help" data-page="help">
									<span class="icon-help-profile pe-2"></span>24x7 Help
								</a>
						  	</li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-9 mt-xl-0 mt-lg-0 mt-3">
					<div class="tab-content">
						<div class="tab-pane active" id="manage-profile">
							@include('front.profile-page.manage-profile')
						</div>

						<div class="tab-pane" id="my-bookings">
							@include('front.profile-page.my-bookings')
						</div>
						<div class="tab-pane" id="saved-hotels">
							@include('front.profile-page.saved-hotels')
						</div>

						{{-- <div class="tab-pane" id="co-Travelers">
							@include('front.profile-page.co-travelers')
						</div> --}}
						<div class="tab-pane " id="payment-details">
							@include('front.profile-page.payment-details')
						</div>
						<div class="tab-pane" id="help">
							@include('front.profile-page.help')
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
			$('body').on('click', '.update-profile-edit, .update-password-edit', function() {
				let _form = $(this).data('form');
				$(_form).find('[disabled]').attr('disabled-removed', true).removeAttr('disabled');
				$(_form).find('button[type=submit]').show();
			});
		});
	</script>
@endsection
