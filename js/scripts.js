'use strict';

const toggleHidden = (...fields) => {

  fields.forEach((field) => {

    if (field.hidden === true) {

      field.hidden = false;

    } else {

      field.hidden = true;

    }
  });
};

const labelHidden = (form) => {

  form.addEventListener('focusout', (evt) => {

    const field = evt.target;
    const label = field.nextElementSibling;

    if (field.tagName === 'INPUT' && field.value && label) {

      label.hidden = true;

    } else if (label) {

      label.hidden = false;

    }
  });
};

const toggleDelivery = (elem) => {

  const delivery = elem.querySelector('.js-radio');
  const deliveryYes = elem.querySelector('.shop-page__delivery--yes');
  const deliveryNo = elem.querySelector('.shop-page__delivery--no');
  const fields = deliveryYes.querySelectorAll('.custom-form__input');

  delivery.addEventListener('change', (evt) => {

    if (evt.target.id === 'dev-no') {

      fields.forEach(inp => {
        if (inp.required === true) {
          inp.required = false;
        }
      });


      toggleHidden(deliveryYes, deliveryNo);

      deliveryNo.classList.add('fade');
      setTimeout(() => {
        deliveryNo.classList.remove('fade');
      }, 1000);

    } else {

      fields.forEach(inp => {
        if (inp.required === false) {
          inp.required = true;
        }
      });

      toggleHidden(deliveryYes, deliveryNo);

      deliveryYes.classList.add('fade');
      setTimeout(() => {
        deliveryYes.classList.remove('fade');
      }, 1000);
    }
  });
};

const filterWrapper = document.querySelector('.filter__list');
if (filterWrapper) {

  filterWrapper.addEventListener('click', evt => {

    const filterList = filterWrapper.querySelectorAll('.filter__list-item');

    filterList.forEach(filter => {

      if (filter.classList.contains('active')) {

        filter.classList.remove('active');

      }

    });

    const filter = evt.target;

    filter.classList.add('active');

  });

}

const shopList = document.querySelector('.shop__list');
if (shopList) {

  shopList.addEventListener('click', (evt) => {

    const prod = evt.path || (evt.composedPath && evt.composedPath());;

    if (prod.some(pathItem => pathItem.classList && pathItem.classList.contains('shop__item'))) {

      const shopOrder = document.querySelector('.shop-page__order');

      document.querySelector('#productCart').value = prod[0].id;

      toggleHidden(document.querySelector('.intro'), document.querySelector('.shop'), shopOrder);

      window.scroll(0, 0);

      shopOrder.classList.add('fade');
      setTimeout(() => shopOrder.classList.remove('fade'), 1000);

      const form = shopOrder.querySelector('.custom-form');
      labelHidden(form);

      toggleDelivery(shopOrder);

      const buttonOrder = shopOrder.querySelector('#btnOrder');
      const popupEnd = document.querySelector('.shop-page__popup-end');
      const popupError = document.querySelector('.shop-page__popup-error');

      buttonOrder.addEventListener('click', (evt) => {
        console.log('321');

        form.noValidate = true;

        const inputs = Array.from(shopOrder.querySelectorAll('[required]'));

        const orderFields = Array.from(form);

        inputs.forEach(inp => {

          if (!!inp.value) {

            if (inp.classList.contains('custom-form__input--error')) {
              inp.classList.remove('custom-form__input--error');
            }

          } else {

            inp.classList.add('custom-form__input--error');

          }
        });

        if (inputs.every(inp => !!inp.value)) {

          evt.preventDefault();

          $.ajax({
            url: '/src/cart.php',
            method: "POST",
            data: new FormData(form),
            success: function (msg) {

              // console.log(msg)

              if (msg == 1) {

                toggleHidden(shopOrder, popupEnd);

                popupEnd.classList.add('fade');
                setTimeout(() => popupEnd.classList.remove('fade'), 1000);
      
                window.scroll(0, 0);
      
                const buttonEnd = popupEnd.querySelector('#btnEnd');
      
                buttonEnd.addEventListener('click', () => {

                  popupEnd.classList.add('fade-reverse');
      
                  setTimeout(() => {
      
                    window.location.href = '/';
      
                  }, 1000);
      
                });
              } else {

                toggleHidden(shopOrder, popupError);

                popupError.classList.add('fade');
                setTimeout(() => popupError.classList.remove('fade'), 1000);
      
                window.scroll(0, 0);
      
                const buttonErr = popupError.querySelector('#btnErr');
      
                buttonErr.addEventListener('click', () => {

                  popupError.classList.add('fade-reverse');
      
                  setTimeout(() => {
      
                    window.location.href = '/';
      
                  }, 1000);    

                });
              }

            },
            error: function(msg) {
                console.log('Error', msg)
            },
            contentType: false,
            processData: false
          });

        } else {
          window.scroll(0, 0);
          evt.preventDefault();
        }
      });
    }
  });
}

