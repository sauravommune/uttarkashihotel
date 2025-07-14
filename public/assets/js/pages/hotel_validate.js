// function validateStep1(){

$("#step1form").validate({

  rules: {
    // simple rule, converted to {required:true}
    name: {
      required : true,
      remote: {
        url: base_url+"/hotels/unique",
        type: "get",
        data: {
          name: function() {
            return $( "input[name='name']" ).val();
          },
          id :function(){
            return $( "input[name='id']" ).val();
          }
        }
      }
    },
    // compound rule
    email: {
      // required: true,
      email: true
    },
    phone: {
      required: true,
    },
    address: {
      required: true,
    },
    country: {
      required: true,
    },
    city: {
      required: true,
    },
    zip_code: {
      required: true,
    },

    video_title: {
      required: {
        depends: function(element) {
          return $("input[name='video_id']").val().trim().length > 0;
        }
      }
    },
    video_id: {
      required: {
        depends: function(element) {
          return $("input[name='video_title']").val().trim().length > 0;
        }
      }
    }
    
  },
  messages: {
    name: {
      remote: "The hotel name has already been taken"
    }
  }

});

$("#step2form").validate({

  // rules: {
  //     // simple rule, converted to {required:true}
  //     facility: "required",

  //   },
});
$("#step3form").validate({

  rules: {
    // simple rule, converted to {required:true}
    parking_available: "required",
    // reservation_required: "required",
    // parking_location: "required",
    // parking_type: "required"

  },
});

$("#step4form").validate({

  rules: {
    // simple rule, converted to {required:true}
    breakfast_served: "required",
    enter_amount: "required",
    "breakfasts[]": "required",

  },
});

$("#step5form").validate({

  rules: {
    // simple rule, converted to {required:true}
    check_in_time: "required",
    check_out_time: "required",
    pets_allowed: "required",

  },
});
$("#step6form").validate({

  rules: {
    // simple rule, converted to {required:true}
    bank_name: "required",
    ifsc: "required",
    branch_name: "required",
    account_holder_name: "required",
    // upi_id: "required",
    name_on_invoice: "required",
    branch_name: "required",
    account_number: "required"

  },
});

  // $("#step7form").validate({
  //   rules: {
  //     searchImageName: {
  //       required: function () {
  //         return $("input[name='search_page_img']").val().trim().length > 0;
  //       }
  //     },
  //     searchAltTag: {
  //       required: function () {
  //         return $("input[name='search_page_img']").val().trim().length > 0;
  //       }
  //     }
  //   },
  //   messages: {
  //     searchImageName: {
  //       required: "This field is required."
  //     },
  //     searchAltTag: {
  //       required: "This field is required."
  //     }
  //   }
  // });


$("#step8form").validate({

  rules: {
    // simple rule, converted to {required:true}
    owner_type: "required",
    owner_name: "required",
    // last_name: "required",
    owner_contact_no: "required",
    terms1: "required",
    terms2: "required",
    owner_email: {
      required : true,
      remote: {
        url: base_url+"/unique/email",
        type: "get",
        data: {
          email: function() {
            return $( "input[type='email']" ).val();
          },
          id :function(){
            return $( "input[name='id']" ).val();
          },
          type: function(){
            return "owner_email"
          }

        }
      }
    },

    messages: {
      name: {
        remote: "The email has already been taken"
      }
    }

  },

});
// }