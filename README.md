# FOC Add2Cart box

Module replaces default opencart add to cart notification and scroll to up script with modal window, that you can customize.

There are bunch of template variables, you can use in your templates:

|variable|description|
|---|---|
|site_name|Site name|
|site_logo|Site logo|
|site_phone|Site phone|
|url_home|Url to main page|
|url_cart|Url to product cart|
|url_checkout|Url to checkout page|
|url_history|Url to order history page|
|url_wishlist|Url to wishlist page|
|url_voucher|Url to voucher page|
|url_contact|Url to contact page|
|url_manufacturer|Url to manufacturers page|
|url_specials|Url to special offers page|

### Custom animation

You can use your own animations for modal window via css transitions.

**Zoom in/out example:**

```css
.foc-add2cart-box-popup {
  opacity: 0;
  transition: all 0.2s ease-in-out;
  transform: scale(0.8);
}
.mfp-bg {
  opacity: 0;
  transition: all 0.3s ease-out;
}
.mfp-ready .foc-add2cart-box-popup {
  opacity: 1;
  transform: scale(1);
}
.mfp-ready.mfp-bg {
  opacity: .7;
}
.mfp-removing .foc-add2cart-box-popup {
  transform: scale(0.8);
  opacity: 0;
}
.mfp-removing.mfp-bg {
  opacity: 0;
}
```

Also, please check other animation examples by Dmitry Semenov [here](https://codepen.io/dimsemenov/pen/GAIkt)