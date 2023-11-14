<template>
  <TransitionRoot as="template" :show="open" style="z-index: 100;">
    <Dialog as="div" class="relative z-10" @close="open = false">
      <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100"
        leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
          <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from="translate-x-full" enter-to="translate-x-0"
              leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0"
              leave-to="translate-x-full">
              <DialogPanel class="pointer-events-auto w-screen max-w-md ">
                <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                  <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                    <div class="flex items-start justify-between">
                      <DialogTitle class="text-lg font-medium text-gray-900">Carrito de compra</DialogTitle>
                      <div class="ml-3 flex h-7 items-center">
                        <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500"
                          @click="open = false">
                          <span class="absolute -inset-0.5" />
                          <span class="sr-only">Close panel</span>
                          <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                      </div>
                    </div>

                    <div class="mt-8">

                      <div class="flow-root">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                          <li v-for="product in cart" :key="product.id" class="flex py-6">
                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                              <img :src="'/storage/productos/' + product.product_image" :alt="product.name"
                                class="h-full w-full object-cover object-center" />
                            </div>

                            <div class="ml-4 flex flex-1 flex-col">
                              <div>
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                  <h3 class="text-xl font-bold">
                                    <a>{{ product.name }}</a>
                                  </h3>
                                  <p class="ml-4">${{ product.price }}</p>
                                </div>

                              </div>
                              <div class="flex flex-1 items-end justify-between text-sm">
                                <div class="flex">
                                  <div class="flex items-center">
                                    <label for="cantidad"
                                      class="block text-sm font-medium text-gray-700 mr-4">Cantidad:</label>
                                    <input type="number" min="1" id="cantidad" :max="100"
                                      v-model.number="product.cantidad"
                                      @change="updateProductQuantity(product, product.cantidad)"
                                      class="block w-1/2 py-2 px-3 border border-gray-300 rounded-md  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                  </div>
                                </div>
                                <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500"
                                  @click="removeProduct(product)">
                                  Eliminar
                                </button>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                      <p>Subtotal</p>
                      <p>${{ subtotal }}</p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                    <div class="mt-6">
                      <a @click="checkout"
                        class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                    </div>
                    <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                      <p>
                        or
                        <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500"
                          @click="open = false">
                          Continue Shopping
                          <span aria-hidden="true"> &rarr;</span>
                        </button>
                      </p>
                    </div>
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>





<script>
import axios from 'axios'
import { eventBus } from '../../eventBus'

export default {
  data() {
    return {
      cart: [],
      user: '',
    }

  },
  computed: {
    subtotal() {
      return this.cart.reduce((total, product) => {
        return total + (product.price * product.cantidad);
      }, 0);
    }
  },
  // watch: {
  //   '$route'(to, from) {
  //     if (to.path === '/purchase') {
  //       eventBus.emit('checkout');
  //     }
  //   }
  // },
  created() {
    this.cart = this.getCart();
    eventBus.on('product-added', this.dateCart);
    this.userAuth();
  },

  methods: {
    fetchCart() {
      axios.get('/cart')
        .then(response => {
          localStorage.setItem('cart', JSON.stringify(response.data));

        })
        .catch(error => {
          console.error(error);
        });
    },
    getCart() {
      return JSON.parse(localStorage.getItem('cart')) || [];
    },

    checkout() {
      this.$router.push('/purchase');



    },
    userAuth() {
      axios.get('/getAuth')
        .then(response => {
          this.user = response.data;
          if (this.user) {
            this.fetchCart();
          }

        })
    },
    removeProduct(product) {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      let productIndex = cart.findIndex(p => p.id === product.id);
      if (productIndex !== -1) {
        cart.splice(productIndex, 1);
        this.updateCart(cart);

        if (this.user) {
          axios.delete(`/cart/${this.cart.id}`, { data: { productId: product.id } })
            .then(response => {
              console.log('delete finish')
            })
            .catch(error => {
              console.log(this.cart.id);
              console.error('delete', error);
            });
        }
      }
      eventBus.emit('product-delete');
    },
    updateProductQuantity(product, quantity) {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      let productIndex = cart.findIndex(p => p.id === product.id);

      if (productIndex !== -1) {
        cart[productIndex].cantidad = quantity;
        this.updateCart(cart);

        if (this.user) {
          axios.put(`/cart/${this.cart.id}`, { productData: cart[productIndex] })
            .then(response => {
              console.log(this.cart)
              console.log('Cantidad del producto actualizada en la base de datos');
            })
            .catch(error => {
              console.error('Error al actualizar la cantidad del producto:', error);
            });
        }

      }
    },

    updateCart(cart) {
      localStorage.setItem('cart', JSON.stringify(cart));
      this.cart = cart;
    },

    dateCart() {
      this.cart = this.getCart();
    },
  }

}


</script>
  
<script setup>
import { ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'


const open = ref(false)

const route = useRoute()

watch(route, (to, from) => {
  if (to.path === '/purchase') {
    open.value = false
  }
})

const emit = defineEmits(['open'])

function openModal() {
  open.value = true
  emit('open')
}




defineExpose({
  openModal
})

// const open = ref(true)
</script>