// When the windows size becomes too small, make pop up a burger icon and hides the categories.
function responsiveTopBar() {
    var navigationBar = document.getElementById("nav-bar");
    if (navigationBar.className === "navbar") {
        navigationBar.className += " responsive";
    } else {
        navigationBar.className = "navbar";
    }
}

// True if the add content page is show.
var addContentButtonClicked = false;

// Rotate the add content button and show the add content page.
function clickAddContent() {
    addContentButtonClicked = !addContentButtonClicked;
    var buttonClicked = document.getElementById("acb");
    var addContent = document.getElementById("acp");
    var overlay = document.getElementById("ol");
    var body = document.getElementById("main");

    if (addContentButtonClicked) {
        buttonClicked.style.transform = "rotate(45deg)";
        buttonClicked.style.right = "27px"; // Correct the gap create when the scrollbar appear or disapear. 
        addContent.style.width = "50%";
        addContent.style.overflow = "auto";
        overlay.style.display = "initial"
        body.style.overflow = "hidden";
    } else {
        buttonClicked.style.transform = "rotate(0deg)";
        buttonClicked.style.right = "10px";
        addContent.style.width = "0%";
        addContent.style.overflow = "hidden";
        overlay.style.display = "none"
        body.style.overflow = "auto";
    }
}

// Change the add content page form.
function selectSectionChange(option) {
    var date = document.getElementById("date");
    var date_inputs = date.getElementsByTagName("input");
    var radio = document.getElementById("radio");
    var pl = document.getElementById("programming_language");
    var pl_inputs = pl.getElementsByTagName("input");

    if (option.value === "experiences" || option.value === "formations") {
        date.style.display = "block";
        for (var i = 0; i < date_inputs.length; i++) {
            date_inputs[i].disabled = false;
        }
    } else {
        date.style.display = "none";
        for (var i = 0; i < date_inputs.length; i++) {
            date_inputs[i].disabled = true;
        }
    }

    if (option.value === "competences") {
        radio.style.display = "block";
    } else {
        radio.style.display = "none";
    }

    if (option.value === "projets") {
        pl.style.display = "block";
        for (var i = 0; i < pl_inputs.length; i++) {
            pl_inputs[i].disabled = false;
        }
    } else {
        pl.style.display = "none";
        for (var i = 0; i < pl_inputs.length; i++) {
            pl_inputs[i].disabled = true;
        }
    }
}

var mainValue = "";
var mainForm = "";
// Open the edit page on an element.
// Just one edit page can get open.
function editValue(value_id, form_id) {
    // Check if a edit page is open
    if (mainValue.localeCompare("") == 0) {
        mainValue = value_id;
        mainForm = form_id;
    }
    else  if (mainValue.localeCompare(value_id) != 0)
    {
        document.getElementById(mainValue).className = "value";
        document.getElementById(mainForm).className = "form_edit";
        mainValue = value_id;
        mainForm = form_id;
    }
    var value = document.getElementById(mainValue);
    var form = document.getElementById(mainForm);

    if (value.className === "value") {
        value.className += "_disable";
        form.className += "_enable";
    } else {
        value.className = "value";
        form.className = "form_edit";
    }
}