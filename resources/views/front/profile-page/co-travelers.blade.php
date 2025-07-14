@php
use Carbon\Carbon;
@endphp
<style>
.flatpickr-calendar.open {
    z-index: 99999999!important;
}
</style>
<div class="main-card" id="no-card">
    <div class="space-box payment-details">
        <div class="title-card">
            <div class="d-xl-flex justify-content-xl-between w-100">
                <div>
                    <div class="profile-title">
                        <h2>Co-Travelers</h2>
                        <p>Add or edit information about the people you’re Traveling with.</p>
                    </div>
                </div>
                <div>
                    <a href="javascript:void(0);" id="saveBtnOne" class="btn btn-transparent mt-xl-0 mt-3" title="Edit">
                        <div class="d-flex">
                            <div class="icon pe-2">
                                <span class="icon-plus"></span>
                            </div>
                            <div class="text">
                                Add traveller
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-part">
            <div class="d-flex justify-content-center">
                @if(empty($co_traveler))
                <div class="img py-xl-5 py-3">
                    <img data-src="{{ asset('assets/front/images/no-Travelers.jpg') }}" class="lazy" width="" height=""
                        alt="">
                    <p class="text-center">No Travelers added</p>
                </div>
                @else

                <table class="table table-bordered" id="travelerTable">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach($co_traveler as $traveler)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="img">
                                        <span class="icon">
                                            {{ substr(ucwords($traveler->name), 0, 1) ?? '' }}
                                        </span>
                                    </div>
                                    <div class="ps-3">
                                      
                                        <div class="card-name">
                                            {{ ucwords($traveler->name) ?? '' }}
                                            @if($traveler->age > 12)

                                            <span class="badge ms-2 rounded-pill badge bg-secondary">Adult</span>
                                            @else
                                            <span class="badge ms-2 rounded-pill badge  bg-secondary">child</span>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="card-name">
                                    {{ $traveler->age==0 ?1: $traveler->age }}
                                </div>
                            </td>
                            <td>
                                <div class="card-name">
                                    {{ ucwords($traveler->gender) ?? 'N/A' }}
                                </div>
                            </td>

                            <td>
                                <div class="d-flex">
                                    <div>
                                        <a href="javascript:void(0);" class="btn btn-transparent p-1 px-2 edit-item" data-id="{{$traveler->id}}">
                                            <div class="d-flex">
                                                <div class="icon pe-1">
                                                    <span class="icon-edit"></span>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="btn btn-transparent p-1 px-2 ms-3 delete-traveler" data-id="{{$traveler->id}}">
                                            <div class="d-flex">
                                                <div class="icon">
                                                    <span class="icon-trash"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="main-card d-none" id="add-card">
    <div class="space-box payment-details co-ravellers">
        <div class="title-card">
            <div class="d-xl-flex justify-content-xl-between w-100">
                <div>
                    <div class="profile-title">
                        <h2>Co-Travelers </h2>
                        <p>Add or edit information about the people you’re Traveling with.</p>
                    </div>
                </div>

                <!-- <div>
                    <a href="javascript:void(0);" id="saveBtn" class="btn btn-transparent mt-xl-0 mt-3" title="Edit">
                        <div class="d-flex">
                            <div class="text">
                                save
                            </div>
                        </div>
                    </a>
                </div> -->
            </div>
        </div>
        <div class="form-part co-ravellers">
            <form action="{{route('save.coTraveler')}}" method="post" class="global-ajax-form">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3  repeat-section">
                        <div class="box">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" value=""
                                placeholder="Full Name">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3  repeat-section ">
                        <div class="box">
                            <label class="form-label">Email Address (optional)</label>
                            <input type="text" class="form-control" name="email" value=""
                                placeholder="Email Address (optional)">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 repeat-section">
                        <div class="box mt-0">
                            <label class="form-label">&nbsp;</label>
                            <input type="date" class="form-control common-date" name="dob" value="" placeholder="Date of Birth">
                            <div class="icon">
                                <span class="icon-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 repeat-section">
                        <div class="box">
                            <label class="form-label">&nbsp;</label>
                            <select class="form-select" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-4 repeat-section">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name='confirm' value="1">
                            <label class="form-check-label checkbox-label" for="flexCheckDefault">
                                I confirm that I’m authorised to provide the personal data of any co-traveller
                                (including children) to tourtripx.com for this service. In addition, I confirm that I’ve
                                informed the other Travelers that I’m providing their personal data to tourtripx.com.
                            </label>
                        </div>
                    </div>
                    <div class="col-12 repeat-section mt-4 d-flex justify-content-end">
                        <div class="box mt-2">
                            <button type="submit" class="btn btn-outline-primary">save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<!-- <div class="main-card d-none" id="show-card-list">
    <div class="space-box payment-details">
        <div class="title-card">
            <div class="d-xl-flex justify-content-xl-between w-100">
                <div>
                    <div class="profile-title">
                        <h2>Co-Travelers</h2>
                        <p>Add or edit information about the people you’re Traveling with.</p>
                    </div>
                </div>
                <div>
                    <a href="javascript:void(0);" id="show-table" class="btn btn-transparent mt-xl-0 mt-3" title="Edit">
                        <div class="d-flex">
                            <div class="icon">
                                <span class="icon-plus pe-2"></span>
                            </div>
                            <div class="text">
                                Add traveller
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-part">
            <div class="main-table co-traveller">
                <table class="table table-bordered " id="travelerTable">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div> -->


<!-- Edit Modal -->

<div class="modal fade section-12-modal" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Update Co-Traveller</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('save.coTraveler')}}" method="post" class="global-ajax-form">
                    <input type="hidden" id="travelerId" name="id" value=""/>
                    <div class="mb-3">
                        <label for="travelerName">Name</label>
                        <input type="text" class="form-control" id="travelerName" value="" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="travelerName">Email</label>
                        <input type="text" class="form-control" id="travelerEmail" value="" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="travelerDob">Date of Birth</label>
                        <div class="position-relative">
                            <input type="text" class="form-control dob" id="travelerDob" value="" name="dob" required>
                            <div class="icon">
                                <span class="icon-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="travelerDob">Gender</label>
                        <select class="form-control" id="travelerGender" name="gender" required>
                            <option value="" disabled selected>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('body').on('click', '.edit-item', function(e) {
        e.preventDefault();
        var travelerId = $(this).data('id');
        $.ajax({
            url: '{{ route("traveler.details") }}/' + travelerId,
            type: 'GET',
            id: travelerId,
            success: function(data) {
                if (data.status == 200) {
                    $('#travelerId').val(data.data.id);
                    $('#travelerEmail').val(data.data.email);
                    $('#travelerName').val(data.data.name);
                    $('#travelerDob').val(data.data.dob);
                    $('#travelerGender').val(data.data.gender);
                    $('#editModal').modal('show');
                }

            },
            error: function(error) {
                console.error('Error fetching traveler details:', error);
            }
        });
    });

    $('body').on('click', '.delete-traveler', function(e) {
        e.preventDefault();
        var travelerId = $(this).data('id');
        var row = $(this).closest('tr');
        Swal.fire({
            title: "Are you sure?",
            text: "Want to delete this?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: 'btn-danger'
            },
            preConfirm: function() {
                return $.ajax({
                    url: '{{ route("delete.cotraveler") }}/' + travelerId,
                    type: 'get',
                }).done(function(data) {
                    row.remove();
                }).catch(function(error) {
                    Swal.fire({
                        text: error.responseJSON.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                });
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                if (table) {
                    table.ajax.reload(null, false);
                }
            }
        });
    });
</script>