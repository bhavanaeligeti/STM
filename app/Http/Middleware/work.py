class Product:
    def __init__(self, product_id, name, price):
        self.product_id = product_id
        self.name = name
        self.price = price

    def __str__(self):
        return f"Product ID: {self.product_id}, Name: {self.name}, Price: ${self.price:.2f}"


class ShoppingCart:
    def __init__(self):
        self.items = []

    def add_item(self, product, quantity):
        self.items.append({'product': product, 'quantity': quantity})

    def remove_item(self, product_id):
        self.items = [item for item in self.items if item['product'].product_id != product_id]

    def calculate_total(self):
        total = 0
        for item in self.items:
            total += item['product'].price * item['quantity']
        return total

    def __str__(self):
        cart_items = [f"{item['product']} x {item['quantity']}" for item in self.items]
        return "Cart:\n" + "\n".join(cart_items) + f"\nTotal: ${self.calculate_total():.2f}"


class Order:
    def __init__(self, order_id, cart):
        self.order_id = order_id
        self.cart = cart

    def display_order(self):
        print(f"Order ID: {self.order_id}")
        print(self.cart)


# Create products
product1 = Product(1, 'Laptop', 1000.0)
product2 = Product(2, 'Mouse', 20.0)
product3 = Product(3, 'Keyboard', 50.0)

# Create a shopping cart
cart = ShoppingCart()

# Add products to the cart
cart.add_item(product1, 2)
cart.add_item(product2, 3)
cart.add_item(product3, 1)

# Display the cart
print("Current Cart:")
print(cart)

# Remove a product from the cart
cart.remove_item(2)

# Display the updated cart
print("\nUpdated Cart:")
print(cart)

# Place an order
order = Order(1, cart)
print("\nPlaced Order:")
order.display_order()
