const setup = () => {
    function getSidebarStateFromLocalStorage() {
        return true;
    }

    return {
        loading: true,
        isSidebarOpen: true,
        toggleSidbarMenu() {
            this.isSidebarOpen = !this.isSidebarOpen;
        },
        isSettingsPanelOpen: false,
        isSearchBoxOpen: false,
    };
};
function app() {
    return {
        isOpen: false,
        colors: [
            "#2196F3",
            "#009688",
            "#9C27B0",
            "#FFEB3B",
            "#afbbc9",
            "#4CAF50",
            "#2d3748",
            "#f56565",
            "#ed64a6",
        ],
        colorSelected: "#2196F3",
    };
}

// $(function () {
//     $('input[name="datetimes"]').daterangepicker({
//         timePicker: true,
//         startDate: moment().startOf("hour"),
//         endDate: moment().startOf("hour").add(32, "hour"),
//         locale: {
//             format: "M/DD hh:mm A",
//         },
//     });
// });

// Custom select Dropdown Js
if (document.querySelectorAll(".wrapper-dropdown")) {
    const selectedAll = document.querySelectorAll(".wrapper-dropdown");

    selectedAll.forEach((selected) => {
        const optionsContainer = selected.children[2];
        const optionsList = selected.querySelectorAll("div.wrapper-dropdown li");

        selected.addEventListener("click", () => {
            let arrow = selected.children[1];

            if (selected.classList.contains("active")) {
                handleDropdown(selected, arrow, false);
            } else {
                let currentActive = document.querySelector(".wrapper-dropdown.active");

                if (currentActive) {
                    let anotherArrow = currentActive.children[1];
                    handleDropdown(currentActive, anotherArrow, false);
                }

                handleDropdown(selected, arrow, true);
            }
        });

        // update the display of the dropdown
        for (let o of optionsList) {
            o.addEventListener("click", () => {
                selected.querySelector(".selected-display").innerHTML = o.innerHTML;
            });
        }
    });

    // check if anything else ofther than the dropdown is clicked
    window.addEventListener("click", function (e) {
        if (e.target.closest(".wrapper-dropdown") === null) {
            closeAllDropdowns();
        }
    });

    // close all the dropdowns
    function closeAllDropdowns() {
        const selectedAll = document.querySelectorAll(".wrapper-dropdown");
        selectedAll.forEach((selected) => {
            const optionsContainer = selected.children[2];
            let arrow = selected.children[1];

            handleDropdown(selected, arrow, false);
        });
    }

    // open all the dropdowns
    function handleDropdown(dropdown, arrow, open) {
        if (open) {
            arrow.classList.add("rotated");
            dropdown.classList.add("active");
        } else {
            arrow.classList.remove("rotated");
            dropdown.classList.remove("active");
        }
    }
}

var swiper = new Swiper(".mySwiperTestimonial", {
    spaceBetween: 52,
    slidesPerView: 1,
    navigation: {
        prevEl: ".slidePrev-btn",
        nextEl: ".slideNext-btn",
    },
});
var swiper2 = new Swiper(".swiperReview", {
    slidesPerView: 1,
    navigation: {
        prevEl: ".slidePrev-btn1",
        nextEl: ".slideNext-btn1",
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1280: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
});

var swiper3 = new Swiper(".swiperCompanies", {
    slidesPerView: 1,
    navigation: {
        prevEl: ".slidePrev-btn2",
        nextEl: ".slideNext-btn2",
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1280: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
});


var swiper3 = new Swiper(".swiperCompaniesMost", {
    slidesPerView: 1,
    navigation: {
        prevEl: ".slidePrev-btn3",
        nextEl: ".slideNext-btn3",
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1280: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
});