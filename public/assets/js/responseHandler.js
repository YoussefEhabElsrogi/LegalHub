function handleResponse(response) {
    if (response.status === "Nothing Found") {
        $("#status-message")
            .removeClass("d-none")
            .text("لا يوجد نتائج بحث")
            .show();
        $("#ajax-search_result").html("");
    } else {
        $("#status-message").addClass("d-none").hide();
        $("#ajax-search_result").html(response.html);
    }
}
