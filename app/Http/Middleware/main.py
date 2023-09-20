from flask import Flask, request

app = Flask(__name__)

# Middleware function to log incoming requests
@app.before_request
def log_request_info():
    print("Received request with path: {}".format(request.path))
    print("Request method: {}".format(request.method))
    print("Request headers: {}".format(request.headers))
    print("Request data: {}".format(request.get_data()))

# Route for demonstration
@app.route('/')
def hello():
    return 'Hello, World!'

if __name__ == '__main__':
    app.run()
