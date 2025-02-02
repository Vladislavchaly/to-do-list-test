<h1>Deploy project: </h1>

To deploy project locally, run terminal command: 
<pre>
make env
make start
</pre>

Please check Makefile for other command.

<h1>API Documentation</h1>

<p>You can use <a href="http://localhost:8000/apidoc/index.html">ApiDoc</a> for documentation or the HTTP Client in PhpStorm for testing.</p>

<h2>Authentication</h2>

<h3>Login User</h3>
<p><strong>POST</strong> <code>http://localhost:8000/api/auth/login</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Content-Type: application/json
</pre>
<p><strong>Body:</strong></p>
<pre>
{
  "email": "test@gmail.com",
  "password": "1Qwerty@"
}
</pre>

<hr>

<h3>Logout User</h3>
<p><strong>DELETE</strong> <code>http://localhost:8000/api/auth/logout</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Authorization: Bearer &lt;your token&gt;
</pre>

<hr>

<h3>Register New User</h3>
<p><strong>POST</strong> <code>http://localhost:8000/api/auth/register</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Content-Type: application/json
</pre>
<p><strong>Body:</strong></p>
<pre>
{
  "email": "test@gmail.com",
  "password": "Test1234",
  "password_confirmation": "Test1234",
  "name": "Test User Name"
}
</pre>

<hr>

<h2>Tasks</h2>

<h3>Create New Task</h3>
<p><strong>POST</strong> <code>http://localhost:8000/api/task</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Content-Type: application/json
Authorization: Bearer &lt;your token&gt;
</pre>
<p><strong>Body:</strong></p>
<pre>
{
  "name": "Test Title",
  "description": "Test Description"
}
</pre>

<hr>

<h3>Get List of Tasks</h3>
<p><strong>GET</strong> <code>http://localhost:8000/api/task</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Authorization: Bearer &lt;your token&gt;
</pre>
<p><strong>Optional Query Parameters:</strong></p>
<ul>
    <li><code>status</code>: true|false</li>
    <li><code>title</code>: "Task Title"</li>
    <li><code>sort_by</code>: "created_at"|"due_date"|"priority"</li>
    <li><code>page</code>: 1</li>
    <li><code>limit</code>: 10</li>
</ul>

<hr>

<h3>Get Task by ID</h3>
<p><strong>GET</strong> <code>http://localhost:8000/api/task/{id}</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Authorization: Bearer &lt;your token&gt;
</pre>

<hr>

<h3>Update a Task by ID</h3>
<p><strong>PUT</strong> <code>http://localhost:8000/api/task/{id}</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Content-Type: application/json
Authorization: Bearer &lt;your token&gt;
</pre>
<p><strong>Body:</strong></p>
<pre>
{
  "title": "Updated Task Title",
  "description": "Updated Description"
}
</pre>

<hr>

<h3>Delete Task by ID</h3>
<p><strong>DELETE</strong> <code>http://localhost:8000/api/task/{id}</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Authorization: Bearer &lt;your token&gt;
</pre>

<hr>

<h3>Update the Status of a Task by ID</h3>
<p><strong>PATCH</strong> <code>http://localhost:8000/api/task/status/{id}</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Content-Type: application/json
Authorization: Bearer &lt;your token&gt;
</pre>
<p><strong>Body:</strong></p>
<pre>
{
  "status": true
}
</pre>

<hr>

<h3>Get Authenticated User</h3>
<p><strong>GET</strong> <code>http://localhost:8000/api/user</code></p>
<p><strong>Headers:</strong></p>
<pre>
Accept: application/json
Authorization: Bearer &lt;your token&gt;
</pre>
