$("ul.nav li.dropdown").hover(
    function () {
        $(this).find(".dropdown-menu").stop(true, true).delay(200).fadeIn(200);
    },
    function () {
        $(this).find(".dropdown-menu").stop(true, true).delay(200).fadeOut(200);
    }
);

$(".shop_list").slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1, 

    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ],
});

AOS.init();

// show/hide password
$(document).ready(function () {
    const show_hide_password = document.querySelector(".show_hide_password"); 
    const show_hide_password_icon = document.querySelector(".show_hide_password i");  
    const password_input = document.getElementsByClassName('.password_input');

    $(show_hide_password, show_hide_password_icon).on( "click", function () { 
         
            if ($(".password_input").attr("type") === "text") {

                $(".password_input").attr("type", "password");

                $(".show_hide_password span").text('Show Password');

                $(".show_hide_password i").addClass("fa-eye-slash");
                $(".show_hide_password i").removeClass("fa-eye");

            } else if (  $(".password_input").attr("type") === "password"    ) {

                $(".password_input").attr("type", "text");

                $(".show_hide_password span").text('Hide Password  '); 

                $(".show_hide_password i").removeClass("fa-eye-slash");
                $(".show_hide_password i").addClass("fa-eye");

            }
        }
    );
});
$(document).ready(function () {
    const show_hide_password_individual = document.querySelector(".show_hide_password_individual"); 
    const show_hide_password_icon_individual = document.querySelector(".show_hide_password_individual i");  
    const password_input_individual = document.getElementsByClassName('.password_input_individual');

    $(show_hide_password_individual, show_hide_password_icon_individual).on( "click", function () { 
         
            if ($(".password_input_individual").attr("type") === "text") {

                $(".password_input_individual").attr("type", "password");

                $(".show_hide_password_individual span").text('Show Password');

                $(".show_hide_password_individual i").addClass("fa-eye-slash");
                $(".show_hide_password_individual i").removeClass("fa-eye");

            } else if (  $(".password_input_individual").attr("type") === "password"    ) {

                $(".password_input_individual").attr("type", "text");

                $(".show_hide_password_individual span").text('Hide Password  '); 

                $(".show_hide_password_individual i").removeClass("fa-eye-slash");
                $(".show_hide_password_individual i").addClass("fa-eye");

            }
        }
    );
});

// show/hide password end

// login show/hide password
// $(document).ready(function () {
//     $("#show_hide_password i").on("click", function (event) {
//         event.preventDefault();
//         if ($("#show_hide_password input").attr("type") == "text") {
//             $("#show_hide_password input").attr("type", "password");
//             $("#show_hide_password i").addClass("fa-eye-slash");
//             $("#show_hide_password i").removeClass("fa-eye");
//         } else if ($("#show_hide_password input").attr("type") == "password") {
//             $("#show_hide_password input").attr("type", "text");
//             $("#show_hide_password i").removeClass("fa-eye-slash");
//             $("#show_hide_password i").addClass("fa-eye");
//         }
//     });
// });
// login show/hide password end

//custom input type number
// $(".btn-plus, .btn-minus").on("click", function (e) {
//     const isNegative = $(e.target).closest(".btn-minus").is(".btn-minus");
//     const input = $(e.target).closest(".input-group").find("input");
//     if (input.is("input")) {
//         input[0][isNegative ? "stepDown" : "stepUp"]();
//     }
// });
//custom input type number end

// cart system
// const service_parent = document.querySelectorAll(".service-parent");
// const cart_parent = document.querySelector(".cart-parent");
// const service_category = document.querySelector("#service-category").innerText; 
// const add_to_cart = document.querySelector(".add-to-cart");
// const total_price = document.querySelector(".total-price");


// const cart_counter_badge = document.querySelector(".cart-counter-badge");
// const full_cart_h4 = document.querySelector(".full-cart");
 

// // let serviceInCart = JSON.parse(localStorage.getItem('OrderInCart'));
// // if(!serviceInCart){
// // 	serviceInCart = [];
// // }
 
// let serviceInCart = [];

// // total price count function
// const countTotalPrice = function(){ // 4
//   let total =0;
//   serviceInCart.forEach(service =>{
//     total += service.price;
//   })
//   return total;
// }

// // add markup if service is added to cart function
// const updateOrderCartHTML = function () { // 3
//     // localStorage.setItem('OrderInCart',JSON.stringify(serviceInCart)); 

//     if (serviceInCart.length > 0) {  

       
         

//         let result = serviceInCart.map((service) => {
         
//             full_cart_h4.innerText = "Your Order List";

//             return `
              
