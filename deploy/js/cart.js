var ajax = {
  get : function(url, query, callback) {
    jQuery.ajax({type: "POST", url: url, data: query, success: function(response) { callback(response); } });
  },
  send : function(url, query) {
    jQuery.ajax({type: "POST", url: url, data: query});
  }
};

var admin = {
  'delete' : function(path) {
    if (confirm('Are you sure you want to delete this item?')) {
      document.location = path;
    }
  }
};

var cart = {
  add : function(id, sku) {
    var $size = $('#size-' + id).val();
    if ($size !== "null") {
      ajax.get('/cartapi.php', '&a=add&size=' + $size + '&id=' + id + '&sku=' + sku, function(json) {
        if (json.success === 'true') {
          if (json.itemcount === 1) {
            $('#cart-text').html('<span id="item-count">' + json.itemcount + '</span> items in cart</a>');
          } else {
            $('#item-count').html(json.itemcount);
          }
          alert('Item has been added to your cart!');
        } else {
          alert('errors');
        }
      });
    } else {
      alert('You must select a size.');
    }
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
        $('#item-count').html(json.itemcount);
        $('#cart-subtotal').html(json.subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        if (json.itemcount == 0) {
          $('#cart-table-body').html('<tr><td align="center" colspan="5">No items in cart.</td></tr><tr class="subtotal"><td colspan="4">Subtotal:</td><td>$0.00</td></tr>');
          $('#btn-checkout').remove();
        }
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
        var subtotal = 0;
        $.each(json.totals, function(key, value) {
          subtotal += value;
          value = value.toFixed(2);
          $('#total-price-' + key).html(value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });
        subtotal = subtotal.toFixed(2);
        $('#cart-subtotal').html(subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        $('#item-count').html(json.itemcount);
        alert('Item quantity has been updated!');
      } else {
        alert('There was an error updating the item quanitity.  Please try again.');
      }
    });
  }
};

var catalog = {
  multiview : {
    load : function(img) {
      $('.gallery-image img').attr('src', img);
    }
  }
}

var dialog = {
  close : function() {
    $('#modal-blanket').css('display','none');
    $('#dialog').css('display','none');
  },
  open : function() {
    $('#modal-blanket').css('display','block');
    $('#dialog').css({
      'display' : 'block',
      'left' : ($(document).width() / 2) - $('#dialog').width() / 2,
      'top' : ((($(document).height() / 2) - $('#dialog').height() / 2) * .7)
    });
    $('#dialog').html();
  }
}
