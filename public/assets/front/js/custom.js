$(document).ready(function () {
    const lazyLoadInstance = new LazyLoad({
        elements_selector:
            "img.lazy, video.lazy, div.lazy, section.lazy, header.lazy, footer.lazy,iframe.lazy",
    });
    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            $("#navbar").addClass("fixed-top");
            $("#search-sticky").addClass("search-sticky");
            $("#black-logo").removeClass("d-none");
            $("#white-logo").addClass("d-none");
            $("#top-bg-class").addClass("d-none");
            navbar_height = document.querySelector(".navbar").offsetHeight;
            document.body.style.paddingTop = navbar_height + "px";
        } else {
            $("#navbar").removeClass("fixed-top");
            $("#search-sticky").removeClass("search-sticky");
            $("#white-logo").removeClass("d-none");
            $("#black-logo").addClass("d-none");
            $("#top-bg-class").removeClass("d-none");
            document.body.style.paddingTop = "0";
        }
    });

    // var fp = flatpickr(".check-in", {
    //     minDate: new Date().fp_incr(2),
    //     onChange: function (selectedDates, dateStr, instance) {
    //         if (selectedDates.length > 0) {
    //             $("input[name=checkin_date]").val(dateStr);
    //             $(".check-in").text(formatDate(selectedDates[0]));
    //         } else {
    //             $("input[name=checkin_date]").val("");
    //         }
    //     },
    //     disableMobile: true,
    // });

    // var fp = flatpickr(".check-out", {
    //     minDate: new Date().fp_incr(3),
    //     disableMobile: true,
    //     onChange: function (selectedDates, dateStr, instance) {
    //         if (selectedDates.length > 0) {
    //             $("input[name=checkout_date]").val(dateStr);
    //             $(".check-out").text(formatDate(selectedDates[0]));
    //         } else {
    //             $("input[name=checkout_date]").val("");
    //         }
    //     },
    // });

    var checkInPicker = flatpickr(".check-in", {
        minDate: new Date().fp_incr(2), // Set minDate to 2 days from today
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                $("input[name=checkin_date]").val(dateStr);
                $(".check-in").text(formatDate(selectedDates[0]));

                // Set check-out minDate to 1 day after selected check-in date
                let newMinDate = selectedDates[0].fp_incr(1);
                checkOutPicker.set("minDate", newMinDate);
                // Get currently selected check-out date
                let selectedCheckOut = checkOutPicker.selectedDates[0];

                // If the selected check-out date is before the new minDate, reset it
                if (!selectedCheckOut || selectedCheckOut < newMinDate) {
                    checkOutPicker.setDate(newMinDate, true); // Auto-set to new minDate
                    $("input[name=checkout_date]").val(
                        instance.formatDate(newMinDate, "Y-m-d")
                    );
                    $(".check-out").text(formatDate(newMinDate));
                }
            } else {
                $("input[name=checkin_date]").val("");
            }
        },
        disableMobile: true,
    });

    var checkOutPicker = flatpickr(".check-out", {
        minDate: new Date().fp_incr(3), // Initially 3 days from today
        disableMobile: true,
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                $("input[name=checkout_date]").val(dateStr);
                $(".check-out").text(formatDate(selectedDates[0]));
            } else {
                $("input[name=checkout_date]").val("");
            }
        },
    });

    var fp = flatpickr(".common-date", {});
    var fp = flatpickr(".dob", {});

    var fp = flatpickr(".revise-date", {});

    $(".select2-class").select2({
        placeholder: "Select an option",
    });

    function formatDate(date) {
        const options = { year: "numeric", month: "long", day: "numeric" };
        return date.toLocaleDateString("en-US", options);
    }
});

$(".room-img").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    initialSlide: 1,
    arrows: true,
    fade: true,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: false,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$("#destination-slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    initialSlide: 1,
    arrows: true,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: false,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$("#hotel-slider-II").slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    infinite: true,
    initialSlide: 1,
    arrows: true,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: false,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$("#discound-slider-II").slick({
    slidesToShow: 3,
    slidesToScroll: 1,

    arrows: false,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: false,

    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                initialSlide: 1,
            },
        },
    ],
});

