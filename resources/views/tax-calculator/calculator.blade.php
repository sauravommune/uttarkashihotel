<style>
	/* Modal Styling */
	.calculator-modal {
		position: fixed;
		bottom: 80px;
		right: 20px;
		width: 400px;
		background-color: #fff;
		border-radius: 10px;
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
		overflow: hidden;
		visibility: hidden;
		transform-origin: bottom right;
		z-index: 1050;
	}

	.calculator-modal.animate {
		visibility: visible;
		animation: genieEffect 0.5s ease-in-out forwards;
	}

	.calculator-modal.animate-out {
		visibility: visible;
		animation: genieEffectOut 0.5s ease-in-out forwards;
	}

	@keyframes genieEffect {
		0% {
			transform: translateY(100%) scaleY(0);
			opacity: 0;
		}
		40% {
			transform: translateY(-10%) scaleY(1.1);
			opacity: 0.7;
		}
		60% {
			transform: translateY(5%) scaleY(0.95);
			opacity: 0.8;
		}
		80% {
			transform: translateY(-2%) scaleY(1.02);
			opacity: 0.9;
		}
		100% {
			transform: translateY(0) scaleY(1);
			opacity: 1;
		}
	}

	@keyframes genieEffectOut {
		0% {
			transform: translateY(0) scaleY(1);
			opacity: 1;
		}
		20% {
			transform: translateY(-2%) scaleY(1.02);
			opacity: 0.9;
		}
		40% {
			transform: translateY(5%) scaleY(0.95);
			opacity: 0.8;
		}
		60% {
			transform: translateY(-10%) scaleY(1.1);
			opacity: 0.7;
		}
		100% {
			transform: translateY(100%) scaleY(0);
			opacity: 0;
		}
	}

	.calculator-modal-header {
		color: white;
		padding: 0px 15px;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.calculator-modal-body {
		padding: 15px;
	}

	/* Sticky Button */
	.sticky-calculator {
		position: fixed;
		bottom: 20px;
		right: 30px;
		z-index: 1060;
	}

	@media (max-width: 600px) {
		.calculator-modal {
			width: 90%;
		}
		.sticky-calculator{
			right: 10px;
			bottom: 10px;
		}
	}

	.sticky-calculator button {
		width: 50px;
		height: 50px;
		display: flex;
		align-items: center;
		justify-content: center;
		background-color: #007bff;
		color: white;
		font-size: 24px;
		border: none;
		border-radius: 50%;
		transition: transform 0.3s, box-shadow 0.3s;
	}

	.sticky-calculator button:hover {
		transform: scale(1.1);
		box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
	}

	[readonly] {
		background-color: #f8f9fa !important;
	}

	#calculator-form .col-form-label{
		padding-bottom : 0.5rem !important;
	}
</style>

<!-- Sticky Button -->
<div class="sticky-calculator">
	<button id="calculatorButton" class="btn btn-primary rounded-circle shadow calculatorButton">
		<span class="material-symbols-outlined">calculate</span>
	</button>
</div>

<!-- Modal -->
<div id="calculatorModal" class="calculator-modal">
	<div class="calculator-modal-header bg-hottel">
		<span class="title">Tax Calculator</span>
		<button id="minimizeButton" class="btn btn-icon btn-sm btn-outline-light calculatorButton">
			<span class="material-symbols-outlined text-white">close</span>
		</button>
	</div>
	<div class="calculator-modal-body">
		@php
			$taxCalculator = $taxCalculator ?? null;
		@endphp
		<form id="calculator-form" method="POST" action="{{ Route('tax-calculator.store') }}" class="calculator-form" novalidate>
			<input type="hidden" name="id" value="{{ $taxCalculator?->id }}">
			<div class="row mb-2">
				<label for="calc_client_payment" class="col-sm-4 col-form-label">Client Payment</label>
				<div class="col-sm-8">
					<input type="number" class="form-control form-control-sm" name="calc_client_payment" id="calc_client_payment" min="0" placeholder="Received from Client" required value="{{ $taxCalculator?->calc_client_payment }}" />
				</div>
			</div>
			<div class="row mb-2">
				<label for="calc_vendor_payment" class="col-sm-4 col-form-label">Vendor Payment</label>
				<div class="col-sm-8">
					<input type="number" class="form-control form-control-sm" name="calc_vendor_payment" id="calc_vendor_payment" min="0" placeholder="Paid to Vendor" required value="{{ $taxCalculator?->calc_vendor_payment }}" />
				</div>
			</div>
			<div class="row mb-2">
				<label for="calc_markup" class="col-sm-4 col-form-label">Markup</label>
				<div class="col-sm-8">
					<input type="number" class="form-control form-control-sm" name="calc_markup" id="calc_markup" readonly value="{{ $taxCalculator?->calc_markup }}" />
				</div>
			</div>
			<div class="row mb-2">
				<label for="calc_gst" class="col-sm-4 col-form-label">GST @18%</label>
				<div class="col-sm-8">
					<input type="number" class="form-control form-control-sm" name="calc_gst" id="calc_gst" readonly value="{{ $taxCalculator?->calc_gst }}" />
				</div>
			</div>
			<div class="row mb-2">
				<label for="calc_gross_profit" class="col-sm-4 col-form-label">Gross Profit</label>
				<div class="col-sm-8">
					<input type="number" class="form-control form-control-sm" name="calc_gross_profit" id="calc_gross_profit" readonly value="{{ $taxCalculator?->calc_gross_profit }}" />
				</div>
			</div>
			<div class="row mb-2">
				<label for="calc_income_tax" class="col-sm-4 col-form-label">Income Tax</label>
				<div class="col-sm-8">
					<input type="number" class="form-control form-control-sm" name="calc_income_tax" id="calc_income_tax" readonly value="{{ $taxCalculator?->calc_income_tax }}" />
				</div>
			</div>
			<div class="row mb-2">
				<label for="calc_profit" class="col-sm-4 col-form-label">Net Profit</label>
				<div class="col-sm-8">
					<input type="number" class="form-control form-control-sm" name="calc_profit" id="calc_profit" readonly value="{{ $taxCalculator?->calc_profit }}" />
				</div>
			</div>

			<div class="text-center mt-4">
				<button type="submit" class="btn btn-sm btn-primary">Save</button>
			</div>
		</form>
	</div>