const pageOrderList = document.querySelector('.page-order__list');
if (pageOrderList) {

  pageOrderList.addEventListener('click', evt => {

    if (evt.target.classList && evt.target.classList.contains('order-item__toggle')) {
      var path = evt.path || (evt.composedPath && evt.composedPath());
      Array.from(path).forEach(element => {

        if (element.classList && element.classList.contains('page-order__item')) {

          element.classList.toggle('order-item--active');

        }

      });

      evt.target.classList.toggle('order-item__toggle--active');

    }

    if (evt.target.classList && evt.target.classList.contains('order-item__btn')) {

      const status = evt.target.previousElementSibling;
      const newStatus = status.classList && status.classList.contains('order-item__info--no') ? 1 : 0;
      const idOrder = document.querySelector('.order-item__info--id').innerHTML;

      $.ajax({
        url: '/src/order_status.php',
        method: "POST",
        data: {id: idOrder, status: newStatus},
        success: function (msg) {

          if (status.classList && status.classList.contains('order-item__info--no')) {
            status.textContent = 'Выполнено';
          } else {
            status.textContent = 'Не выполнено';
          }
    
          status.classList.toggle('order-item__info--no');
          status.classList.toggle('order-item__info--yes');
        },
        error: function(msg) {
            console.log('Error', msg)
        },
      });

    }

  });

}

const checkList = (list, btn) => {

  if (list.children.length === 1) {

    btn.hidden = false;

  } else {
    btn.hidden = true;
  }

};
const addList = document.querySelector('.add-list');
if (addList) {

  const form = document.querySelector('.custom-form');
  labelHidden(form);

  const addButton = addList.querySelector('.add-list__item--add');
  const addInput = addList.querySelector('#product-photo');

  checkList(addList, addButton);

  addInput.addEventListener('change', evt => {

    const template = document.createElement('LI');
    const img = document.createElement('IMG');

    template.className = 'add-list__item add-list__item--active';
    template.addEventListener('click', evt => {
      addList.removeChild(evt.target);
      addInput.value = '';
      checkList(addList, addButton);
    });

    const file = evt.target.files[0];
    const reader = new FileReader();

    reader.onload = (evt) => {
      img.src = evt.target.result;
      template.appendChild(img);
      addList.appendChild(template);
      checkList(addList, addButton);
    };

    reader.readAsDataURL(file);

  });

  const button = document.querySelector('.button');
  const popupEnd = document.querySelector('.page-add__popup-end');

  button.addEventListener('click', (evt) => {

    evt.preventDefault();

    if (document.querySelector('#product-name').value === '') {
      document.querySelector('#product-name').style.borderColor = 'red';
      return;
    } else {
      document.querySelector('#product-name').style.borderColor = '#C2C2C2';
    }

    if (document.querySelector('#product-price').value === '') {
      document.querySelector('#product-price').style.borderColor = 'red';
      return;
    } else {
      document.querySelector('#product-price').style.borderColor = '#C2C2C2';
    }

    if (document.querySelector('#product-photo').value === '' && !document.querySelector('.add-list__item--active')) {
      document.querySelector('.add-list__item').style.borderColor = 'red';
      return;
    } else {
      document.querySelector('.add-list__item').style.borderColor = '#C2C2C2';
    }

    $.ajax({
      url: '/src/add_product.php',
      method: "POST",
      data: new FormData(addForm),
      success: function (msg) {
        form.hidden = true;
        popupEnd.hidden = false;

        setTimeout(function(){
          window.location.href = '/products/';
        }, 3 * 1000);
      },
      error: function(msg) {
          console.log('Error', msg)
      },
      contentType: false,
      processData: false
    });

  })

}

