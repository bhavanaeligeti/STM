from flask import Flask, render_template, request

app = Flask(__name__)

# Sample data
posts = [
    {'title': 'Post 1', 'content': 'This is the content of post 1.'},
    {'title': 'Post 2', 'content': 'This is the content of post 2.'}
]

@app.route('/')
def home():
    return 'Welcome to our website!'

@app.route('/about')
def about():
    return 'This is the about page.'

@app.route('/posts')
def show_posts():
    return render_template('posts.html', posts=posts)

@app.route('/post/<int:post_id>')
def show_post(post_id):
    post = posts[post_id - 1] if post_id > 0 and post_id <= len(posts) else None
    return render_template('post.html', post=post)

@app.route('/contact', methods=['GET', 'POST'])
def contact():
    if request.method == 'POST':
        # Handle form submission
        name = request.form['name']
        message = request.form['message']
        return f'Thank you, {name}, for your message: {message}'

    return render_template('contact.html')

if __name__ == '__main__':
    app.run(debug=True)
