window.addEventListener('DOMContentLoaded', () => {
    const alertSuccess = document.getElementById('alert_success');

    if (alertSuccess) {
        alertSuccess.addEventListener('animationend', function () {
            this.style.opacity = '1';
            this.style.animation = 'none';
        }, {
            once: true
        });

        setTimeout(() => {
            alertSuccess.style.opacity = '0';
            setTimeout(() => {
                alertSuccess.style.display = 'none';
            }, 500);
        }, 3000);
    }
});

window.addEventListener('DOMContentLoaded', () => {
    const alertDanger = document.getElementById('alert_danger');

    if (alertDanger) {
        alertDanger.addEventListener('animationend', function () {
            this.style.opacity = '1';
            this.style.animation = 'none';
        }, {
            once: true
        });

        setTimeout(() => {
            alertDanger.style.opacity = '0';
            setTimeout(() => {
                alertDanger.style.display = 'none';
            }, 500);
        }, 3000);
    }
});