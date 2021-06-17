(function ($) {
  $.fn.inputFilter = function (inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
      if (inputFilter(this.value)) {

        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {

        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  };
}(jQuery));
// Install input filters.

$("#pincode, #contact_number").inputFilter(function (value) {
  return /^-?\d*$/.test(value);
});
$("#add-inquery").validate({
  rules: {
    name: {
      required: true,
      maxlength: 100,
    },
    email: {
      required: true,
      email: true
    },
    contact_number: {
      required: true,
      number: true,
      maxlength: 10,
    },
    state: {
      required: true,
    },
    city: {
      required: true,
    },
    address: {
      required: true,
    },
    pincode: {
      required: true,
      maxlength: 6,
      minlength: 6
    },
    cancer_type: {
      required: true
    },
    document: {
      required: true,
      accept: "image/jpg,image/jpeg,image/png,image/gif,image/pdf, video/*"
    }
  },
  messages: {
    name: {
      required: "Name is required",
    },
    email: {
      required: "Email is required",
      email: "Email is not valid"
    },
    contact_number: {
      required: "Contact number is required",
      number: "Contact number is not valid",
      maxlength: "Contact number is not valid",
    },
    state: {
      required: "State is required",
    },
    city: {
      required: "City is required",
    },
    address: {
      required: "Address is required"
    },
    pincode: {
      required: "Pincode is required",
      maxlength: "Pincode is not valid",
      minlength: "Pincode is not valid"
    },
    cancer_type: {
      required: "Select type of cancer"
    },
    /*  document: {
       required: "Upload document"
     }, */
    document: {
      required: 'Required!',
      accept: 'Not an image!'
    }
  },
  errorElement: 'span',
  errorClass: 'text-danger',
  submitHandler: function (form) {
    let url = $('#add-inquery-route').val();
    var form = $('#add-inquery')[0];
    var data = new FormData(form);
    $.ajax({
      dataType: 'json',
      method: 'post',
      data: data,
      url: url,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $("#loadingImage").css("display", "block");
      },

      success: function (data) {
        location.reload()
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $("#loadingImage").css("display", "none");
        $.each(xhr.responseJSON.errors, function (i, obj) {
          $('input[name="' + i + '"]').closest('.form-group').addClass('has-error');
          $('input[name="' + i + '"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
          $('select[name="' + i + '"]').closest('.form-group').addClass('has-error');
          $('select[name="' + i + '"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);

        });
      }
    });
  }
});