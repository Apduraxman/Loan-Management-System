# LMS Project

## Overview
The LMS (Loan Management System) project is designed to manage investment products and borrower information efficiently. This system provides functionalities for displaying, adding, editing, and deleting investment products and borrower details.

## File Structure
```
LMS
├── invest_product.php       # Manages investment products
├── borrower.php             # Manages borrower-related functionalities
├── db
│   └── connection.php       # Database connection settings
├── includes
│   ├── header.php           # Header section for web pages
│   └── footer.php           # Footer section for web pages
├── assets
│   ├── css
│   │   └── style.css        # CSS styles for the project
│   └── js
│       └── script.js        # JavaScript functionality
└── README.md                # Project documentation
```

## Features
- **Investment Product Management**: Add, edit, delete, and display investment products.
- **Borrower Management**: View and manage borrower information.
- **Database Connection**: Secure connection to the database for data operations.
- **Responsive Design**: User-friendly interface with a responsive layout.
- **Client-Side Validation**: JavaScript validation for forms to enhance user experience.

## Setup Instructions
1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Set up the database using the provided SQL scripts (if available).
4. Update the database connection settings in `db/connection.php`.
5. Open `invest_product.php` or `borrower.php` in your web browser to access the application.

## Usage Guidelines
- Use the navigation menu to access different sections of the application.
- Follow prompts to add or edit investment products and borrower information.
- Ensure to validate all forms before submission to avoid errors.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any suggestions or improvements.