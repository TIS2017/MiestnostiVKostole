function showAlert(message, alert = "alert-success") {
    var htmlAlert = '<div class="alert ' + alert + '">' + message + '</div>';
        $(".alert-messages").prepend(htmlAlert);
        $(".alert-messages .alert").first().hide().fadeIn(200).delay(2000).fadeOut(1000, function () { $(this).remove(); });
}
function showModal() {
	$("#myModal").modal();
}
