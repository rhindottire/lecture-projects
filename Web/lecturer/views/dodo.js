document.addEventListener('DOMContentLoaded', () => {
    const posts = [
        { title: 'First Blog Post', content: 'This is the content of the first blog post.' },
        { title: 'Second Blog Post', content: 'This is the content of the second blog post.' },
        { title: 'Third Blog Post', content: 'This is the content of the third blog post.' },
    ];

    const postsContainer = document.getElementById('posts');
    
    posts.forEach(post => {
        const postElement = document.createElement('div');
        postElement.classList.add('post');
        postElement.innerHTML = `
            <h3>${post.title}</h3>
            <p>${post.content}</p>
        `;
        postsContainer.appendChild(postElement);
    });

    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();
        alert('Thank you for your message!');
        this.reset();
    });
});