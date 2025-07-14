<div class="main-card" id="no-card-1">
	<div class="space-box payment-details">
		<div class="title-card">
			<div class="d-xl-flex justify-content-xl-between w-100">
				<div>
					<div class="profile-title">
						<h2>Payment Details</h2>
						<p>Securely add or remove payment methods to make it easier when you book.</p>
					</div>
				</div>
				<div>
					<a href="javascript:void(0);" id="saveBtnOne-1" class="btn btn-transparent mt-xl-0 mt-3" title="Edit">
						<div class="d-flex">
							<div class="icon pe-2">
								<span class="icon-plus"></span>
							</div>
							<div class="text">
								Add card
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="form-part">
			<div class="d-flex justify-content-center">
				<div class="img py-xl-5 py-3">
					<img data-src="{{ asset('assets/front/images/no-card-img.jpg') }}" class="lazy" width="" height="" alt="">
					<p class="text-center">No Card added</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="main-card d-none" id="add-card-1">
	<div class="space-box payment-details">
		<div class="title-card">
			<div class="d-xl-flex justify-content-xl-between w-100">
				<div>
					<div class="profile-title">
						<h2>Payment Details</h2>
						<p>Securely add or remove payment methods to make it easier when you book.</p>
					</div>
				</div>
				<div>
					<a href="javascript:void(0);" id="saveBtn-1" class="btn btn-transparent mt-xl-0 mt-3" title="Edit">
						<div class="d-flex">
							<div class="text">
								save
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="form-part">
			<form accept="" method="post" id="" name="">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  repeat-section">
						<div class="box">
							<label class="form-label">Cardholder’s Name</label>
							<input type="text" class="form-control" name="full_name" value="Admin Kumar" placeholder="Full Name">
							</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section">
						<div class="box">
							<label class="form-label">Card Number</label>
							<input type="text" class="form-control" name="full_name" value="8888 7777 7777 8888" placeholder="Email">
							</div>
					</div>
					
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section">
						<div class="box mt-0">
							<label class="form-label">&nbsp;</label>
							<input type="text" class="form-control common-date" name="expiry_date" value="Expiry Date" placeholder="Expiry Date">
								<div class="icon">
									<span class="icon-newspaper-1"></span>
								</div>
							</div>
					</div>
					<div class="col-12 mt-4">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" >
							<label class="form-check-label checkbox-label" for="flexCheckDefault">
							    I confirm that I am authorized to provide the payment card details to tourtripx.com.
							</label>
						</div>
					</div>
					<div class="col-12 mt-2">
						<div class="d-xl-flex">
							<div>
								<p>We accept Payments Via</p>
							</div>
							<div class="image ps-xl-3 pt-xl-0 pt-3">
								<img data-src="{{ asset('assets/front/images/all-payment-img.jpg') }}" class="lazy">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="main-card d-none"  id="show-card-list-1">
	<div class="space-box payment-details">
		<div class="title-card">
			<div class="d-xl-flex justify-content-xl-between w-100">
				<div>
					<div class="profile-title">
						<h2>Payment Details</h2>
						<p>Securely add or remove payment methods to make it easier when you book.</p>
					</div>
				</div>
				<div>
					<a href="javascript:void(0);" id="show-table-1" class="btn btn-transparent mt-xl-0 mt-3" title="Edit">
						<div class="d-flex">
							<div class="icon">
								<span class="icon-plus pe-2"></span>
							</div>
							<div class="text">
								Add Card
							</div>
						</div>	
					</a>
				</div>
			</div>
		</div>
		<!-- Repeat card start -->
		<div class="table-part">
			<div class="main-table">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 mb-xl-0 mb-3">
						<div class="d-flex">
							<div class="img">
								<img data-src="{{ asset('assets/front/images/small-card.jpg') }}" alt="" class="lazy" width="" height="">
							</div>
							<div class="ps-3">
								<div class="card-label">
									Full Name
								</div>
								<div class="card-name">
									Admin Kumar
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-xl-0 mb-3">
						<div >
							<div class="card-label">
								Card Number
							</div>
							<div class="card-name">
								0000 0000 0000 0002
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3  mb-xl-0 mb-3">
						<div >
							<div class="card-label">
								Expiry Date
							</div>
							<div class="card-name">
								02/12/9999
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12  col-xl-2 d-flex justify-content-xl-end  mb-xl-0 mb-0">
						<div class="d-flex">
							<div>
								<a href="javascript:void(0);" class="btn btn-transparent">
									<div class="d-flex">
										<div class="icon pe-1">
											<span class="icon-edit"></span>
										</div>
										<div class="text">
											Edit
										</div>
									</div>
								</a>
							</div>
							<div>
								<a href="javascript:void(0);" class="btn btn-transparent ms-3">
									<div class="d-flex">
										<div class="icon">
											<span class="icon-trash"></span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Repeat card end -->
	</div>
</div>	