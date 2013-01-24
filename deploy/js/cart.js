var ajax = {
  get : function(url, query, callback) {
    jQuery.ajax({type: "POST", url: url, data: query, success: function(response) { callback(response); } });
  },
  send : function(url, query) {
    jQuery.ajax({type: "POST", url: url, data: query});
  }
};

var admin = {
  delete : function(path) {
    if (confirm('Are you sure you want to delete this item?')) {
      document.location = path;
    }
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
      } else {
        alert('errors');
      }
    });
  },
  removerow : function(id) {
    $('#cart-table #item-' + id).remove();
  },
  update : function(id, quantity) {
    ajax.get('/cartapi.php', '&a=update&id=' + id + '&quantity=' + quantity, function(json) {
      if (json.success === 'true') {
        alert('Item quantity has been updated!');
      } else {
        alert('errors');
      }
    });
  }
};
