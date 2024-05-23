  
            

//

document.addEventListener("DOMContentLoaded", function(){
   //
   class Product{
      constructor(id, name, price, madein,itemtt,image){
         this.id = id;
         this.name = name;
         this.price = price;
         this.madein = madein;
         this.image = image;
         this.itemtt = 1;
      };
   };

// edit quantity item
const EditQuantity = () => {
   $(document).on('click', '.item_box_select .item_box_1_2', function (e) {
      e.preventDefault();
      let btn = $(this);
      let input = btn.closest('.item_box_select').find('input[type="number"]');
      input.removeAttr('readonly');
      input.focus();
   });
};
//
const ClickEditQuantity = () =>{
   $(document).on('click', '.item_box_select .item_box_1_2', function (e){

   });
}
//
$(document).ready(function(){
//
ClickEditQuantity();
   
// 
   const handlecartNumber = () =>{
      //
      
      let cartdata = [];
      let cartstring = localStorage.getItem('cart');
      if(cartstring){
         cartdata = JSON.parse(cartstring);
      }
      let buttonInCart = document.getElementById("buttonincart");
      document.getElementById("buttonincart").innerHTML =`Basket (${cartdata.length})`;
      //
      if(cartdata.length == 0 ){
      document.getElementById("numbercart2").innerHTML = `${cartdata.length} items in cart!` ;
   }else{
      let itemincart = document.getElementById("infornumberitem").innerHTML = `${cartdata.length} items in cart!`;
      document.getElementById("numbercart2").innerHTML = '';
      cartdata.forEach(function(item){
         let html = `<div class="row ifcart">
                        <div class="col-3">
                           <p class="">
                              <img class ="imgcartsz"  src="${item.image}" alt="">
                           </p>  
                        </div>
                        <div class=" incartif col-9">
                           <h6 class="">
                              <b class ="incartname">${item.name}</b>
                           </h6>
                              <div  class ="incartprice producegia" >${item.price}$ /ib</div>
                              <div  class ="incartmadein ">${item.madein}</div>
                        </div>
                     </div>`;
                  $(".inforcart").append(html);   
          });
      };
      //
      if(cartdata.length ==0){
         document.getElementById("item_box_img").innerHTML = `${cartdata.length} items in cart!` ;
      }else{
         document.getElementById("item_box_img") .innerHTML ="";
         cartdata.forEach(function(item){
            let html = `
               <div class = " item_box">
                  <ul class ="item_box_1" type ="none" >
                  <li><img class="item_box_img2"  src="${item.image}" alt="Product Image"></li>
                  <li><div class ="item_box_name "><h5 class ="incartname">${item.name}</h5></div>
                     <div  class =" item_box_price incartprice producegia" >$${item.price} /Ib</div>
                     <div class ="item_box_select">
                        <ul class ="item_box_1" type ="none">
                           <li><div><h5 class ="item_box_1_1"> <input class ="item_box_1_1_1" type="number" min ="1" max ="1000" readonly value ="${item.itemtt}"></h5></div></li>
                           <li><h6 class ="item_box_1_1_1_2">Ib</h6></li>
                           <li><svg id ="item_box_1_2" class =" item_box_1_2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M20.7728 9.14861C21.1633 8.75808 21.7965 8.75808 22.187 9.14861L23.6012 10.5628C23.9918 10.9533 23.9918 11.5865 23.6012 11.977L22.187 13.3913L19.3586 10.5629L18.6515 11.27L21.4799 14.0984L13.2087 22.3695L9.67319 23.0766L10.3803 19.5411L20.7728 9.14861ZM9.46073 24.1389L13.7017 23.2907L24.3083 12.6841C25.0894 11.9031 25.0894 10.6368 24.3083 9.85571L22.8941 8.4415C22.1131 7.66045 20.8467 7.66045 20.0657 8.4415L9.4591 19.0481L8.6109 23.2891L8.39844 24.3514L9.46073 24.1389Z" fill="#6D6D6D"/>
                        </svg></li>
                        </ul>
                     </div>
                  </li>
                  <li><div  class =" item_box_price_1" >$${item.price * item.itemtt }</div></li>
                  </ul>
               </div>`;
            $(".item_box_img").append(html);   
         })
      };
      //
      let monneyy = (price) => {
         return price.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
      };
      
      let subtotal = 0;
      let shipping = 5;
      let tax = 10;
      cartdata.forEach(function(item){
         subtotal += parseFloat(item.price) * parseFloat(item.itemtt) ;
         console.log (monneyy(subtotal));
      })
      if(cartdata.length ==0){
         document.getElementById("subtotal").innerHTML = `$0.00` ;
         document.getElementById("shipping").innerHTML = `$0.00` ;
         document.getElementById("tax").innerHTML = `$0.00` ;
         document.getElementById("total").innerHTML = `$0.00` ;
      }else{
         document.getElementById("subtotal").innerHTML = `$${subtotal}` ;
         document.getElementById("shipping").innerHTML = `$${shipping}` ;
         document.getElementById("tax").innerHTML = `$${tax}`  ;
         document.getElementById("total").innerHTML = `$${subtotal + shipping + tax }` ;
      }
      

      //
   }
   //

   $(document).ready(function(){
      //show list ccart (batsket)
   var trigger = document.getElementById("buttonincart");
      var menuu = document.getElementById("listincart");

      trigger.addEventListener("mouseover", function(){
         menuu.style.display = "block";
      });
      trigger.addEventListener("mouseout",function(){
         menuu.style.display = "none";
      });
      menuu.addEventListener("mouseout",function(event){
         if (!event.relatedTarget || (event.relatedTarget.id !== "listincart" && !event.relatedTarget.closest("#listincart"))){
            menuu.style.display = "none";
         }
      });
      //
      handlecartNumber();
         let cartdata = [];
         let cartstring = localStorage.getItem('cart');
         if (cartstring){
               cartdata = JSON.parse(cartstring);
            }
            document.getElementById("buttonincart").innerHTML =`Basket (${cartdata.length})`;
            document.getElementById("numberitem").innerHTML = `${cartdata.length} items!`;
            
            //

   })
});
});
