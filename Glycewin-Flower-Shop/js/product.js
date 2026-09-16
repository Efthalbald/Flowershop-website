/*==========================================
    PRODUCT DETAILS INTERACTION
==========================================*/

/* ---------- IMAGE GALLERY ---------- */

const mainImage = document.querySelector(".main-image");

const thumbnails = document.querySelectorAll(".thumbnails img");

thumbnails.forEach(image=>{

    image.addEventListener("click",()=>{

        mainImage.src=image.src;

        mainImage.style.opacity="0";

        setTimeout(()=>{

            mainImage.style.opacity="1";

        },120);

    });

});


/* ---------- QUANTITY ---------- */

const minus=document.querySelector(".counter button:first-child");

const plus=document.querySelector(".counter button:last-child");

const quantity=document.querySelector(".counter input");

let value=1;

plus.addEventListener("click",()=>{

    value++;

    quantity.value=value;

});

minus.addEventListener("click",()=>{

    if(value>1){

        value--;

        quantity.value=value;

    }

});


/* ---------- ORDER BUTTON ---------- */

const orderBtn=document.querySelector(".actions a:first-child");

orderBtn.addEventListener("mouseenter",()=>{

    orderBtn.style.transform="translateY(-5px) scale(1.03)";

});

orderBtn.addEventListener("mouseleave",()=>{

    orderBtn.style.transform="translateY(0) scale(1)";

});


/* ---------- RELATED PRODUCTS ---------- */

const related=document.querySelectorAll(".related-card");

related.forEach(card=>{

    card.addEventListener("mouseenter",()=>{

        card.style.transform="translateY(-10px)";

    });

    card.addEventListener("mouseleave",()=>{

        card.style.transform="translateY(0)";

    });

});


/* ---------- FADE IN ---------- */

window.addEventListener("load",()=>{

    document.querySelector(".product-card").style.opacity="1";

    document.querySelector(".product-card").style.transform="translateY(0)";

});