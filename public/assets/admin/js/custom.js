function flashMessage_success(message){
    $.smallBox({
        title : "Success!",
        content : message,
        color : "#739E73",
        iconSmall : "fa fa-check tada animated",
        timeout: 5000,
    });
}
function flashMessage_information(message){
    $.smallBox({
        title : "Information!",
        content : message,
        color : "#3276B1",
        iconSmall : "fa fa-bell swing animated",
        timeout: 5000,
    });
}
function flashMessage_danger(message){
    $.smallBox({
        title : "Danger!",
        content : message,
        color : "#C46A69",
        iconSmall : "fa fa-warning flip animated",
        timeout: 5000,
    });
}