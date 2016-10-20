/**
 * Created by GitzJoey on 10/20/2016.
 */

window.ParsleyConfig = {
    successClass: "has-success",
    errorClass: "has-error",
    classHandler: function(el) {
        return el.$element.closest(".form-group");
    },
    errorsWrapper: "<span class='help-block'></span>",
    errorTemplate: "<span></span>"
};
