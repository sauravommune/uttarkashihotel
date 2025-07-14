$(document).ready(function () {
    let roomType = null,
        roomName = null,
        totalRoom = 0,
        counter = 1,
        roomId = null,
        price = 0,
        totalPrice = 0;
    previousPrice = 0;
    payAmount = 0;
    breakFastType = null;
    roomTypeId = 0;
    hotelId = 0;
    totalNights = 1;

    $("body").on("click", ".change-room, .change-hotel", function (e) {
        roomType = null;
        roomName = null;
        breakFastType = null;
        totalRoom = 0;
        counter = 1;
        roomId = null;
        price = 0;
        totalPrice = 0;
        previousPrice = 0;
        payAmount = 0;
        roomTypeId = 0;
        hotelId = 0;
        totalNights = 1;
    });

    const updateTotals = () => {
        previousPrice = $("#previous_price").data("previous_price");
        totalNights = $("#total_nights").data("total_nights");

        payAmount = totalPrice * totalNights - previousPrice;

        if (payAmount < 0) {
            $(".refund-amount").text("Total Refund Amount");
        } else {
            $(".refund-amount").text("Total Pay Amount");
        }

        $(".total-room").text(totalRoom);
        $(".total-price").text(totalPrice * totalNights);
        $(".total-pay-price").text(Math.abs(payAmount));
        $(".total-price-wrapper").toggleClass("d-none", totalRoom === 0);
        $(".select-min-one").toggleClass("d-none", totalRoom > 0);
    };

    const getPrice = (element) => {
        return (
            (element
                .parents(".counter")
                .find(".counter__display")
                .data("amount") || 0) * 1
        );
    };

    const addRoomRow = (
        roomType,
        roomId,
        roomName,
        price,
        counter,
        breakFastType,
        roomTypeId,
        hotelId
    ) => {
        return counter > 0
            ? `
                <div class="d-flex justify-content-between align-items-center w-100 mb-2 price-part-${roomType}-${roomId}">
                    <div class="left-part">
                        <span class="counter-part-${roomType}-${roomId}">${counter}</span> x ${roomName} (${roomType})
                    </div>
                    <div class="right-part price-${roomType}-${roomId}">₹ ${price}</div>

                    <input type="hidden" name="roomId[]" value="${roomId}">
                    <input type="hidden" name="breakFastType[]" value="${breakFastType}">
                    <input type="hidden" name="roomTypeId[]" value="${roomTypeId}">
                    <input type ="hidden" name="hotelId" value="${hotelId}">
                    <input type ="hidden" name="quantity[]" value="${counter}">

                </div>`
            : "";
    };

    $("body").on(
        "click",
        ".counter__btn--increment, .counter__btn--decrement",
        function () {
            let _this = $(this),
                increment = _this.hasClass("counter__btn--increment") ? 1 : -1;

            roomType = _this.attr("room-type");
            roomName = _this.attr("room-name");
            breakFastType = _this.attr("break-fast-type");
            roomTypeId = _this.attr("room-type-id");

            roomId = _this
                .closest(".border-bottom")
                .find('input[name="room_name"]')
                .val();
            hotelId = _this
                .closest(".border-bottom")
                .find('input[name="hotel_id"]')
                .val();
            counter =
                _this.closest(".counter").find(".counter__display").text() * 1 +
                increment;
            if (counter < 0) {
                counter = 0;
                return;
            }
            price = getPrice(_this) * counter;
            totalPrice += increment * getPrice(_this);
            totalRoom += increment;
            totalNights = $("#total_nights").data("total_nights");
            price = price * totalNights;

            if ($(`.price-area .price-part-${roomType}-${roomId}`).length > 0) {
                $(`.price-area .price-part-${roomType}-${roomId}`).replaceWith(
                    addRoomRow(
                        roomType,
                        roomId,
                        roomName,
                        price,
                        counter,
                        breakFastType,
                        roomTypeId,
                        hotelId
                    )
                );
            } else {
                $(".price-area").append(
                    addRoomRow(
                        roomType,
                        roomId,
                        roomName,
                        price,
                        counter,
                        breakFastType,
                        roomTypeId,
                        hotelId
                    )
                );
            }

            $(`.counter-part-${roomType}-${roomId}`).text(counter);
            $(`.price-${roomType}-${roomId}`).text(`₹ ${price}`);
            _this.closest(".counter").find(".counter__display").text(counter);

            updateTotals();
        }
    );
});

//change-booking-date js

$(function () {
    $("body").on(
        "change",
        'input[name="check_in"] , input[name="check_out"]',
        function () {
            // alert('testing');
            let bookingID = $("#booking_id").data("booking-id");
            let check_in = $('input[name="check_in"]').val();
            let check_out = $('input[name="check_out"]').val();
            let previous_amount = $("#previous_amount").data("previous_amount");
            if (!check_in || !check_out) {
                return;
            }
            $.ajax({
                type: "get",
                url: "/leads/change/rate-plan/" + bookingID,
                data: {
                    bookingID,
                    check_in,
                    check_out,
                    previous_amount,
                },
                success: function (response) {
                    $("#new_amount").html(response.total_new_amount);
                    $("#pay_amount").html(response.payAmount);

                    if (response.status == 400) {
                        toastr.warning(response.message, "warning", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 2000,
                        });
                        $("#btn").prop("disabled", true);
                    } else if (response.status == 200) {
                        if (response.payAmount == 0) {
                            toastr.warning(response.message, "warning", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 2000,
                            });
                            $("#btn").prop("disabled", true);
                        }

                        if (response.payAmount > 0) {
                            toastr.info(response.message, "suggestion", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 2000,
                            });
                            $("#payment_head").text(response.text);
                            $("#btn").prop("disabled", false);
                        }
                    } else if (response.status == 201) {
                        toastr.info(response.message, "suggestion", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 2000,
                        });
                        $("#payment_head").text(response.text);
                        $("#btn").prop("disabled", false);
                    }
                },
            });
        }
    );

    $("body").on("keyup", 'input[name="search-hotel"]', function () {
        var hotelName = $(this).val();
        var bookingId = $("#bookingId").val();

        if (hotelName.trim() !== "") {
            $.ajax({
                url: "/leads/change/hotel/" + bookingId,
                method: "GET",
                data: {
                    hotel_name: hotelName,
                },

                success: function (response) {
                    if (response.html) {
                        var html = response.html;
                        $("#appendSearchHotel").html(html);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    console.error("Error: " + error);
                },
            });
        }
    });

    $("body").on("click", ".recommend-btn", function () {
        const key = $(this).data("key");
        const recommendText = $(`#recommend-text-${key}`);
        const recommendCheckbox = $(`#recommend-checkbox-${key}`);
        const statusInput = $(`#status-${key}`);
        recommendCheckbox.prop("checked", !recommendCheckbox.prop("checked"));

        const status = recommendCheckbox.prop("checked") ? 1 : 0;
        statusInput.val(status);
        if (status === 1) {
            recommendText.text("Recommended").addClass("recommended");
        } else {
            recommendText.text("Recommend").removeClass("recommended");
        }
    });
});