const productsList = document.querySelector('.page-products__list');
if (productsList) {

  productsList.addEventListener('click', evt => {

    const target = evt.target;

    if (target.classList && target.classList.contains('product-item__delete')) {
      if (!confirm("Вы точно уверены?")) {
        return;
      }

      $.ajax({
        url: '/src/del_product.php',
        method: "POST",
        data: {id: target.parentElement.id},
        success: function (msg) {
          productsList.removeChild(target.parentElement);
        },
        error: function(msg) {
            console.log('Error', msg)
        }
      });
    }

  });

}

// jquery range maxmin
if (document.querySelector('.shop-page')) {

  $('.range__line').slider({
    min: oldMinPrice,
    max: oldMaxPrice,
    values: [minPrice, maxPrice],
    range: true,
    stop: function(event, ui) {

      $('.min-price').text($('.range__line').slider('values', 0) + ' руб.');
      $('.max-price').text($('.range__line').slider('values', 1) + ' руб.');

    },
    slide: function(event, ui) {

      $('.min-price').text($('.range__line').slider('values', 0) + ' руб.');
      $('.max-price').text($('.range__line').slider('values', 1) + ' руб.');

    }
  });

}

if (document.querySelector('#catalog_filter')) {
  document.querySelector('#catalog_filter').addEventListener('submit', (ev) => {
    ev.preventDefault();
    const newMinPrice = +/\d+/.exec(document.querySelector('.min-price').textContent.replace(/\s/g, ''));
    const newMaxPrice = +/\d+/.exec(document.querySelector('.max-price').textContent.replace(/\s/g, ''));
    const newSale = document.querySelector('#sale').checked ? 1 : 0;
    const newNews = document.querySelector('#new').checked ? 1 : 0;
    const sort = document.querySelector('#sort').value == 0 ? 'price' : document.querySelector('#sort').value;
    const ascdesc = document.querySelector('#ascdesc').value == 0 ? 'asc' : document.querySelector('#ascdesc').value;
  
    document.location.href = "?min_price=" + newMinPrice + "&max_price=" + newMaxPrice + "&new=" + newNews + "&sale=" + newSale + "&sort=" + sort + "&ascdesc=" + ascdesc;
  })
}

if (document.querySelector('#sort')) {
  document.querySelector('#sort').addEventListener('change', () => {
    const newMinPrice = +/\d+/.exec(document.querySelector('.min-price').textContent.replace(/\s/g, ''));
    const newMaxPrice = +/\d+/.exec(document.querySelector('.max-price').textContent.replace(/\s/g, ''));
    const newSale = document.querySelector('#sale').checked ? 1 : 0;
    const newNews = document.querySelector('#new').checked ? 1 : 0;
    const sort = document.querySelector('#sort').value == 0 ? 'price' : document.querySelector('#sort').value;
    const ascdesc = document.querySelector('#ascdesc').value == 0 ? 'asc' : document.querySelector('#ascdesc').value;
  
    document.location.href = "?min_price=" + newMinPrice + "&max_price=" + newMaxPrice + "&new=" + newNews + "&sale=" + newSale + "&sort=" + sort + "&ascdesc=" + ascdesc;
  })
}

if (document.querySelector('#ascdesc')) {
  document.querySelector('#ascdesc').addEventListener('change', () => {
    const newMinPrice = +/\d+/.exec(document.querySelector('.min-price').textContent.replace(/\s/g, ''));
    const newMaxPrice = +/\d+/.exec(document.querySelector('.max-price').textContent.replace(/\s/g, ''));
    const newSale = document.querySelector('#sale').checked ? 1 : 0;
    const newNews = document.querySelector('#new').checked ? 1 : 0;
    const sort = document.querySelector('#sort').value == 0 ? 'price' : document.querySelector('#sort').value;
    const ascdesc = document.querySelector('#ascdesc').value == 0 ? 'asc' : document.querySelector('#ascdesc').value;
  
    document.location.href = "?min_price=" + newMinPrice + "&max_price=" + newMaxPrice + "&new=" + newNews + "&sale=" + newSale + "&sort=" + sort + "&ascdesc=" + ascdesc;
  })
}
