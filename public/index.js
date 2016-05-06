
$(document.body).ready(function () {
    $(document).on("click", "#showNewAchievement", function (event) {
        $("#showNewAchievement").hide();
        $("#hideNewAchievement").show();
        $("#newAchievement").show();
    });
    $(document).on("click", "#hideNewAchievement", function (event) {
        $("#showNewAchievement").show();
        $("#hideNewAchievement").hide();
        $("#newAchievement").hide();
    });
});
