jQuery(document).ready(function ($) {
  $("#search-input").keyup(function () {
    var searchQuery = $(this).val();
    $.ajax({
      url: ajaxurl, // WordPress AJAX URL
      type: "POST",
      data: {
        action: "custom_search_action", // AJAX action name
        search_query: searchQuery,
      },
      success: function (response) {
        console.log(response);
        $(".card-wrapper").empty();
        $(".card-wrapper").html(response);
      },
    });
  });
});
