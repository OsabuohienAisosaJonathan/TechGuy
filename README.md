# TechGuy
Overview of the Application
This web application is designed for the recruitment and networking of tech experts. It allows three different types of users: Clients, Tech Experts, and Admins. The application enables user registration, login/logout functionality, user management (for admins), and the ability to view user locations on a map.

Key Components
User Roles:
1. Admin: Has full access to manage users, including admitting, deactivating, and deleting user accounts.
2. Tech Expert: Can register, manage their profile, and set their location visibility.
3. Client: Can view tech experts and their profiles, but has limited management capabilities.

Database Structure:
Users Table: Stores user details, including user_id, username, email, password, role_id, and active status.
Roles Table: Stores the different roles (Admin, Tech Expert, Client) associated with user accounts.
Files and Directories:

public/: Contains publicly accessible files, including HTML/PHP files for user interaction.
index.php: The landing page that likely provides general information about the app.
register.php: Allows new users (Tech Experts or Clients) to register.
login.php: Handles user authentication.
profile.php: Allows users to view and edit their profiles.
map.php: Displays a map with tech experts' locations.
logout.php: Logs out the user and ends their session.
admin/: Contains files for admin functionalities.
manage_users.php: Admin interface to manage user accounts (activate, deactivate, delete).
includes/: Contains reusable PHP scripts.
auth.php: Handles user authentication logic.
functions.php: Contains helper functions used throughout the application.
assets/: Contains CSS and JavaScript files for styling and interactivity.
User Workflow
Registration:

Users can register as Tech Experts or Clients via register.php. Upon submitting the form, their data is validated and stored in the users table.
Login:

Users log in via login.php. Their credentials are checked against the database using secure password hashing.
Upon successful login, they are redirected to their respective dashboards (for Tech Experts or Clients) or to the admin dashboard.
Profile Management:

Users can view and edit their profiles on profile.php. They can update personal information, including toggling their location visibility.
Admin Management:

Admins can manage users from manage_users.php. They can:
View Users: Display a list of all users with their details.
Activate/Deactivate Users: Change the status of Tech Experts and Clients by updating the active field in the database.
Delete Users: Permanently remove users from the database.
Location Mapping:

The map.php file displays a Google Map where tech experts' locations are shown. This requires an API key for Google Maps.
Admins have visibility into tech experts' locations, while regular users (Tech Experts and Clients) can manage their location visibility settings.
Logout:

Users can log out using logout.php, which ends their session and redirects them to the login page.

**Technical Implementation**
Database Interactions: The application uses PDO (PHP Data Objects) for database operations, ensuring secure and efficient handling of SQL queries.
Form Handling: The application handles form submissions using the POST method, validating and sanitizing inputs to prevent SQL injection and XSS attacks.
Session Management: PHP sessions are used to maintain user login states and role-based access control.
Google Maps Integration: The app integrates Google Maps API to display the locations of Tech Experts, requiring a valid API key.

**Conclusion**
Overall, this application provides a structured environment for tech recruitment and networking, allowing different user roles to perform specific actions while maintaining security and data integrity. The use of a relational database, user role management, and dynamic map integration enhances the functionality and usability of the application.
