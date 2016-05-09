
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
    $(document).on('click', '.showList', function (event) {
        var classLength = "showList".length;
        var inventoryID = event.target.id.substr(classLength, event.target.id.length-classLength); 
        $("#showList"+inventoryID).hide();
        $("#hideList"+inventoryID).show();
        $("#listOfAchievementCriteria"+inventoryID).show();
        
    });
    $(document).on('click', '.hideList', function (event) {
        var classLength = "showList".length;
        var inventoryID = event.target.id.substr(classLength, event.target.id.length-classLength); 
        $("#showList"+inventoryID).show();
        $("#hideList"+inventoryID).hide();
        $("#listOfAchievementCriteria"+inventoryID).hide();
        
    });
});
