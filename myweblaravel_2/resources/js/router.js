import { createRouter, createWebHistory } from 'vue-router';
import axios from 'axios';
import store from './store/';
import Layout from "@/components/Layout.vue";
import Home from './components/Home.vue';
import Product from "@/components/product/Product.vue";
import EditProduct from "@/components/product/Edit.vue";
import Bestseller from "@/components/product/Bestseller.vue";
import Clothes from "@/components/layout/Clothes.vue";
import Hat from "@/components/layout/Hat.vue";
import Bag from "@/components/layout/Bag.vue";
import Shoe from "@/components/layout/Shoe.vue";
import Accessory from "@/components/layout/Accessory.vue";
import Men from "@/components/product/Men.vue";
import Women from "@/components/product/Women.vue";
import Discount from "@/components/product/Discount.vue";
import Unisex from "@/components/product/Unisex.vue";
import NewProduct from "@/components/product/NewProduct.vue";
import ProductUpload from "@/components/product/Upload.vue";
import ProductUpdate from "@/components/product/Update.vue";
import VouchersUpload from "@/components/vouchers/Upload.vue";
import VouchersUpdate from "@/components/vouchers/Update.vue";
import EditVoucher from "@/components/vouchers/Edit.vue";
import ViewProduct from "@/components/view/ViewProduct.vue";
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';
import Cart from './components/layout/Cart.vue';
import Checkout from './components/layout/Checkout.vue';
import Error from './components/layout/Error.vue';
import Confirm from './components/layout/Confirm.vue';
import Payment from './components/layout/Payment.vue';
import sectionUpload from './components/section/Upload.vue';
import sectionUpdate from './components/section/Update.vue';
import EditSection from './components/section/Edit.vue';
import SliderUpload from './components/slider/Upload.vue';
import SliderUpdate from './components/slider/Update.vue';
import EditSlider from './components/slider/Edit.vue';
import Blog from "@/components/blog/Blog.vue";
import blogUpdate from "@/components/blog/Update.vue";
import blogUpload from "@/components/blog/Upload.vue";
import EditBlog from "@/components/blog/Edit.vue";
import Contact from "@/components/contact/Contact.vue";
import About from "@/components/about/About.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: Layout,
      children: [
        {
          path: '',
          name: 'Home',
          component: Home,
          meta: { title: 'Home', showSection: true, showSlider: true, showSliderSale: true }
        },
        {
          path: 'product',
          name: 'Product',
          component: Product,
          meta: { title: 'Products', showSlider: true }
        },
        {
          path: 'login',
          name: 'Login',
          component: Login,
          meta: { title: 'Login', hideHeaderFooter: true }
        },
        {
          path: 'register',
          name: 'Register',
          component: Register,
          meta: { title: 'Register', hideHeaderFooter: true }
        },
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard,
          meta: { title: 'Dashboard', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'product/upload',
          name: 'Upload',
          component: ProductUpload,
          meta: { title: 'Product - Upload', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'product/update',
          name: 'UpDate',
          component: ProductUpdate,
          meta: { title: 'Product - Update', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'products/:id',
          name: 'ViewProduct',
          component: ViewProduct,
          props: true,
          meta: { title: 'Product - View', }
        },
        {
          path: 'product/bestseller',
          name: 'Bestseller',
          component: Bestseller,
          meta: { title: 'Product - Bestsellers', showSlider: true }
        },
        {
          path: 'product/men',
          name: 'Men',
          component: Men,
          meta: { title: 'Product - Men', showSlider: true }
        },
        {
          path: 'product/new',
          name: 'NewProduct',
          component: NewProduct,
          meta: { title: 'Product - New', showSlider: true }
        },
        {
          path: 'product/women',
          name: 'Women',
          component: Women,
          meta: { title: 'Product - Women', showSlider: true }
        },
        {
          path: 'product/unisex',
          name: 'Unisex',
          component: Unisex,
          meta: { title: 'Product - Unisex', showSlider: true }
        },
        {
          path: 'product/discount',
          name: 'Discount',
          component: Discount,
          meta: { title: 'Product - Discount', showSlider: true }
        },
        {
          path: 'product/hat',
          name: 'Hat',
          component: Hat,
          meta: { title: 'Product - Hat', showSlider: true }
        },
        {
          path: 'product/Bag',
          name: 'Bag',
          component: Bag,
          meta: { title: 'Product - Bag', showSlider: true }
        },
        {
          path: 'product/accessory',
          name: 'Accessory',
          component: Accessory,
          meta: { title: 'Product - Accessory', showSlider: true }
        },
        {
          path: 'product/shoes',
          name: 'Shoe',
          component: Shoe,
          meta: { title: 'Product - Shoes', showSlider: true }
        },
        {
          path: 'product/clothes',
          name: 'Clothes',
          component: Clothes,
          meta: { title: 'Product - Clothes', showSlider: true }
        },
        {
          path: 'cart',
          name: 'Cart',
          component: Cart,
          meta: { title: 'Cart' }
        },
        {
          path: '/checkout',
          name: 'Checkout',
          component: Checkout,
          meta: { title: 'Checkout' }
        },
        {
          path: 'payment',
          name: 'Payment',
          component: Payment,
          meta: { title: 'Payment' }
        },
        {
          path: 'error',
          name: 'Error',
          component: Error,
          meta: { title: 'Error' }
        },
        {
          path: 'confirm',
          name: 'Confirm',
          component: Confirm,
          meta: { title: 'Thank You' }
        },
        {
          path: 'vouchers/upload',
          name: 'VouchersUpload',
          component: VouchersUpload,
          meta: { title: 'Vouchers - Upload', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'vouchers/update',
          name: 'VouchersUpdate',
          component: VouchersUpdate,
          meta: { title: 'Vouchers - Update', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'vouchers/edit/:id',
          name: 'EditVoucher',
          component: EditVoucher,
          props: true,
          meta: { title: 'Vouchers - Edit', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'product/edit/:id',
          name: 'EditProduct',
          component: EditProduct,
          props: true,
          meta: { title: 'Product - Edit', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'section/upload',
          name: 'sectionUpload',
          component: sectionUpload,
          meta: { title: 'Section - Upload', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'section/update',
          name: 'sectionUpdate',
          component: sectionUpdate,
          meta: { title: 'Section - Update', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'section/edit/:id',
          name: 'EditSection',
          component: EditSection,
          props: true,
          meta: { title: 'Section - Edit', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'slider/upload',
          name: 'SliderUpload',
          component: SliderUpload,
          meta: { title: 'Slider - Upload', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'slider/update',
          name: 'SliderUpdate',
          component: SliderUpdate,
          meta: { title: 'Slider - Update', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'slider/edit/:id',
          name: 'EditSlider',
          component: EditSlider,
          props: true,
          meta: { title: 'Slider - Edit', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'blog',
          name: 'Blog',
          component: Blog,
          meta: { title: 'Blog' }
        },
        {
          path: 'blog/upload',
          name: 'blogUpload',
          component: blogUpload,
          meta: { title: 'Blog - Upload', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'blog/update',
          name: 'blogUpdate',
          component: blogUpdate,
          meta: { title: 'BLog - Update', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'blog/edit/:id',
          name: 'EditBlog',
          component: EditBlog,
          props: true,
          meta: { title: 'BLog - Edit', requiresAuth: true, requiresAdmin: true }
        },
        {
          path: 'contact',
          name: 'Contact',
          component: Contact,
          meta: { title: 'Contact' }
        },
        {
          path: 'about',
          name: 'About',
          component: About,
          meta: { title: 'About' }
        },

      ]
    }
  ],
});



router.beforeEach((to, from, next) => {
  document.title = to.meta.title || 'Web title test';
  window.scrollTo(0, 0);
  next();
});

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const requiresAdmin = to.matched.some(record => record.meta.requiresAdmin);
  if (requiresAuth) {
    axios.get('/api/check-auth')
      .then(response => {
        if (response.data.authenticated) {
          if (requiresAdmin && response.data.role !== 'admin') {
            next({ name: 'Home' });
          } else {
            next();
          }
        } else {
          next({ name: 'Login' });
        }
      })
      .catch((error) => {
        console.error('An error occurred during authentication check:', error);
        next({ name: 'Home' });
      });
  } else {
    next();
  }
});


export default router;
