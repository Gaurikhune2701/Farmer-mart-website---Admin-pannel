setTimeout(function() {
    var alertMessage = document.getElementById('alert-message');
    if (alertMessage) {
        alertMessage.classList.remove('show');
        alertMessage.classList.add('fade');

        setTimeout(function() {
            alertMessage.style.display = 'none';
        }, 150);
    }
}, 5000);
