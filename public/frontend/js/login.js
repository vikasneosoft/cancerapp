
$("#patient-login").validate({
  rules: {
    email: {
      required: true,
      email: true
    },
    password: {
      required: true
    }
  },
  messages: {
    email: {
      required: "Please enter your email",
      email: "Email is not valid"
    },
    password: {
      required: "Please enter your password"
    }
  },
  errorElement: "span",
  errorClass: "text-danger",


  submitHandler: function (form) {
    let redirectLink = $("#redirect-profile").val();
    let url = $("#patent-login-route").val();
    let patientUrl = $("#patent-redirect-route").val();
    $.ajax({
      dataType: "json",
      method: "post",
      data: $("#patient-login").serialize(),
      url: url,
      beforeSend: function () {
        $(".signup-ajax").addClass("sending-ajax");
      },
      success: function (data) {
        $("#loadingImage").removeClass("d-block");
        $("#loadingImage").addClass("d-none");

        if (data.status == 1) {
          alert('he');
          window.location.href = patientUrl;
        } else {
          $('.patient-wrong-credentials').html('Invalid email or password')
        }
        if (data.status == 2) {
          $(".signup-ajax").removeClass("sending-ajax");
          $("#restore-talent-account").removeClass("htt-d-none");
          email = $("#email").val();
          $("#restore-talent-account").html("Click this link to restore your account");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $(".signup-ajax").removeClass("sending-ajax");
        $.each(xhr.responseJSON.errors, function (i, obj) {
          $('input[name="' + i + '"]')
            .closest(".floating-label")
            .find("span.error")
            .removeClass("htt-d-none")
            .slideDown(400)
            .html(obj);
        });
      }
    });
  }
});


