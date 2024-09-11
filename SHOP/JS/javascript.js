//-----------------------------Mo dong form----------------------------------------------
const address_btn = document.querySelector('#address_form')
//console.log(address_btn)
address_btn.addEventListener("click", function () {
    document.querySelector('.address_form').style.display = "flex"
})
const close_btn = document.querySelector('#close_form');
close_btn.addEventListener("click", function (event) {
    event.stopPropagation(); // Ngăn chặn sự kiện click từ việc lan truyền qua phần tử #address_form
    document.querySelector('.address_form').style.display = "none";
});
//-----------------------------Xu ly nut button right------------------------------------
const btn_right = document.querySelector('.fa-chevron-right')
const btn_left = document.querySelector('.fa-chevron-left')
const imgNumber = document.querySelectorAll('.slider_content_left_top img')
let index = 0
//console.log(imgNumber.length)
btn_right.addEventListener("click", function () {
    index = index + 1
    if (index > imgNumber.length - 1) {
        index = 0
    }
    document.querySelector(".slider_content_left_top").style.right = index * 100 + "%"
})
btn_left.addEventListener("click", function () {
    index = index - 1
    if (index <= 0) {
        index = imgNumber.length - 1
    }
    document.querySelector(".slider_content_left_top").style.right = index * 100 + "%"
})
//------------------------Xu ly click btn_bottom-------------------------------------
const imgNumberLi = document.querySelectorAll('.slider_content_left_bottom li')
//console.log(imgNumberLi)    

//console.log(img_active)    
imgNumberLi.forEach(function (image, index) {
    // console.log(image,index)
    image.addEventListener("click", function () {
        remove_active()
        document.querySelector(".slider_content_left_top").style.right = index * 100 + "%"
        image.classList.add("active")
    })
})
function remove_active() {
    let img_active = document.querySelector('.active')
    img_active.classList.remove("active")
}
//---------------------------------TẠO SLIDE ĐỘNG--------------------
function image_auto() {
    index = index + 1
    if (index > imgNumber.length - 1) {
        index = 0
    }
    remove_active()
    document.querySelector(".slider_content_left_top").style.right = index * 100 + "%"
    imgNumberLi[index].classList.add("active")
}
setInterval(image_auto, 5000)
//-----------------------------XỬ LÝ HIỆU ỨNG TRƯỢT CHO SẢN PHẨM------------------------
// Lấy các phần tử cần thiết
const btn_right_2 = document.querySelector('.fa-chevron-right_2');
const btn_left_2 = document.querySelector('.fa-chevron-left_2');
// console.log(btn_right_2)
// console.log(btn_left_2)
const imgNumber_2 = document.querySelectorAll('.main_products')
//console.log(imgNumber_2.length)
btn_right_2.addEventListener("click", function () {
    index = index + 1
    if (index > imgNumber_2.length - 1) {
        index = 0
    }
    document.querySelector(".container_slider_main_products").style.right = index * 100 + "%"
})
btn_left_2.addEventListener("click", function () {
     index = index - 1
    if (index < 0) {
        index = 0
    }
    document.querySelector(".container_slider_main_products").style.right = index * 100 + "%"
})

// detail.js
document.addEventListener("DOMContentLoaded", function () {
    const addressForm = document.getElementById('address_form');
    const closeFormButton = document.getElementById('close_form');
    const addressFormContent = document.querySelector('.address_form_content');

    addressForm.addEventListener('click', function () {
        addressFormContent.style.display = 'block';
    });

    closeFormButton.addEventListener('click', function () {
        addressFormContent.style.display = 'none';
    });
});


