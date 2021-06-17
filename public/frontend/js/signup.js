$(document).on("click", ".talent-see-password", function (e) {
  $("#password").prop("type", "text");
  $(".span-talent-password").addClass("active");
  $(this).addClass('see-original-old-password');
  $(this).removeClass('see-old-password');
});


$(document).on("click", ".see-original-old-password", function (e) {
  $("#password").prop("type", "password");
  $(".span-talent-password").removeClass("active");
  $(this).removeClass('see-original-old-password');
  $(this).addClass('see-old-password');
});


var email = "";
$("#registerTalent").validate({
  rules: {
    first_name: {
      required: true,
      maxlength: 70
    },
    last_name: {
      required: true,
      maxlength: 75
    },
    email: {
      required: true,
      email: true,
      maxlength: 75
    },
    password: {
      required: true
    }
  },
  messages: {
    first_name: {
      required: "Please enter your first name"
    },
    last_name: {
      required: "Please enter your last name"
    },
    email: {
      required: "Please let us know your email",
      email: "Email is not valid"
    },
    password: {
      required: "Please pick a password for your account"
    }
  },
  errorElement: "span",
  errorClass: "error",
  highlight: function (element) {
    $(element).parent().addClass("error");
  },
  unhighlight: function (element) {
    $(element).parent().removeClass("error");
  },
  submitHandler: function (form) {
    let redirectLink = $("#redirect-profile").val();
    let url = $("#register-route").val();
    $.ajax({
      dataType: "json",
      method: "post",
      data: $("#registerTalent").serialize(),
      url: url,
      beforeSend: function () {
        $(".signup-ajax").addClass("sending-ajax");
      },
      success: function (data) {
        $("#loadingImage").removeClass("d-block");
        $("#loadingImage").addClass("d-none");

        if (data.status == 1) {
          location.reload();
          //window.location.href = redirectLink + "/talent/steps";
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

$(document).on("click", ".restore-talent-account", function (e) {
  e.preventDefault();
  let url = $(this).attr("data-url");
  $.ajax({
    dataType: "json",
    method: "post",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    data: {
      email: email
    },
    url: url,
    context: this,
    beforeSend: function () {
      $(".signup-ajax").addClass("sending-ajax");
    },
    success: function (data) {
      $("#loadingImage").removeClass("d-block");
      $("#loadingImage").addClass("d-none");
      if (data.status == 1) {
        $(".signup-ajax").removeClass("sending-ajax");
        $(".info-notice").removeClass("restore-talent-account");

        $("#restore-talent-account").html("Please check your email.");
       
      }
    }
  });
});
