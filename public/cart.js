const API_BASE = 'http://localhost:8000/api.php';

let products = [];
let offers = [];
let deliveryRules = [];

const cart = JSON.parse(localStorage.getItem('acmeCart')) || {};

function saveCart() {
    localStorage.setItem('acmeCart', JSON.stringify(cart));
}

function renderProducts() {
    fetch(`${API_BASE}?action=products`)
        .then(res => res.json())
        .then(data => {
            products = data;
            const list = document.getElementById('product-list');
            list.innerHTML = '';
            products.forEach(p => {
                const col = document.createElement('div');
                col.className = 'col-md-4';
                col.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <span class="badge bg-secondary">${p.code}</span>
                            <h5 class="card-title">${p.name}</h5>
                            <p class="card-text">$${parseFloat(p.price).toFixed(2)}</p>
                            <button class="btn btn-primary" onclick="addToCart('${p.code}')">Add to Cart</button>
                        </div>
                    </div>
                `;
                list.appendChild(col);
            });
        });
}

function fetchDeliveryRules() {
    return fetch(`${API_BASE}?action=delivery_rules`)
        .then(res => res.json())
        .then(data => {
            deliveryRules = data;
        });
}

function fetchOffers() {
    return fetch(`${API_BASE}?action=offers`)
        .then(res => res.json())
        .then(data => {
            offers = data;
        });
}

function addToCart(code) {
    cart[code] = (cart[code] || 0) + 1;
    saveCart();
    renderCart();
}

function removeFromCart(code) {
    if (cart[code]) {
        cart[code]--;
        if (cart[code] <= 0) delete cart[code];
        saveCart();
        renderCart();
    }
}

function getDeliveryCost(total) {
    for (const rule of deliveryRules) {
        const min = rule.min_amount !== null ? parseFloat(rule.min_amount) : 0;
        const max = rule.max_amount !== null ? parseFloat(rule.max_amount) : Infinity;

        if (total >= min && total < max) {
            return parseFloat(rule.delivery_cost);
        }
    }
    return 0; // Default delivery cost if no rule applies
}

function renderCart() {
    const cartDiv = document.getElementById('cart-items');
    cartDiv.innerHTML = '';

    let total = 0;
    let discounts = 0;
    let applied_offers = [];

    // Map product code -> { name, qty, total }
    const itemMap = {};

    // Calculate subtotal before offers
    for (const [code, qty] of Object.entries(cart)) {
        const product = products.find(p => p.code === code);
        if (!product) continue;

        let itemTotal = product.price * qty;
        itemMap[code] = { name: product.name, qty, total: itemTotal };
        total += itemTotal;
    }

    // Apply offers
    offers.forEach(offer => {
        // Find product by ID referenced in offer
        const product = products.find(p => p.id == offer.product_id);
        if (!product) return;

        const count = cart[product.code] || 0;

        if (count > offer.min_quantity) {
            // Number of discounted items = floor(count / 2)
            const discountedItems = Math.floor(count / 2);

            const discountPerItem = offer.discount_type === 'percentage' ? product.price * (offer.discount_value / 100) : product.price - offer.discount_value;

            const discount = discountedItems * discountPerItem;

            discounts += discount;
            total -= discount;

            applied_offers.push(offer.description);
        }
    });

    // Render cart items
    for (const [code, item] of Object.entries(itemMap)) {
        const row = document.createElement('div');
        row.className = 'd-flex justify-content-between mb-2';
        row.innerHTML = `
            <div>${item.name} x ${item.qty}</div>
            <div>
                $${item.total.toFixed(2)}
                <button class="btn btn-sm btn-danger ms-2" onclick="removeFromCart('${code}')">Remove</button>
            </div>
        `;
        cartDiv.appendChild(row);
    }

    // Calculate delivery cost
    const delivery = getDeliveryCost(total);
    const totalWitoutDiscounts = total + discounts;
    const grandTotal = total + delivery;

    document.getElementById('cart-total').innerHTML = `$${totalWitoutDiscounts.toFixed(2)} <br>
        Discounts: -$${discounts.toFixed(2)} <br>
        Subtotal: $${total.toFixed(2)} <br>
        Delivery: $${delivery.toFixed(2)} <br>
        <strong>Total: $${grandTotal.toFixed(2)}</strong>
    `;

    // Show applied offers
    const offersDiv = document.getElementById('cart-offers');
    offersDiv.innerHTML = applied_offers.length
        ? 'Offers: ' + applied_offers.join(', ')
        : '';
}

// Initial load: Fetch products, offers, delivery rules then render cart
Promise.all([fetchOffers(), fetchDeliveryRules()])
    .then(() => {
        renderProducts();
        renderCart();
    });
