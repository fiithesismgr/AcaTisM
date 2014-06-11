/**
 * Created by Lucian Costin Ailenei on 05.06.2014.
 */

window.onload=function() {

    // get activity container
    var container = document.getElementById("activity");

    // set current tab
    var navitem = container.querySelector(".activitymain .activitycategory ul li");

    // get the current tab by id
    var ident = navitem.id.split("_")[1];

    navitem.parentNode.setAttribute("data-current",ident);

    // set current tab with class of activityActive

    navitem.setAttribute("class","activityActive");

    // hide contents that doesn't match to the current activity category
    var pages = container.querySelectorAll(".activityPage");
    for (var i = 1; i < pages.length; i++) {
        pages[i].style.display="none";
    }

    //this adds click event to tabs
    var tabs = container.querySelectorAll(".activitymain .activitycategory ul li");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].onclick=displayPage;
    }
}


// on click of one activity tab

function displayPage() {

    var current = this.parentNode.getAttribute("data-current");

    //remove class of activityActive and hide old contents
    document.getElementById("activityTab_" + current).removeAttribute("class");
    document.getElementById("activityPage_" + current).style.display="none";

    var ident = this.id.split("_")[1];

    //add class of activityActive to new active tab and show contents
    this.setAttribute("class","activityActive");
    document.getElementById("activityPage_" + ident).style.display="block";
    this.parentNode.setAttribute("data-current",ident);

}