</div>

<script>
	const calculatorButtons = document.getElementsByClassName("calculatorButton");
	const calculatorModal = document.getElementById("calculatorModal");
	let isAnimating = false;

	$('body').on('click', '.calculatorButton', function(e) {
		e.preventDefault();
		if (isAnimating) return;
		isAnimating = true;

		if ($(this).attr('data-id') !== undefined && $(this).attr('data-id')) {
			$.get('{{ route('tax-calculator.show', ':id') }}'.replace(':id', $(this).attr('data-id')), function (response) {
				if( response.status == 200 ) {
					$('input[name=id]').val(response.data?.id);
					$('input[name=calc_client_payment]').val(response.data?.client_payment.toFixed(2));
					$('input[name=calc_vendor_payment]').val(response.data?.vendor_payment.toFixed(2));
					$('input[name=calc_markup]').val(response.data?.markup.toFixed(2));
					$('input[name=calc_gst]').val(response.data?.markup_gst.toFixed(2));
					$('input[name=calc_gross_profit]').val(response.data?.gross_profit.toFixed(2));
					$('input[name=calc_income_tax]').val(response.data?.income_tax.toFixed(2));
					$('input[name=calc_profit]').val(response.data?.net_profit.toFixed(2));
				}
			})
		}else{
			$('#calculator-form')[0].reset();
		}

		if (!calculatorModal.classList.contains("animate")) {
			calculatorModal.classList.remove("animate-out");
			calculatorModal.classList.add("animate");
			calculatorModal.querySelector('input[name=calc_client_payment]').focus();
		} else {
			if ($(this).attr('data-id') == undefined || !$(this).attr('data-id')) {
				calculatorModal.classList.remove("animate");
				calculatorModal.classList.add("animate-out");
			}else{
				isAnimating = false;
			}
		}
	})

	calculatorModal.addEventListener("animationend", (event) => {
		isAnimating = false;
		if (event.animationName === "genieEffectOut") {
			calculatorModal.classList.remove("animate-out");
		}
	});

	$('body').on('input', '#calculator-form input', function() {
		let clientPayment = $('input[name=calc_client_payment]').val()??0;
		let vendorPayment = $('input[name=calc_vendor_payment]').val()??0;
		let markup = clientPayment - vendorPayment;
		let markupGST = markup - (markup * (100 / 118));
		let grossProfit = markup - markupGST;
		let incomeTax = grossProfit - (grossProfit * (100 / 125));
		let netProfit = grossProfit - incomeTax;

		$('input[name=calc_markup]').val(markup.toFixed(2));
		$('input[name=calc_gst]').val(markupGST.toFixed(2));
		$('input[name=calc_gross_profit]').val(grossProfit.toFixed(2));
		$('input[name=calc_income_tax]').val(incomeTax.toFixed(2));
		$('input[name=calc_profit]').val(netProfit.toFixed(2));
	});

	$('body').on('submit', '#calculator-form', function(e) {
		e.preventDefault();
		let _this = $(this);
		let formData = new FormData(this);
		$.ajax({
			url: $(this).attr('action'),
			type: 'POST',
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			beforeSend: function() {
				_this.find('button[type=submit]').prop('disabled', true).append(btnSpinner);
			},
			complete: function() {
				_this.find('button[type=submit]').prop('disabled', false).find('.spinner-border').remove();
			},
			success: function(data) {
				globalToast({ message: data?.message, icon: 'success' });
				calculatorModal.classList.remove("animate");
				calculatorModal.classList.add("animate-out");
				_this[0].reset();
				if (window.LaravelDataTables["tax-calculator-datatable"]) {
					window.LaravelDataTables[
						"tax-calculator-datatable"
					].ajax.reload(null, false);
				}
			},
			error: function(data) {
				globalToast({ message: data?.message??data?.responseJSON?.message, icon: 'error' });
			}
		});
	});
</script>