$("#slider-II").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: false,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$("#destination-slider-II").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    initialSlide: 1,
    arrows: true,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: false,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$(".saved-hotel").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    initialSlide: 1,
    arrows: false,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: true,
    autoplay: true,
    autoplaySpeed: 500,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$(".saved-hotel-new").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    initialSlide: 1,
    arrows: false,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: true,
    autoplay: true,
    autoplaySpeed: 500,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$(".hotel-review").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 5000,
});

$(".hotel-reviews-google").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 5000,
    responsive: [
        {
            breakpoint: 768, // Target screen width (e.g., for tablets and smaller)
            settings: {
                slidesToShow: 2, // Adjust the number of slides to show
                slidesToScroll: 1, // Adjust slides to scroll
            },
        },
        {
            breakpoint: 480, // Target screen width (e.g., for mobile devices)
            settings: {
                slidesToShow: 1, // Only one slide at a time on small screens
                slidesToScroll: 1,
            },
        },
    ],
});


(function ($) {
    "use strict";

    // Run the functionality for each instance of .guest-input
    $(".guest-input").each(function () {
        const maxNumGuests = 20;
        const maxChildAge = 12;

        const $guestInput = $(this); // Scope it to the specific .guest-input
        const $dropdown = $guestInput.siblings(".guest-dropdown");
        const $childAgeSelectors = $dropdown.find(".age-selector");

        let isOpen = false;

        const initialValues = {
            adultCount: $("input[name=adultCount]").val() || 1,
            childCount: $("input[name=childCount]").val() || 0,
            roomCount: $("input[name=roomCount]").val() || 1,
        };

        let adultsCount = parseInt(initialValues.adultCount, 10),
            childrenCount = parseInt(initialValues.childCount, 10),
            roomCount = parseInt(initialValues.roomCount, 10);

        // console.log(adultsCount);

        const updateValues = () => {
            const totalGuests = adultsCount + childrenCount + roomCount;
            const previousAges = $dropdown
                .find(".child-age-select")
                .map(function () {
                    return $(this).val();
                })
                .get();

            // Update guest input text
            var roomText = roomCount > 1 ? "Rooms" : "Room";
            var adultText = adultsCount > 1 ? "Adults" : "Adult";

            $guestInput.val(
                `${roomCount} ${roomText}, ${adultsCount} ${adultText}${
                    childrenCount
                        ? `, ${childrenCount} ${
                              childrenCount > 1 ? "Children" : "Child"
                          }`
                        : ""
                }`
            );

            // Update counters in dropdown
            $dropdown.find(".adult-count").text(adultsCount);
            $dropdown.find(".child-count").text(childrenCount);
            $dropdown.find(".room-count").text(roomCount);
            $("input[name=adultCount]").val(adultsCount);
            $("input[name=childCount]").val(childrenCount);
            $("input[name=roomCount]").val(roomCount);

            // Toggle button states
            toggleButtonState(".adult-decrement", adultsCount <= 1);
            toggleButtonState(".child-decrement", childrenCount <= 0);
            toggleButtonState(".room-decrement", roomCount <= 1);
            toggleButtonState(".increment", totalGuests >= maxNumGuests);

            updateChildAgeSelectors(previousAges);
        };

        const toggleButtonState = (selector, disable) => {
            $dropdown.find(selector).toggleClass("disabled", disable);
        };

        const updateChildAgeSelectors = (previousAges = []) => {
            $childAgeSelectors.empty().toggle(childrenCount > 0);
            for (let i = 1; i <= childrenCount; i++) {
                const selectedAge = previousAges[i - 1] || 0;
                $childAgeSelectors.append(`
                        <div class="child-age">
                            <label for="childAge${i}">Child ${i} Age</label>
                            <select class="child-age-select" name="childAge[]">
                                ${Array.from(
                                    { length: maxChildAge },
                                    (_, age) => `
                                    <option value="${age + 1}" ${
                                        age + 1 == selectedAge ? "selected" : ""
                                    }>
                                        ${age + 1} year
                                    </option>`
                                ).join("")}
                            </select>
                        </div>
                    `);
            }
        };

        const incrementCount = (count) =>
            adultsCount + childrenCount + roomCount < maxNumGuests
                ? count + 1
                : count;
        const decrementCount = (count, min) =>
            count > min ? count - 1 : count;

        // Attach event handlers
        $guestInput.on("click", () => {
            isOpen = !isOpen;
            $dropdown.toggleClass("open", isOpen);
        });

        // $dropdown.on("click", ".increment", function () {
        //     const type = $(this).data("type");
        //     if (type === "adult") adultsCount = incrementCount(adultsCount);
        //     if (type === "child") childrenCount = incrementCount(childrenCount);
        //     if (type === "room") roomCount = incrementCount(roomCount);
        //     updateValues();
        // });
        // $dropdown.on("click", ".decrement", function () {
        //     const type = $(this).data("type");
        //     if (type === "adult") adultsCount = decrementCount(adultsCount, 1);
        //     if (type === "child")
        //         childrenCount = decrementCount(childrenCount, 0);
        //     if (type === "room") roomCount = decrementCount(roomCount, 1);
        //     updateValues();
        // });

        
        $dropdown.on("click", ".increment", function () {
            const type = $(this).data("type");
           if (type === "adult") adultsCount = incrementCount(adultsCount);
            if (type === "child") childrenCount = incrementCount(childrenCount);
            if (type === "room"){
                adultsCount=incrementCount(roomCount); 
                roomCount = incrementCount(roomCount);
              } 
            updateValues();
        });

        $dropdown.on("click", ".decrement", function () {
            const type = $(this).data("type");
            if (type === "adult") adultsCount = decrementCount(adultsCount, 1);
            if (type === "child") childrenCount = decrementCount(childrenCount, 0);
            if (type === "room") roomCount = decrementCount(roomCount, 1);
            updateValues();
        });


        $dropdown.on("change", "select.child-age-select", function () {
            const $this = $(this);
            const selectedIndex = $this.closest(".child-age").index();
            const selectedValue = $this.val();

            // Loop through all guest dropdowns and update child-age at the same index
            $(".guest-dropdown .age-selector").each(function () {
                $(this)
                    .find(".child-age")
                    .eq(selectedIndex)
                    .find("select.child-age-select")
                    .val(selectedValue);
            });
        });

        $(document).on("click", (e) => {
            if (!$(e.target).closest(".guest-input, .guest-dropdown").length) {
                $dropdown.removeClass("open");
                isOpen = false;
            }
        });

        updateValues();
    });
})(jQuery);

