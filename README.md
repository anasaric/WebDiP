# WebDiP
 Web design and programming project
 
# Project documentation – school year 2021./2022. 

## Overview
This repository contains the implementation of a web application for the academic project. The project is developed following specific functional and technical requirements outlined for student assessment purposes. It includes features for user management, role-based access, logging, statistics, and administrative controls.


## Features

### User Roles
1. **Unregistered User**
   - Can view the website and accept terms of use stored in a cookie (valid for 2 days).
   - Can register by providing personal details, password, and email confirmation (link expires in 7 hours).

2. **Registered User**
   - Login with username and password.
   - Account locks after 3 failed login attempts, can be unlocked by an administrator.
   - Full access to unregistered user features.

3. **Moderator**
   - Inherits permissions of a registered user.

4. **Administrator**
   - Full CRUD (Create, Read, Update, Delete) functionality on all system data.
   - Can manage blocked users, reset terms of use, configure application settings, and view activity logs.


### Key Functionalities  
- **Pagination**: All data tables with more than five items are paginated. Admin can configure items per page.  
- **Statistics**: Sortable, printable views and exportable as PDFs with graphs created using JavaScript and Canvas.  
- **Logging**: Comprehensive activity logs, including login events, database queries, and other actions.  
- **Search and Sort**: Available in all tabular views with at least two sortable columns.  
- **Virtual Time**: Configurable by the administrator via an external service.  

### Security Features  
- **Authentication**: Custom-built with server and client-side validation, including CAPTCHA for user registration.  
- **Password Storage**: Stored in plaintext and SHA-256 hashed forms with dynamic salt.  
- **HTTPS**: Enforced for login and sensitive operations.  
- **XSS and SQL Injection Protection**: Implemented using `filter_input`, `htmlspecialchars`, and prepared statements.  

### User Experience Enhancements  
- Cookie management for personalization (e.g., pre-filled forms, sorting preferences).  
- AJAX-based interface for smoother interactions.  
- Dynamic design updates through admin-controlled CSS.  

### Tools and Technologies Used  
- **Languages**: PHP, HTML  
- **Template Engine**: Smarty  
- **Frontend**: JavaScript (AJAX, Canvas), CSS 


## Technical Details

### Database
- MySQL database stores all application data.
- Passwords are stored in both plaintext (for evaluation purposes) and hashed formats using SHA256 with salt.

### Documentation
- **`dokumentacija.html`**: it includes:  
- Project description and functionality overview.  
- ERA model and system architecture.  
- Script and directory descriptions.  
- Used tools and external libraries. 
- **`o_autoru.html`**: Information about the author, including name, email, and a profile picture.

### Installation
- The project is deployed on `barka.foi.hr`.
- Access is restricted to authorized users.




## License
This project is for educational purposes and is subject to specific academic guidelines. Redistribution is not allowed without permission.



