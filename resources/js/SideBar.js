$(function () {
   

    const headerContainer = $('#header');
    const containerMain = $('#containerMain');
    const hamburgerBtn = $('#hamburger');
    const closeSidebar = $('#closeSidebar');

    const compressedSidebar = $('#compressSidebar');

    const itemsHide = $('.hidden');



    hamburgerBtn.on('click', function(){

        if(headerContainer.hasClass('compress-sidebar')){
            headerContainer.removeClass('compress-sidebar');
            containerMain.removeClass('compress-main');
            itemsHide.removeClass('active');
        }
        headerContainer.toggleClass('movil-compress');

    })


    closeSidebar.on('click', function(){
        headerContainer.removeClass('movil-compress');
    });

    compressedSidebar.on('click', function(){
        headerContainer.toggleClass('compress-sidebar');
        containerMain.toggleClass('compress-main');
        itemsHide.toggleClass('active'); 
    })

    






});