$(window).on("click", function (e) {
    if (
        !$(e.target).closest(".room-search").length &&
        !$(e.target).closest(".search-sections-part").length
    ) {
        if (!$(".search-sections-part").hasClass("d-none")) {
            $(".search-sections-part").addClass("d-none");
        }
    }
});
$(document).on("contentUpdated", function () {
    if ($(".hotel-slider").length > 0) {
        $(".hotel-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            initialSlide: 1,
            arrows: false,
            prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
            nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
            dots: true,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });
    }
});

$("body").on("click", ".origin-room", function (e) {
    $(".search-sections-part").toggleClass("d-none");
    $(".form-control-custom").focus();
});

$(document).ready(function () {
    $("#plusBtn").click(function () {
        $("#quantityInput").val(parseInt($("#quantityInput").val()) + 1);
    });
});

$("#saveBtnOne").click(function () {
    $("#no-card").addClass("d-none");
    $("#add-card").removeClass("d-none");
});

$("#show-table").click(function () {
    $("#no-card").addClass("d-none");
    $("#add-card").removeClass("d-none");
    $("#show-card-list").addClass("d-none");
});

$("#saveBtnOne-1").click(function () {
    $("#no-card-1").addClass("d-none");
    $("#add-card-1").removeClass("d-none");
});
$("#saveBtn-1").click(function () {
    $("#no-card-1").addClass("d-none");
    $("#add-card-1").addClass("d-none");
    $("#show-card-list-1").removeClass("d-none");
});
$("#show-table-1").click(function () {
    $("#no-card-1").addClass("d-none");
    $("#add-card-1").removeClass("d-none");
    $("#show-card-list-1").addClass("d-none");
});

