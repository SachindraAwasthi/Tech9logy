require(['jquery', 'owlcarousel'], function ($) {
    $(document).ready(function () {

        var owl = $('.diaries-slider');
          owl.owlCarousel({
                margin:10,
                loop: true,
                nav:true,
                dot:false,
                responsive: {
                    0: {
                        items: 2
                    },
                    639: {
                        items: 3
                    },

                    1200: {
                        items: 5
                    }

                }
            });

        var owl = $('.top-seller-slider');
            owl.owlCarousel({
                margin: 30,
                loop: true,
                nav:true,
                dot:false,
                responsive: {
                    0: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },

                    1201: {
                        items: 3
                    },
                    1601: {
                        items: 4
                    },
                    1921: {
                        items: 5
                    }
                }
            });

            var owl = $('.new-arrival-slider');
            owl.owlCarousel({
                margin: 30,
                loop: true,
                nav:true,
                dot:false,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },

                    1201: {
                        items: 3
                    },
                    1601: {
                        items: 4
                    },
                    1921: {
                        items: 5
                    }
                }
            });

            var owl = $('.rc-view');
            owl.owlCarousel({
                margin: 30,
                loop: true,
                nav:true,
                dot:false,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },

                    1201: {
                        items: 3
                    },
                    1601: {
                        items: 4
                    },
                    1921: {
                        items: 5
                    }
                }
            });
    });
});