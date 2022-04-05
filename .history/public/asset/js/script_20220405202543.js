// load();

function load() {
    axios
        .get("view-statistical")
        .then(function(response) {
            $("#container").html(response.data);
        })
        .catch((error) => {
            console.log(error);
        });
}
$(document).ready(function() {
    var a = ".menu-item";
    $(a).on("click", function() {
        $(a).removeClass("menu-item-active");
        $(this).addClass("menu-item-active");
    });
    $(document).on("click", "#change_pass", function(event) {
        event.preventDefault();
        $(a).removeClass("menu-item-active");
        axios
            .get("change-pass")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#profile", function(event) {
        event.preventDefault();
        $(a).removeClass("menu-item-active");
        axios
            .get("profile")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_statistical", function(event) {
        event.preventDefault();
        load();
    });
    $(document).on("click", "#view_supplier", function(event) {
        event.preventDefault();
        axios
            .get("view-supplier")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_category", function(event) {
        event.preventDefault();
        axios
            .get("view-category")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_brand", function(event) {
        event.preventDefault();
        axios
            .get("view-brand")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_unit", function(event) {
        event.preventDefault();
        axios
            .get("view-unit")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_product", function(event) {
        event.preventDefault();
        axios
            .get("view-product")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_customer", function(event) {
        event.preventDefault();
        axios
            .get("view-customer")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_coupon", function(event) {
        event.preventDefault();
        axios
            .get("view-coupon")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });view_order
    $(document).on("click", "#view_import", function(event) {
        event.preventDefault();
        axios
            .get("view-import")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_import", function(event) {
        event.preventDefault();
        axios
            .get("view-import")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_setting", function(event) {
        event.preventDefault();
        axios
            .get("view-setting")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
    $(document).on("click", "#view_user", function(event) {
        event.preventDefault();
        axios
            .get("view-user")
            .then(function(response) {
                $("#container").html(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    });
});