$(function () {
    $(".clicker").on("click", function (e) {
        e.preventDefault();
        var cityName = $(this).find(".city_name").text().trim();
        var stateName = $(this).find(".state_name").text().trim();
        var cityAndState = cityName + ", " + stateName;
        var cityId = $(this).data("id");
        $("#setCityId").val(cityId);
        $(".search-depart").val(cityAndState);
        $("#show-city").text(cityAndState);
        $("#data-city-name").attr("data-city_name", cityName);

        $(".search-sections-part").addClass("d-none");
    });

    $("#searchCity").on("keyup", function () {
        var searchTerm = $(this).val().toLowerCase();
        // alert(searchTerm);
        $(".clicker").filter(function () {
            var isVisible =
                $(this).text().toLowerCase().indexOf(searchTerm) > -1;
            $(this).toggle(isVisible);

            if ($(".clicker:visible").length == 0) {
                $("#notFoundMessage").html(
                    '<h6 class="text-center fw-semibold py-xl-3 py-2">No Hotels found !</h6>'
                );
            } else {
                $("#notFoundMessage").html("");
            }
        });
    });
});

let selectedChildAges = []; // Store ages for each child

// Function to toggle dropdown visibility
function toggleDropdown() {
    // alert('testing');
    const dropdown = document.getElementById("guestDropdown");
    dropdown.style.display =
        dropdown.style.display === "block" ? "none" : "block";
}

// Close dropdown when clicking outside
document.addEventListener("click", function (event) {
    const dropdown = document.getElementById("guestDropdown");
    const input = document.getElementById("guestInput");
    // if (!input.contains(event.target) && !dropdown.contains(event.target)) {
    //     dropdown.style.display = 'none';
    // }
});

const MIN_GUESTS = 1; // Minimum guests should be 1
const MAX_ROOMS = 20;
const MAX_ADULTS = 40;
const MAX_CHILDREN = 40;

function increment(id) {
    const count = document.getElementById(id);
    let value = parseInt(count.textContent);

    if (id === "roomCount" && value < MAX_ROOMS) {
        count.textContent = value + 1;
    } else if (id === "adultCount" && value < MAX_ADULTS) {
        count.textContent = value + 1;
    } else if (id === "childCount" && value < MAX_CHILDREN) {
        count.textContent = value + 1;
        selectedChildAges.push(0); // Add default age for the new child
    }

    updateButtons();
    updateGuestInput();
    updateChildAgeSelectors();
}

function decrement(id) {
    const count = document.getElementById(id);
    let value = parseInt(count.textContent);

    if (value > MIN_GUESTS) {
        count.textContent = value - 1;

        // For children, remove the last entry in the selectedChildAges array
        if (id === "childCount") {
            selectedChildAges.pop();
        }
    }

    updateButtons();
    updateGuestInput();
    updateChildAgeSelectors();
}

function updateChildAgeSelectors() {
    const childCount = parseInt(
        document.getElementById("childCount").textContent
    );
    const childAgeSelectors = document.getElementById("childAgeSelectors");

    // Clear existing selectors
    childAgeSelectors.innerHTML = "";

    // Add a dropdown for each child to select age

    for (let i = 0; i < childCount; i++) {
        const ageSelector = document.createElement("select");
        ageSelector.className = "age-dropdown";
        ageSelector.setAttribute("aria-label", `Select age for child ${i + 1}`);

        // Add age options (0-17)
        for (let age = 0; age <= 17; age++) {
            const option = document.createElement("option");
            option.value = age;
            option.textContent = age === 0 ? "Under 1" : `${age} years`;
            ageSelector.appendChild(option);
        }

        // Set previous selection if it exists
        const previousAge =
            selectedChildAges[i] !== undefined ? selectedChildAges[i] : 0;
        ageSelector.value = previousAge; // Set selected value after options are added

        // Update selected ages on change
        ageSelector.addEventListener("change", function () {
            selectedChildAges[i] = parseInt(this.value);
        });

        // Label for the age selector
        const label = document.createElement("label");
        label.textContent = `Child ${i + 1} Age:`;
        childAgeSelectors.appendChild(label);
        childAgeSelectors.appendChild(ageSelector);
    }
}

$("#testimonial-slider-II").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    initialSlide: 1,
    arrows: true,
    prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
    nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
    dots: false,
    autoplay: true,
    autoplaySpeed: 5000,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 546,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

// $(document).on('show.bs.modal', function () {
//     const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
//     $('body').css('padding-right', scrollbarWidth + 'px');
// });

// $(document).on('hidden.bs.modal', function () {
//     $('body').css('padding-right', '0');
// });
