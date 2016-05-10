/**
 * Created by Julien on 21-04-16.
 */
$(document).ready(function() {pagintest();});
function pagintest() {
    //how much items per page to show
    var show_per_page = 9;
    //getting the amount of elements inside content div
    var number_of_items = $('.store').children().size();
    //calculate the number of pages we are going to have
    var number_of_pages = Math.ceil(number_of_items / show_per_page);

    //set the value of our hidden input fields
    $('#current_page').val(0);
    $('#show_per_page').val(show_per_page);

    //now when we got all we need for the navigation let's make it '

    /*
     what are we going to have in the navigation?
     - link to previous page
     - links to specific pages
     - link to next page
     */
    if (number_of_pages == 0) {
        number_of_pages = 1;
    }
    if (number_of_items == 0) {
        $("#nothing").show();
    }

    var current_link = 1;
    var navigation_html = '<div id="navig"><a class="previous_link" href="javascript:first('+number_of_pages+');">Début</a>';
    navigation_html += '<a class="previous_link" href="javascript:previous('+number_of_pages+');">Précédent</a>';
    navigation_html += '<span id="numpages">' + current_link + ' sur ' + number_of_pages + '</span>';
    navigation_html += '<a class="next_link" href="javascript:next(' + (number_of_pages) + ');">Suivant</a>';
    navigation_html += '<a class="next_link" href="javascript:end(' + (number_of_pages - 1) + ');">Fin</a></div>';
    $('#page_navigation').html(navigation_html);

    //add active_page class to the first page link
    $('#page_navigation .page_link:first').addClass('active_page');

    //hide all the elements inside content div
    $('.store').children().css('display', 'none');

    //and show the first n (show_per_page) elements
    $('.store').children().slice(0, show_per_page).css('display', 'block');

}

function previous(number_of_pages){

    new_page = parseInt($('#current_page').val()) - 1;
    //if there is an item before the current active link run the function
    if(new_page >= 0){
        document.getElementById("numpages").innerHTML = (new_page + 1) + ' sur ' + number_of_pages;
        go_to_page(new_page);
    }

}

function first(number_of_pages) {

    new_page = 0;
    document.getElementById("numpages").innerHTML = (new_page + 1) + ' sur ' + number_of_pages;
    go_to_page(new_page);
}

function end(number_of_pages) {

    new_page = number_of_pages;
    document.getElementById("numpages").innerHTML = (new_page+1) + ' sur ' + (number_of_pages +1);
    go_to_page(new_page);

}
function next(number_of_pages){
    new_page = parseInt($('#current_page').val()) + 1;
    //if there is an item after the current active link run the function
    if(new_page < number_of_pages){
        document.getElementById("numpages").innerHTML = (new_page + 1) + ' sur ' + number_of_pages;
        go_to_page(new_page);
    }

}
function go_to_page(page_num){
    //get the number of items shown per page
    var show_per_page = parseInt($('#show_per_page').val());

    //get the element number where to start the slice from
    start_from = page_num * show_per_page;

    //get the element number where to end the slice
    end_on = start_from + show_per_page;

    //hide all children elements of content div, get specific items and show them
    $('.store').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

    /*get the page link that has longdesc attribute of the current page and add active_page class to it
     and remove that class from previously active page link*/
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');

    //update the current page input field
    $('#current_page').val(page_num);
}