<p>To install:</p>
<ol>
    <li>Clone repo</li>
    <li>Configure .env file</li>
    <li>Go to bash and do:</li>
    <li>php artisan key:generate</li>
    <li>php artisan queue:table</li>
    <li>php artisan migrate</li>
</ol>

<br>
    <p>JSON file located at /public folder</p>
<br>

<p>To check -</p>
<span>Without queue:</span>
<ol>
    <li>Go to {your-site-name}/home</li>
    <li>Press enter and check database</li>
</ol>
<span>With queue:</span>
<ol>
    <li>Go to bash and do:</li>
    <li>php artisan sync:json</li>
    <li>php artisan queue:work --tries=3 --stop-when-empty</li>
</ol>