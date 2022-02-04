<div>
 <button class="inc button" wire:click="decrQty({{ $quantity }})">-</button>
   <input type="number" class="qty-input" size="5" wire:model="quantity"  wire:change="updateCart"> 
 <button class="dec button"  wire:click="incrQty({{ $quantity }})">+</button>
</div>


<script>
$(".button").on("click", function() {

  var $button = $(this);
  var oldValue = $button.parent().find("input").val();

  if ($button.text() == "+") {
      var newVal = parseFloat(oldValue) + 1;
    } else {
   
    if (oldValue > 0) {
      var newVal = parseFloat(oldValue) - 1;
    } else {
      newVal = 0;
    }
  }

  $button.parent().find("input").val(newVal);

});
</script>
