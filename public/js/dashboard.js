
const setup = () => {
    function getSidebarStateFromLocalStorage() {
      // if it already there, use it
      if (window.localStorage.getItem('isSidebarOpen')) {
        return JSON.parse(window.localStorage.getItem('isSidebarOpen'))
      }

      // else return the initial state you want
      return (
       false
      )
    }

    function setSidebarStateToLocalStorage(value) {
      window.localStorage.setItem('isSidebarOpen', value)
    }

  return {
        loading: true,
        isSidebarOpen: true,
        toggleSidbarMenu() {
          this.isSidebarOpen = !this.isSidebarOpen
          setSidebarStateToLocalStorage(this.isSidebarOpen)
        },
        isSettingsPanelOpen: false,
        isSearchBoxOpen: false,
    }
}



// work with sidebar

var btn     = document.getElementById('sliderBtn'),
sideBar = document.getElementById('sideBar'),
sideBarHideBtn = document.getElementById('sideBarHideBtn');
// show sidebar
// btn.addEventListener('click' , function(){
//     if (sideBar.classList.contains('-ml-72')) {
//         sideBar.classList.replace('-ml-72' , 'ml-0');

//     };
// });

// hide sideBar
sideBarHideBtn.addEventListener('click' , function(){
    if (sideBar.classList.contains('ml-0' , 'slideInLeft')) {
        var _class = function(){
            sideBar.classList.remove('slideInLeft');
            sideBar.classList.add('slideOutLeft');

            console.log('hide');
        };
        var animate = async function(){
            await _class();

            setTimeout(function(){
                sideBar.classList.replace('ml-0' , '-ml-72');
                console.log('animated');
            } , 300);

        };

        _class();
        animate();
    };
});
// end with sidebar

// $( document ).ready(function() {
//     if ($(window).width() >= 1024) {
//         $("#sideBar").removeClass('hide-sidebar')
//     }
// });
$( document ).ready(function() {
    if ($(window).width() < 1024) {
        $("#sideBar").removeClass('animate__bounceInLeft');
    }
});
// hideSide bar on desktop
$(function() {
    $(".x-close").on('click', function(){
        // sideBar.classList.replace('lg:ml-0' , '-ml-72');
        $("#sideBar").addClass('hide-sidebar')
        $(".content-class").removeClass('content-swipe');
        $("#sideBar").removeClass('animate__bounceInLeft');

    })
    $(".x-open").on('click', function(){
        $("#sideBar").removeClass('hide-sidebar')
        $(".content-class").addClass('content-swipe')
        $("#sideBar").addClass('animate__bounceInLeft');
    })
});
$(function(){
    $('.edit-acc').on('click', function(){
        $('#defaultModal').addClass('animate__slideInDown')
    })
})
$(document).ready(function(){
    $('.popular-services-slider',).slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: $('.pp-prev'),
        nextArrow: $('.pp-next'),
        responsive: [
            {
              breakpoint: 1650,
              settings: {
                slidesToShow: 3
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1
              }
            }
          ]
    });
});

$(document).ready(function(){
    $('.custom-event-slider',).slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: $('.pp-prev1'),
        nextArrow: $('.pp-next1'),
        responsive: [
            {
              breakpoint: 1650,
              settings: {
                slidesToShow: 3
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1
              }
            }
          ]
    });
});
$(document).ready(function(){
    $('.all-service-slider',).slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        autoplay: true,
        autoplaySpeed: 2000,
    });
});





    if(document.querySelector("#profile-tab-example")){
        // create an array of objects with the id, trigger element (eg. button), and the content element
        const tabElements = [
            {
                id: 'profile',
                triggerEl: document.querySelector('#profile-tab-example'),
                targetEl: document.querySelector('#profile-example')
            },
            {
                id: 'dashboard',
                triggerEl: document.querySelector('#dashboard-tab-example'),
                targetEl: document.querySelector('#dashboard-example')
            },
            {
                id: 'settings',
                triggerEl: document.querySelector('#settings-tab-example'),
                targetEl: document.querySelector('#settings-example')
            }
            ];

            // options with default values
            const options = {
                defaultTabId: 'profile',
                activeClasses: 'text-black drk:text-blue-500 drk:hover:text-blue-400 bg-[#F3F6F9] drk:border-blue-500',
                inactiveClasses: 'text-[#B5B5C3] hover:text-[#7E8299] drk:text-gray-400 border-gray-100 hover:border-gray-300 drk:border-gray-700 drk:hover:text-gray-300',
                onShow: () => {
                    console.log('tab is shown');
                }
            };
        const tabs = new Tabs(tabElements, options);
    }


    if(document.querySelector("#profile-tab-example-1")){

        // create an array of objects with the id, trigger element (eg. button), and the content element
        const tabElements1 = [
            {
                id: 'Days',
                triggerEl: document.querySelector('#profile-tab-example-1'),
                targetEl: document.querySelector('#profile-example-1')
            },
            {
                id: 'Week',
                triggerEl: document.querySelector('#dashboard-tab-example-1'),
                targetEl: document.querySelector('#dashboard-example-1')
            },
            {
                id: 'Month',
                triggerEl: document.querySelector('#settings-tab-example-1'),
                targetEl: document.querySelector('#settings-example-1')
            },
        ];

        // options with default values
        const options1 = {
            defaultTabId: 'Days',
            activeClasses: 'text-black drk:text-blue-500 drk:hover:text-blue-400 bg-[#F3F6F9] drk:border-blue-500',
            inactiveClasses: 'text-[#B5B5C3] hover:text-[#7E8299] drk:text-gray-400 border-gray-100 hover:border-gray-300 drk:border-gray-700 drk:hover:text-gray-300',
            onShow: () => {
                console.log('tab is shown');
            }
        };
        const tabs1 = new Tabs(tabElements1, options1);
    }

    if(document.querySelector("#chart-line")){
        console.log('working')
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(152, 111, 250, 0.1)');
        gradientStroke1.addColorStop(0.2, 'rgba(152, 111, 250, 0.1)');
        gradientStroke1.addColorStop(0, 'rgba(152, 111, 250, 0.1)');
        new Chart(ctx1, {
            type: "line",
            data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#986FFA",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            }],
            },
            options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#959595',
                    font: {
                    size: 14,
                    family: "Open Sans",
                    style: 'normal',
                    lineHeight: 2
                    },
                }
                },
                x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#959595',
                    padding: 20,
                    font: {
                    size: 14,
                    family: "Open Sans",
                    style: 'normal',
                    lineHeight: 2
                    },
                }
                },
            },
            },
        });
  }
    if(document.querySelector("#myChart")){
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["SNT",	"REX",	"SAP "],
                datasets: [{
                    data: [500,	500,	500], // Specify the data values array

                    borderColor: ['#8423FF', '#20D489', '#FFC700'], // Add custom color border
                    backgroundColor: ['#8423FF', '#20D489', '#FFC700'], // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]},
            options: {
            responsive: true, // Instruct chart js to respond nicely.
            maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            cutout: 60,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#3F4254',
                    }
                }
            }
            },
        });
    }


    $('.custom-event-slider',).slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: $('.event-pp-prev'),
        nextArrow: $('.event-pp-next'),
    });

    $('.generic-event-slider',).slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: $('.event2-pp-prev'),
        nextArrow: $('.event2-pp-next'),
    });
