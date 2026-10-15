# GradBridge to Career Toolkit

A responsive HTML, CSS, JavaScript and PHP project for the GradBridge to Career group: Sandile, Hlengiwe, Lefa and Trevor.

## Included features
- Home, About, Contact, Login and Career Toolkit pages
- Clickable GB logo and shared navigation/footer
- Black/white theme toggle (preference stored in localStorage)
- CV builder with preview, save and print / save as PDF
- Five-question career readiness quiz
- Job application tracker with status changes, browser storage and CSV export
- South African career resource links
- First-salary budget planner using South African rand (ZAR)
- Contact form client-side and PHP validation
- Successful contact form submissions appended to `data/messages.csv`

## Requirements
- Visual Studio Code
- PHP 8+ installed and available in the terminal
- A browser

## Run in VS Code
1. Extract this ZIP and open the `GradBridge_to_Career` folder in VS Code.
2. Open **Terminal → New Terminal**.
3. Confirm PHP is installed by running `php -v`.
4. Start the local PHP server from the project root:

   ```bash
   php -S localhost:8000
   ```

5. Open `http://localhost:8000` in your browser.
6. Visit Contact and submit a valid test message. Check `data/messages.csv` to see the saved row.

**Important:** Do not double-click `index.html` or use a static-only server if you want the contact form to write to CSV. The PHP handler needs to run on a PHP-enabled server. On Windows, if `php` is not recognised, install PHP or use a PHP-enabled local stack such as XAMPP, then follow its local-host setup instructions.

## Demo login
- Email: `student@gradbridge.test`
- Password: `GradBridge123!`

This is a front-end demonstration login only. It is not secure authentication and must not be used for real accounts or sensitive data.

## Data and privacy
- CV details, demo login state, theme choice and job applications are stored in the current browser's `localStorage`.
- Contact messages are saved on the server in `data/messages.csv`.
- `data/.htaccess` denies direct web access to the data folder on Apache servers. Configure equivalent access restrictions for any other server.
- This is a coursework prototype. For production use, add server-side authentication, CSRF protection, stronger deployment security and a privacy policy. Avoid collecting sensitive information.
- `data/messages.csv` must be writable by the PHP process. The initial CSV contains only the header row.

## Suggested team role allocation
Use these as a starting point and change them to reflect your actual work:
- Sandile — project coordination and home page
- Hlengiwe — About page and content
- Lefa — toolkit interactions and calculations
- Trevor — contact form, testing and documentation


### Favicon / logo
The project includes `favicon.svg`, a browser-tab icon based on the existing GradBridge “GB” monogram and brand colours. It is linked from the HTML pages, so the browser tab should display it when the site is refreshed.
