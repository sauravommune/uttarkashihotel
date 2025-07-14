<div class="main-card">

<?//php print_r($co_traveler); die;?>
<div class="space-box">
		<div class="title-card">
			<div class="d-xl-flex justify-content-xl-between w-100">
				<div>
					<div class="profile-title">
						<h2>Personal Information</h2>
						<p>Update your information and find out how it's used.</p>
					</div>
				</div>
				<div>
					<a href="javascript:void(0);" class="btn btn-transparent mt-xl-0 mt-3 update-profile-edit" title="Edit" data-form=".profile-update-form">
						<div class="d-flex">
							<div> <span class="icon-edit"></span> </div>
							<div class="text ps-2">Edit</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="form-part">
			<form action="{{route('update.profile')}}" method="post" class="global-ajax-form profile-update-form">
				@csrf()
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section">
						<div class="box">
							<label for="name" class="form-label mail-disabled">Full Name</label>
							<input type="text" class="form-control" id="name" name="name"  value="{{Auth::user()->name}}" placeholder="Full Name" disabled>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mt-xl-0 mt-2">
						<div class="box">
							<label for="email" class="form-label mail-disabled">Email</label>
							<input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email" disabled>
							</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mt-xl-0 mt-2">
						<div class="box">
							<label for="phone" class="form-label bg-white mail-disabled">Mobile Number</label>
							<input type="text" class="form-control" id="mobile_no" name="phone" value="{{ Auth::user()->phone }}" placeholder="Mobile No" disabled>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mt-xl-4 mt-2">
						<div class="box">
							<label for="dob" class="form-label bg-white mail-disabled">DOB</label>
							<input type="text" class="form-control common-date dob" id="dob" name="dob" value="{{ Auth::user()->dob }}" placeholder="Date of Birth" >
							<div class="icon">
								<span class="icon-calendar"></span>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mt-xl-4 mt-2">
						<div class="box">
							<label for="gender" class="form-label bg-white mail-disabled">Gender</label>
							<select class="form-select" aria-label="Default select example" id="gender" name="gender" disabled>
							  	<option selected>Select Gender</option>
								<option value="male" @selected(Auth::user()->gender == 'male')>Male</option>
                                <option value="female" @selected(Auth::user()->gender == 'female')>Female</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mt-xl-4 mt-2">
						<div class="box">
							<label for="address_1" class="form-label bg-white mail-disabled">Address</label>
							<input type="text" class="form-control" id="address_1" name="address_1" placeholder="Enter Address" value="{{ Auth::user()->address_1 }}" disabled>
						</div>
					</div>
					<div class="col-12 repeat-section mt-4 d-flex justify-content-end">
						<div class="box mt-2">
							<button type="submit" class="btn btn-outline-primary update-profile-btn" style="display: none;">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="main-card mt-xl-4 mt-4">
	<div class="space-box">
		<div class="title-card">
			<div class="d-xl-flex justify-content-xl-between w-100">
				<div>
					<div class="profile-title">
						<h2>Update password</h2>
						<p>Update your password regularly to keep your account secure</p>
					</div>
				</div>
				<div>
					<a href="javascript:void(0);" class="btn btn-transparent mt-xl-0 mt-3 update-password-edit" title="Edit" data-form=".update-password-form">
						<div class="d-flex">
							<div>
								<span class="icon-edit"></span>
							</div>
							<div class="text ps-2">
								Edit
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="form-part password-change">
			<form action="{{route('update.password')}}" method="post" class="global-ajax-form update-password-form">
				@csrf
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mt-xl-0 mt-2">
						<div class="box">
							<label class="form-label  mail-disabled">Old Password</label>
							<input type="password" class="form-control" name="password" value="" placeholder="Password" disabled>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mt-xl-0 mt-2">
						<div class="box">
							<label class="form-label bg-white  mail-disabled">Password</label>
							<input type="password" class="form-control" name="new_password" value="" placeholder="New Password" disabled>
							</div>
					</div>
					
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mt-xl-0 mt-2">
						<div class="box">
							<label class="form-label bg-white  mail-disabled">Confirm Password</label>
							<input type="password" class="form-control" name="confirm_password" value="" placeholder="Confirm Password" disabled>
						</div>
					</div>
					<div class="col-12 repeat-section mt-xl-4 d-flex justify-content-end">
						<div class="box mt-xl-2 mt-3">
							<button type="submit" class="btn btn-outline-primary" id="updatePasswordBtn" style="display: none;">Update</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
{{-- <div class="main-card mt-xl-4 mt-4">
	<div class="space-box">
		<div class="title-card">
			<div class="d-xl-flex justify-content-xl-between w-100">
				<div>
					<div class="profile-title">
						<h2>Preferences</h2>
						<p>Change your language, currency and accessibility requirements.</p>
					</div>
				</div>
				<div>
					<a href="javascript:void(0);" class="btn btn-transparent mt-xl-0 mt-3" title="Edit">
						<div class="d-flex">
							<div>
								<span class="icon-edit"></span>
							</div>
							<div class="text ps-2">
								Edit
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="form-part">
			<form accept="" method="post" id="" name="">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 repeat-section">
						<div class="box">
							<label class="form-label">Currency</label>
							<select class="form-select" aria-label="Default select example">
							  	<option selected>Indian Rupee</option>
							  	<option value="1">US</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 repeat-section">
						<div class="box">
							<label class="form-label">Language</label>
							<select class="form-select" aria-label="Default select example">
							  	<option selected>Hindi</option>
							  	<option value="1">English</option>
							</select>
						</div>
					</div>
					<div class="col-12 repeat-section mt-4 d-flex justify-content-end">
						<div class="box mt-2">
							<button type="submit" class="btn btn-outline-primary" id="svaBtn" style="display: none;">Update</button>
							</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div> --}}