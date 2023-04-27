<br>
<div id="success_message" class="alert alert-success" style="display:none"></div>

<form id="enquiry-form">
    <div class="form-group row">
        <div class="col-lg-6">
            <input type="text" name="fname" placeholder="First Name" class="form-control" required>
        </div>
        <div class="col-lg-6">
            <input type="text" name="lname" placeholder="Last Name" class="form-control" required>
        </div>
    </div>
    <br>
    <div class="form-group row">
        <div class="col-lg-6">
            <input type="email" name="email" placeholder="Email Address" class="form-control" required>
        </div>
        <div class="col-lg-6">
            <input type="tel" name="phone" placeholder="Phone" class="form-control" required>
        </div>
    </div>
    <br>
    <div class="form-group row">
        <textarea name="enquiry" class="form-control" placeholder="Your Enquiry" required></textarea>
    </div>
    <br>
    <div class="form-group row">
        <button type="submit" class="btn btn-success btn-block">Send Your Enquiry</button>
    </div>
</form>

<div id="success_message"></div>

<script>
(function($) {
    $("#enquiry-form").submit(function(e) {
        e.preventDefault();
        var endpoint = "<?php echo admin_url('admin-ajax.php'); ?>";
        var form = $("#enquiry-form").serialize();

        var formdata = new FormData();
        formdata.append("action", "enquiry");
        formdata.append("nonce", "<?php echo wp_create_nonce( 'ajax-nonce' ); ?>");
        formdata.append("enquiry", form);

        $.ajax(endpoint, {
            type: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(res) {
                $("#enquiry-form").fadeOut(200);
                $("#success_message").text("Thank you for the enquiry").show();
                $("#enquiry-form").trigger("reset");
                $("#enquiry-form").fadeIn(500);
            },
            error: function(err) {
                alert(err.responseJSON.data);
            }
        });
    });
})(jQuery);
</script>