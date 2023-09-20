class Product:
    def __init__(self, name, price):
        self.name = name
        self.price = price

    def __str__(self):
        return f"{self.name} - ${self.price:.2f}"


class ShoppingCart:
    def __init__(self):
        self.items = []

    def add_item(self, product, quantity):
        self.items.append({"product": product, "quantity": quantity})

    def calculate_total(self):
        total = 0
        for item in self.items:
            total += item["product"].price * item["quantity"]
        return total


def main():
    # Create some sample products
    product1 = Product("Laptop", 1000)
    product2 = Product("Headphones", 50)
    product3 = Product("Mouse", 20)

    # Create a shopping cart
    cart = ShoppingCart()

    # Add products to the cart
    cart.add_item(product1, 2)
    cart.add_item(product2, 1)
    cart.add_item(product3, 3)

    # Display the items in the cart
    print("Items in the cart:")
    for item in cart.items:
        print(f"{item['product']} - Quantity: {item['quantity']}")

    # Calculate and display the total price
    total_price = cart.calculate_total()
    print(f"\nTotal Price: ${total_price:.2f}")


if __name__ == "__main__":
    main()
