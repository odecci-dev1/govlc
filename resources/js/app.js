import './bootstrap';
import '../css/app.css'; 

// module.exports = {
//     // ...
//     module: {
//      rules: [
//       {
//        test: /\.scss$/,
//        use: ["style-loader", "css-loader", "sass-loader"]
//       },
//       // ...
//      ]
//     }
//    };

// import variables from '../scss/modules/abstracts/_variables.scss';
// import { primaryColor } from '../scss/modules/abstracts/_variables.scss'
// I used data-attribute for more efficiency


// noDropdownButton.addEventListener("click", () => {
//     noDropdownButton.classList.toggle("focus")
// noDropdownButton.style.backgroundColor = '#D6A330';

// })

document.addEventListener("click", e => {

    const dashboard = document.querySelector(".main-dashboard")

    // When a link is clicked, toggle the submenu
    const isDropdownButton = e.target.matches("[data-dropdown-button]")

    // Ignore the click in the submenus (to not close when the dropdown is clicked inside the submenu)
    if (!isDropdownButton && e.target.closest("[data-dropdown]") != null) return



    // If this is a dropdown button, I want toggle submenu by clicking
    let currentDropdown
    if (isDropdownButton) {

        currentDropdown = e.target.closest("[data-dropdown]")
            // Hide or Show submenu toggle
        currentDropdown.classList.toggle("showMenu")
    }

    // Get rid off the submenus that are not open (closing submenus that are not clicked)

    // Getting all the submenus and looping in each one and close them
    document.querySelectorAll("[data-dropdown].showMenu").forEach(dropdown => {

        // If this dropdown is equal to the current dropdown then add a z-index of 1 to prevent overlapping...   
        if (dropdown === currentDropdown) {
            dropdown.style.backgroundColor = '#D6A330';
            dropdown.style.zIndex = 9
            dashboard.style.zIndex = -1
            return
        }
        // Otherwise, close it
        dashboard.style.zIndex = ''
        dropdown.style.backgroundColor = '';
        dropdown.style.zIndex = ''
        dropdown.classList.remove("showMenu")

        return

    })


})


























// for (let i = 0; i < links.length; i++) {
//     const allLinks = links[i];
//     allLinks.addEventListener('click', () => {

//         let subMenu = document.querySelectorAll('.sub-menu');


//         // for (let i = 0; i < subMenu.length; i++) {

//         //     const subMenuItem = subMenu[i];

//         //     subMenuItem.forEach((item, index) => {

//         //         (item + index).classList.toggle('showMenu');

//         //     });



//         //     // subMenu[i].addEventListener('click', () => {
//         //     //     let subMenuItem = e.target.parentNode.firstChild;
//         //     //     console.log("Clicked")
//         //     //     subMenuItem.classList.toggle('showMenu');

//         //     // });

//         // }


//     })

// }

















// for (let i = 0; i <= links.length; i++) {

//     links[i].addEventListener('click', (e) => {

//         let subMenuParent = document.querySelectorAll(".sub-menu");

//             for (let i = 0; i <= subMenuParent.length; i++) {

//                 // const element = array[i];
//                 console.log(subMenuParent);
//                 subMenuParent[i].classList.toggle('showMenu')

//             }

//     })

// }