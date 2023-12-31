function toastSuccess(message) {
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "linear-gradient(to right, #96c93d, #96c93d)",
        },
        onClick: function () {}, // Callback after click
    }).showToast();
}

function toastError(message) {
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "linear-gradient(to right, #FF5733, #FF5733)",
        },
        onClick: function () {}, // Callback after click
    }).showToast();
}
