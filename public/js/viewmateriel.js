$('.M-carousel').owlCarousel({
    loop:true,
    margin:10,
    dots:false,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

/*const zoom = mediumZoom()
zoom.attach('#image-1', '#image-2','#image-3')
zoom.attach(document.querySelectorAll('[data-zoomable]')
)*/
