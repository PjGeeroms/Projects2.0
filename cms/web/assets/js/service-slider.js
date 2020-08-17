$('.service-showcase').slick({
    responsive: [
        {
            breakpoint: 9999,
            settings: "unslick"
        },
        {
            breakpoint: 680,
            settings: {
                dots: true,
                infinite: true,
                slidesToShow: 1,
                centerMode: 1,
                adaptiveHeight: true,
            }
        },

    ]
});