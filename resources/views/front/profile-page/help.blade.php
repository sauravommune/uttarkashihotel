<div>
	<div class="main-card-II">
		<div class="space-box help">
			<div class="title-card">
				<div class="d-flex">
					<div class="icon">
						<span class="icon-support-agent-profile"></span>
					</div>
					<div class="text ps-2 pb-3">
						<b>Support queries</b>
					</div>
				</div>
			</div>
			<div class="custom-card">
				<div class="row g-xl-0">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 commmon-box">
						<div class="d-flex justify-content-center align-items-center info-box">
							<div class="border-right">
								<div class="d-flex align-items-center">
									<div class="icon">
										<span class="icon-headset-mic-profile"></span>
									</div>
									<div class="custom-card-text ps-2">
										Customer queries
									</div>
								</div>
								<p class="text-center pt-1"><a href="mailto:{{ config('contact-info.email') }}">{{ config('contact-info.email') }}</a></p>
							</div>
						</div>
					</div>
					{{-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 commmon-box">
						<div class="d-flex justify-content-center align-items-center info-box">
							<div class="border-right">
								<div class="d-flex align-items-center">
									<div class="icon">
										<span class="icon-stacked-email-profile"></span>
									</div>
									<div class="custom-card-text ps-2">
										Email for any query
									</div>
								</div>
								<p class="text-center pt-1"><a href="mailto:{{ config('contact-info.email') }}">{{ config('contact-info.email') }}</a></p>
							</div>
						</div>
					</div> --}}
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 commmon-box">
						<div class="d-flex justify-content-center align-items-center info-box">
							<div class="border-right">
								<div class="d-flex align-items-center">
									<div class="icon">
										<span class="icon-call-profile"></span>
									</div>
									<div class="custom-card-text ps-2">
										Number for any query
									</div>
								</div>
								<p class="text-center pt-1"><a href="tel:{{ config('contact-info.mobile_number') }}">+91 {{ config('contact-info.mobile_number') }}</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-card-II mt-4">
		<div class="space-box help">
			<div class="title-card mb-0">
				<div class="d-flex">
					<div class="icon">
						<span class="icon-account-circle-user-profile"></span>
					</div>
					<div class="text ps-2 pb-3">
						<b>Account FAQ’s</b>
					</div>
				</div>
			</div>
			<div class="custom-card accordion-section">
				<div class="accordion accordion-flush" id="accordionFlushExample">
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingOne">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
					        	How do I create an account on Hottel.in?
					      	</button>
					    </h2>
					    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
					    	<div class="accordion-body"><p>Click on the 'Sign Up' button on our homepage and fill in the required details.</p></div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingTwo">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
					        	How can I reset my password?
					        </button>
					    </h2>
					    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
					    	<div class="accordion-body">
								<p>Use the 'Forgot Password' option on the login page and follow the instructions sent to your email.</p>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingTwenty">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwenty" aria-expanded="false" aria-controls="flush-collapseTwenty">
					        	Can I view my booking history?
					      	</button>
					    </h2>
					    <div id="flush-collapseTwenty" class="accordion-collapse collapse" aria-labelledby="flush-headingTwenty" data-bs-parent="#accordionFlushExample">
					      	<div class="accordion-body"><p>Yes, log in to your account and navigate to the 'My Bookings' section.</p></div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingTwentyOne">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwentyOne" aria-expanded="false" aria-controls="flush-collapseTwentyOne">
					        	How do I update my account details?
					      	</button>
					    </h2>
					    <div id="flush-collapseTwentyOne" class="accordion-collapse collapse" aria-labelledby="flush-headingTwentyOne" data-bs-parent="#accordionFlushExample">
					      	<div class="accordion-body"><p>Go to 'Account Settings' after logging in and edit your details.</p></div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingThree">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
					        	Is my personal information secure on Hottel.in?
					      	</button>
					    </h2>
					    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
					      	<div class="accordion-body"><p>Absolutely! We use advanced encryption protocols to keep your data safe and secure.</p></div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-card-II mt-4">
		<div class="space-box help">
			<div class="title-card mb-0">
				<div class="d-flex">
					<div class="icon">
						<span class="icon-contact-mark-profile"></span>
					</div>
					<div class="text ps-2 pb-3">
						<b>Pre-booking queries</b>
					</div>
				</div>
			</div>
			<div class="custom-card accordion-section">
				<div class="accordion accordion-flush" id="accordionFlushExampleTwo">
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingFour">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
					        	1. How can I check room availability?
					      	</button>
					    </h2>
					    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExampleTwo">
					    	<div class="accordion-body">
								<p>You can check room availability by visiting our website, entering your desired dates, and viewing available options. Alternatively, you can contact our reservations team directly by phone or email.</p>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingFive">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
					        	2. What types of rooms do you offer?
					        </button>
					    </h2>
					    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExampleTwo">
					    	<div class="accordion-body">
								<p class="pb-3">We offer a variety of room types, including:</p>
								<ul>
									<li class="pb-3">Standard Rooms</li>
									<li class="pb-3">Deluxe Rooms</li>
									<li class="pb-3">Suites</li>
									<li class="pb-3">Family Rooms</li>
									<li class="pb-3">Accessible Rooms</li>
								</ul>
								<p class="pb-3">Check our website or contact us for detailed descriptions and features.</p>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingSix">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
					        	3. What amenities are included in the rooms?
					      	</button>
					    </h2>
					    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExampleTwo">
					      	<div class="accordion-body">
								<p  class="pb-3">Our rooms typically include:</p>
								<ul>
									<li class="pb-3">Free Wi-Fi</li>
									<li class="pb-3">Air conditioning/heating</li>
									<li class="pb-3">Flat-screen TV with cable channels</li>
									<li class="pb-3">Complimentary toiletries</li>
									<li class="pb-3">Tea/coffee-making facilities</li>
								</ul>
								<p>Some room types may also include additional amenities such as minibars, balconies, or kitchenettes.</p>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingTwelve">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwelve" aria-expanded="false" aria-controls="flush-collapseTwelve">
					        	4. Can I request a specific room or view?
					      	</button>
					    </h2>
					    <div id="flush-collapseTwelve" class="accordion-collapse collapse" aria-labelledby="flush-headingTwelve" data-bs-parent="#accordionFlushExampleTwo">
					      	<div class="accordion-body">
								<p  class="pb-3">Yes, you can make special requests (e.g., a room with a sea view or on a higher floor) during the booking process. While we cannot guarantee these requests, we will do our best to accommodate them.</p>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingThirteen">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThirteen" aria-expanded="false" aria-controls="flush-collapseThirteen">
					        	5. Do you offer special rates for group bookings?
					      	</button>
					    </h2>
					    <div id="flush-collapseThirteen" class="accordion-collapse collapse" aria-labelledby="flush-headingThirteen" data-bs-parent="#accordionFlushExampleTwo">
					      	<div class="accordion-body">
								<p  class="pb-3">Yes, we provide discounted rates for group bookings. Contact our reservations team with your group details, and we’ll be happy to assist.</p>
							</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-card-II mt-4">
		<div class="space-box help">
			<div class="title-card mb-0">
				<div class="d-flex">
					<div class="icon">
						<span class="icon-account-balance-wallet"></span>
					</div>
					<div class="text ps-2 pb-3">
						<b>Payment method questions</b>
					</div>
				</div>
			</div>
			<div class="custom-card accordion-section">
				<div class="accordion accordion-flush" id="accordionFlushExampleThree">
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingSeven">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
					        	1. What payment methods do you accept?
					      	</button>
					    </h2>
					    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExampleThree">
					    	<div class="accordion-body">
									<ul>
									<li  class="pb-2">We accept the following payment methods:</li>
									<li class="pb-2">Credit/Debit Cards: Visa, MasterCard, American Express, and Discover</li>
									<li class="pb-2">Online Payments: PayPal, Apple Pay, Google Pay</li>
									<li class="pb-2">Bank Transfers: For direct bookings (details provided upon request)</li>
									<li class="pb-2">Cash: Accepted at the front desk upon check-in</li>
								</ul>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingEight">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
					        	2. Can I pay online when booking?
					        </button>
					    </h2>
					    <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExampleThree">
					    	<div class="accordion-body">
								<p>Yes, we offer secure online payment options during the booking process. You can pay using a credit/debit card, PayPal, or other supported payment platforms.</p>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingNine">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
					        	3. Do you accept international payment methods?
					      	</button>
					    </h2>
					    <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExampleThree">
					      	<div class="accordion-body">
								<p>Yes, we accept major international credit cards and payment platforms like PayPal. If you have specific payment needs, please contact us in advance.</p>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingTen">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
					        	4. Can I pay at the hotel instead of online?
					      	</button>
					    </h2>
					    <div id="flush-collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExampleThree">
					      	<div class="accordion-body">
								<p>Yes, you can choose to pay at the hotel during check-in. However, a credit card may be required to guarantee your booking.</p>
							</div>
					    </div>
					</div>
					<div class="accordion-item">
					    <h2 class="accordion-header" id="flush-headingEleven">
					      	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEleven" aria-expanded="false" aria-controls="flush-collapseEleven">
					        	5. Are there any additional charges for using a specific payment method?
					      	</button>
					    </h2>
					    <div id="flush-collapseEleven" class="accordion-collapse collapse" aria-labelledby="flush-headingEleven" data-bs-parent="#accordionFlushExampleThree">
					      	<div class="accordion-body">
								<p>We do not charge additional fees for using credit cards or digital payment methods. However, your bank or payment provider may apply foreign transaction fees or other charges.</p>
							</div>
						    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>