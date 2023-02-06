import './bootstrap';
$(".link-account").click(function() {
    createLinkToken();
});

function createLinkToken() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: "/createLinkToken",
        type: "GET",
        dataType: "json",
        success: function (response) {
            const data = JSON.parse(response.data);
            console.log('Link Token: ' + data.link_token);
            linkPlaidAccount(data.link_token);
        },
        error: function (err) {
            console.log('Error creating link token.');
            const errMsg = JSON.parse(err);
            alert(err.error_message);
            console.error("Error creating link token: ", err);
        }
    });
}



function getInvestmentHoldings(itemId) {
    var body = {
        itemId: itemId,
    };
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: "/getInvestmentHoldings",
        type: "POST",
        data: body,
        dataType: "json",
        success: function (data) {
            console.log("Plaid holdings successfully imported.");
        },
        error: function (err) {
            const errMsg = JSON.parse(err);
            alert(err.error_message);
            console.error("Error importing holdings from Plaid: ", err);
        }
    });
}
