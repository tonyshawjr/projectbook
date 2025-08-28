# Projectbook

A freelance-focused project management and billing dashboard that helps solo freelancers and small agencies centralize their workflows.

## Live Demo
- Production: https://projectbook.illbedev.com

## Features

- **Dashboard** - Real-time metrics and overview
- **Project Management** - Track projects with tasks, files, and financials
- **Client Management** - Direct and agency-referred clients
- **Support Tickets** - Priority-based ticket system
- **Agency Partners** - Manage subcontractor relationships
- **Maintenance Plans** - Track retainer hours and usage

## Tech Stack

- PHP 8.3
- MySQL 8.0
- Tailwind CSS 3.4
- Vanilla JavaScript (ES6+)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/tonyshawjr/projectbook.git
cd projectbook
```

2. Set up your local environment (MAMP/XAMPP)

3. Copy the example config file:
```bash
cp config/config.example.php config/config.php
```

4. Update config/config.php with your database credentials

5. Import the database schema:
```bash
mysql -u your_username -p projectbook < database/schema.sql
```

6. Set up a virtual host pointing to the `public` directory

7. Build Tailwind CSS:
```bash
npx tailwindcss -i ./public/assets/css/input.css -o ./public/assets/css/output.css --watch
```

## Project Structure

```
/projectbook
├── /public              # Web root
│   ├── index.php       # Entry point
│   └── /assets         # CSS, JS, images
├── /app                # Application code
│   ├── /Controllers    # Request handlers
│   ├── /Models         # Data models
│   ├── /Views          # Templates
│   └── /Core           # Framework components
├── /config             # Configuration files
├── /database           # SQL schemas and migrations
└── /storage            # File uploads
```

## Development

- Local URL: http://localhost/projectbook
- Use PHP 8.3+ and MySQL 8.0+
- Follow PSR-12 coding standards
- Test on latest Chrome, Firefox, Safari

## Security

- All database queries use prepared statements
- CSRF protection on all forms
- XSS prevention through output escaping
- Secure session management

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

Proprietary - All rights reserved

## Support

For issues and questions, please use the GitHub issue tracker.