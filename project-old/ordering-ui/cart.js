var check = false;
var items = 0;
function changeVal(el) {
  var qt = parseFloat(el.parent().children(".count").html());
  var price = parseFloat(el.parent().siblings(".prices").children(".amount").html());
  var eq = Math.round(price * qt * 100) / 100;
  el.parent().siblings(".prices").children(".full-price").html(eq);
  
  changeTotal();            
}


function changeTotal() {
  
  var price = 0;
  var total = 0;

$(".full-price").each(function(index){
  price += parseFloat($(".full-price").eq(index).html());
});
price = Math.round(price * 100) / 100;
var fullPrice = Math.round(price *100) / 100;

if(price == 0) {
  fullPrice = 0;
}

$(".total-amount").html("$" + fullPrice);
$("#items").html(items);
}

  
  $(".remove").click(function(){
    var el = $(this);
    items =  parseFloat(el.parent().children(".count").html());
    items = Math.round(items * 100) /100;
      console.log(items);
    el.parent().parent().addClass("remove");
    window.setTimeout(
      function(){
        el.parent().parent().slideUp('fast', function() { 
          el.parent().parent().remove(); 
          if($(".product").length == 0) {
            if(check) {
              $("#cart").html("<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>");
            } else {
              $("#cart").html("<h1>No products!</h1>");
            }
          }
          changeTotal(); 
        });
      }, 200);
  });
  
  $(".btn").click(function(){
    $(this).parent().children(".count").html(parseInt($(this).parent().children(".count").html()) + 1);
    items++;
    $(this).parent().siblings(".prices").children(".full-price");
    var el = $(this);
    window.setTimeout(function(){el.parent().siblings(".prices").children(".full-price"); changeVal(el);}, 150);
  });
  
  $(".minus").click(function(){
    
    child = $(this).parent().children(".count");
    
    if(parseInt(child.html()) > 0) {
      child.html(parseInt(child.html()) - 1);
      items--;
    }
    
    $(this).parent().siblings(".prices").children(".full-price");
    
    var el = $(this);
    window.setTimeout(function(){el.parent().siblings("prices").children(".full-price"); changeVal(el);}, 150);
  });
  
  
  $(".Action").click(function(){
    check = true;
    $(".remove").click();
  });