function addToCart(id) {
  $.post('myHelper.php', {
      'id': id,
      'action': 'addToCart'
  }, function(data) {
    if(data){
      alert(data);
      location.reload();
    } else {
      location.replace('index.php?tab=vegetable')
    }
  })
}

function orderCart(totals) {
  $.post('./cart/saveOrder.php', {
    'totals': totals
    
  }, function(data) {
    if(data){
      alert(data);
      location.replace('index.php?tab=login')
    } else {
      location.replace('index.php?tab=vegetable')
    }
  })
}