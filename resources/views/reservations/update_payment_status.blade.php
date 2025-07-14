<form class="global-ajax-form" data-modal-form="#modal" action="{{ route('reservations.store') }}" method="POST"
    enctype="multipart/form-data" data-redirect-url="{{ route('reservations.index') }}">

    <h1>Update Payment Status</h1>

<!-- Display roles or any other necessary data -->
<ul>
    @foreach ($roles as $role)
        <li>{{ $role->name }}</li> <!-- Adjust based on your role model -->
    @endforeach
</ul>
</form>


<script>
var u = document.querySelector("#kt_modal_create_campaign_budget_slider"),
    m = document.querySelector("#kt_modal_create_campaign_budget_label");

noUiSlider.create(u, {
    start: [0], // Start at 0%
    connect: true,
    range: {
        min: 0, // Minimum percentage
        max: 100 // Maximum percentage
    }
});

// Update the label with the slider's value
u.noUiSlider.on("update", function(e, t) {
    m.innerHTML = Math.round(e[t]) + '%'; // Display the value as a percentage
    $('input[name="discount_percent"]').val(Math.round(e[t]));
});
</script>