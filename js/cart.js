var ajax = {
  get : function(url, query, callback) {
    jQuery.ajax({type: "POST", url: url, data: query, success: function(response) { callback(response); } });
  },
  send : function(url, query) {
    jQuery.ajax({type: "POST", url: url, data: query});
  }
};

var cart = {
  add : function(id) {
    ajax.get('/cartapi.php', '&a=add&size=&id=' + id, function(json) {
      if (json.success === 'true') {
        alert('Item has been added to your cart!');
      } else {
        alert('errors');
      }
    });
  },
  clear : function(id) {
    ajax.get('/cartapi.php', '&a=clear', function(json) {
      if (json.success === 'true') {
        alert('Your cart has been cleared.');
      } else {
        alert('errors');
      }
    });
  },
  remove : function(id, row) {
    ajax.get('/cartapi.php', '&a=remove&id=' + id, function(json) {
      if (json.success === 'true') {
        var itemcount = parseInt($('#item-count').html()) - 1;
        $('#item-count').html(itemcount);
        cart.removerow(row);
        alert('Item has been removed from your cart!');
      } else {
        alert('errors');
      }
    });
  },
  removerow : function(id) {
    $('#cart-table #item-' + id).remove();
  },
  update : function() {
    ajax.get('/cartapi.php', '&a=update', function(json) {
      if (json.success === 'true') {
      } else {
        alert('errors');
      }
    });
  }
};