//              <div class="list-group-item list-group-item-action shadow" aria-current="true">
                             
//                         <div class="lItem d-flex w-100 justify-content-between " >
//                             <h5 class="mb-1 ps-2">Hair Styling</h5>
//                             <span class="remove-btn" data-bs-dismiss="lItem" id="${service.id}">
//                                 <i class="fa-solid fa-minus fa-sm"></i>
//                             </span>
//                         </div>
//                         <p class="mb-1 ps-2">${service.name}</p>
//                         <div class="d-flex justify-content-between align-items-center" >
//                             <small class="quanity">
//                                 <div class="input-group inline-group flex-nowrap align-items-center">
                                
//                                     <div class="input-group-prepend">
//                                         <button class="btn-outline  custom-hover-1 p-2 fa fa-minus btn-minus" data-id="${service.id}">  </button>
//                                     </div>

//                                     <span class="service-counter px-3">${service.count}  </span>person


                            
//                                     <div class="input-group-append">
//                                         <button class="btn-outline custom-hover-1 p-2 fa fa-plus btn-plus " data-id="${service.id}"></button>
//                                     </div>
                                     
//                                 </div>
//                             </small>
//                             <small> ${service.price} </small>
//                         </div>
//                     </div>
//                     <div class="total-price"> 
//                 </div>
//                     ` 
//         }); 
//         cart_parent.innerHTML = result.join(''); 
//         document.querySelector(".checkout-btn").classList.remove("visually-hidden");
//         total_price.innerHTML = 'Total Price $'+ countTotalPrice()+'=/';
    
//         // remove product from cart if remove button is clicked 
//         const remove_btn = document.querySelector(".remove-btn");
//          remove_btn.addEventListener('click', (e)=>{
//             console.log(e.target.id);
//             for (let i = 0; i < serviceInCart.length; i++) {
//                 const isPlusButton = e.target.classList.contains('btn-plus');
//                 // console.log(e.target.dataset.id);
//                 if(serviceInCart[i].id == e.target.id){
//                     console.log("pls click");
//                 }
                
                 
//             } 
//         //   updateOrderCartHTML(); 
//         })

//         // cartSumPrice.innerHTML = '$' + countTheSumPrice(); 
         

//     } else {
//         document.querySelector(".checkout-btn").classList.add("visually-hidden");
//         cart_parent.innerHTML = " <h4> Your order list is Empty</h4>";
//     }
// };
// // add product to cart if add to cart clicked
// function updateServiceInCart(service) { //2
//     for (let i = 0; i < serviceInCart.length; i++) {   
//         if (serviceInCart[i].id == service.id) {
//             serviceInCart[i].count += 1;
//             serviceInCart[i].price = serviceInCart[i].basePrice * serviceInCart[i].count; 
//             return;
//         }  
//     } 
//     serviceInCart.push(service); 
  
// }

// // add event listener for all service add to cart btn
// service_parent.forEach((service) => {  // 1
//     service.addEventListener("click", (e) => {
//       // console.log('add to cart clicked')
//         if (e.target.classList.contains("add-to-cart")) {
//             const serviceID = e.target.dataset.serviceId;  
//             const service_title = service.querySelector(".service-title").innerHTML;
//             const price_value = service.querySelector(".price-value").innerHTML.slice(1); 

//             let serviceToCart = {
//                 id: serviceID,
//                 name: service_title,
//                 count: 1,
//                 price: +price_value,
//                 basePrice: +price_value,
//             };
//             // console.log(serviceToCart);

//             updateServiceInCart(serviceToCart);
//             updateOrderCartHTML();
//         }
//     });
// });

 
// // incremeant/decrement button
// cart_parent.addEventListener('click', (e)=>{
//   const isPlusButton = e.target.classList.contains('btn-plus'); 
//   const isMinusButton = e.target.classList.contains('btn-minus');     
//   if(isPlusButton|| isMinusButton){ 
//     for(let i=0; i<serviceInCart.length; i++){
//       if(serviceInCart[i].id == e.target.dataset.id){
         
//         if(isPlusButton){
//             // console.log("pls click")
//           serviceInCart[i].count += 1;

//         }else if(isMinusButton){
//             // console.log("mns click")
//           serviceInCart[i].count -= 1;
//         }
//         serviceInCart[i].price = serviceInCart[i].basePrice * serviceInCart[i].count;
        
//       }
       
//     if(serviceInCart[i].count <= 0 ){
//         console.log('iszero')
//         serviceInCart.splice(i, 1); 
//       }
//     }
  
   
//     updateOrderCartHTML();
//   }
// });
// updateOrderCartHTML();


// cart system end
